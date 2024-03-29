<?php

namespace App\Http\Controllers;

use App\Http\Traits\KazakhSorterTrait;
use App\Models\BaskatPro;
use App\Models\ZhanasPro;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProTextAnalysisController extends Controller
{
    public function transliterateToKazakh($words): array
    {
        // Define the mapping from English to Kazakh for specific characters.
        // Note: This mapping is based on the phonetic or visual similarity of the letters.
        // It's important to understand that real phonetic translations may differ and a linguistic expert could give exact mappings.
        $transliterationMap = [
            'a' => 'а',  // Cyrillic 'a'
            'o' => 'о',  // Cyrillic 'o'
            'y' => 'у',  // Cyrillic 'y' (closest based on your example, though 'y' isn't typically a direct match)
            'e' => 'е',  // Cyrillic 'e'
            'i' => 'і',  // Cyrillic 'i'
        ];

        // Result container
        $transliteratedWords = [];

        foreach ($words as $word) {
            // Process each word
            $transliteratedWord = "";
            $word = preg_replace('/^\P{L}+|\P{L}+$/u', '', $word);
            for ($i = 0; $i < mb_strlen($word); $i++) {
                $char = mb_substr($word, $i, 1); // Extract character by character

                // Check and transliterate if the character is in our map
                if (array_key_exists(mb_strtolower($char), $transliterationMap)) {
                    // If the character is uppercase, we convert the replacement to uppercase too
                    if (mb_strtolower($char) !== $char) {
                        $transliteratedWord .= mb_strtoupper($transliterationMap[mb_strtolower($char)]);
                    } else {
                        $transliteratedWord .= $transliterationMap[$char];
                    }
                } else {
                    // If it's not a mapped character, we leave it as is
                    $transliteratedWord .= $char;
                }
            }

            // Add the processed word to our results
            $transliteratedWords[] = $transliteratedWord;
        }

        return $transliteratedWords;
    }

    public function getWordsList(Request $request): array|bool
    {
        $request->validate([
            'text' => 'required|string'
        ]);

        $text = $request->input('text');
        // This regex splits by whitespace or punctuation, but excludes standalone hyphens/dashes surrounded by whitespace
        $words = preg_split("/\s+|(?<!\S)[,.:;!?]+(?!\S)|(?<=\s)[-—](?=\s)/u", $text, -1, PREG_SPLIT_NO_EMPTY);
        $words = array_map('trim', $words); // Trim each word, just in case
        $words = $this->transliterateToKazakh($words);
        // Filter out any empty strings or strings that are just dashes
        $filteredWords = array_filter($words, function($word) {
            return $word !== '' && !preg_match('/^[-—]+$/u', $word);
        });
        return KazakhSorterTrait::sort($filteredWords);
    }


    public function analyzeText(Request $request): JsonResponse
    {
        $words = $this->getWordsList($request);
        $totalWords = count($words);
        $wordFrequencies = array_count_values($words);

        // Calculate the uniqueness range.
        $uniquenessRange = $this->calculateUniquenessRange($totalWords);

        // Filter the word frequencies to get only unique words, excluding English words.
        $uniqueWords = array_filter($wordFrequencies, function ($frequency, $word) use ($uniquenessRange) {
            return $frequency >= $uniquenessRange[0] && $frequency <= $uniquenessRange[1] && !preg_match('/[a-zA-Z]/', $word);
        }, ARRAY_FILTER_USE_BOTH);

        // Recalculate total words excluding English words.
        $wordsExcludingEnglish = array_filter($words, function ($word) {
            return !preg_match('/[a-zA-Z]/', $word);
        });
        $totalWordsExcludingEnglish = count($wordsExcludingEnglish);

        // Calculate the unique word count and the percentage of unique words.
        $uniqueWordCount = count($uniqueWords);
        $percentageUnique = $totalWordsExcludingEnglish > 0 ? ($uniqueWordCount / $totalWordsExcludingEnglish) * 100 : 0;

        return response()->json([
            'totalWords' => $totalWords,
            'uniqueWords' => $uniqueWordCount,
            'percentageUnique' => $percentageUnique,
        ]);
    }


    private function calculateUniquenessRange($totalWords): array
    {
        if ($totalWords <= 500) {
            return [1, 3];
        } else if ($totalWords <= 1000) {
            return [1, 5];
        } else if ($totalWords <= 3000) {
            return [1, 15];
        } else if ($totalWords <= 5000) {
            return [1,30];
        }
    }

    public function wordRepetitions(Request $request) {
        $words = $this->getWordsList($request);

        $wordRepetitions = [];

        foreach ($words as $word) {
            if (isset($wordRepetitions[$word])) {
                $wordRepetitions[$word]++;
            } else {
                $wordRepetitions[$word] = 1;
            }
        }
        return $wordRepetitions;
    }

    public function wordsAndOccurrences(Request $request): JsonResponse
    {
        $wordRepetitions = $this->wordRepetitions($request);

        return response()->json([
            'wordRepetitions' => $wordRepetitions
        ]);
    }


    public function checkBaskats(Request $request)
    {
        $words = array_keys($this->wordRepetitions($request));
        $wordsNotInBaskats = [];
        foreach ($words as $word) {
            if (!BaskatPro::where('word', $word)->exists()) {
                ZhanasPro::firstOrCreate(['word' => $word]);
                $wordsNotInBaskats[] = $word;
            }
        }

        return response()->json(array_values($wordsNotInBaskats));
    }
}

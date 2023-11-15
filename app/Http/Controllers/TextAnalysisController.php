<?php

namespace App\Http\Controllers;

use App\Http\Traits\KazakhSorter;
use App\Http\Traits\KazakhSorterTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TextAnalysisController extends Controller
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
        $words = preg_split("/[\s,.;]+/", $text);
        $words = $this->transliterateToKazakh($words);
        $filteredWords = array_filter($words, function($word) {
            return preg_match('/[аәбвгғдеёжзийкқлмнңоөпрстуұүфхһцчшщъыіьэюя]/u', $word);
        });
        return KazakhSorterTrait::sort($filteredWords);

    }

    public function analyzeText(Request $request): JsonResponse
    {
        $words = $this->getWordsList($request);
        $totalWords = count($words);
        $uniqueWords = count(array_unique($words));
        $percentageUnique = ($uniqueWords / $totalWords) * 100;

        return response()->json([
            'totalWords' => $totalWords,
            'uniqueWords' => $uniqueWords,
            'percentageUnique' => $percentageUnique,
        ]);
    }

    public function wordsAndOccurrences(Request $request): JsonResponse
    {
        $words = $this->getWordsList($request);

        $wordRepetitions = [];

        foreach ($words as $word) {
            if (isset($wordRepetitions[$word])) {
                $wordRepetitions[$word]++;
            } else {
                $wordRepetitions[$word] = 1;
            }
        }

        return response()->json([
            'wordRepetitions' => $wordRepetitions
        ]);
    }

    public function checkWordsAgainstDatabase(Request $request) {
        $words = $this->getWordsList($request);
        $baskatDatabase = [
            "Бала",    // Child
            "Кітап",   // Book
            "Су",      // Water
            "Ой",      // House
            "Тау",     // Mountain
            "Сәлем",   // Hello
            "Ас",      // Food
            "Адам",    // Person
            "Қала",    // City
            "Көз",     // Eye
            "Көш",     // Street
            "Құс",     // Bird
            "Бүгін",   // Today
            "Ертең",   // Tomorrow
            "Түн",     // Night
            "Күн",     // Day
            "Жүрек",   // Heart
            "Тіл",     // Language
            "Қол",     // Hand
            "Аяқ",     // Foot
            "Үй",      // Home
            "Мектеп",  // School
            "Оқу",     // Study
            "Дос",     // Friend
            "Әке",     // Brother
            "Апа",     // Sister
            "Ана",     // Mother
            "Әке",     // Father
            "Көрік",   // View
            "Жаз",     // Summer
            "Күз",     // Autumn
            "Қыс",     // Winter
            "Көк",     // Sky
            "Жол",     // Road
            "Жер",     // Earth
            "Бас",     // Head
            "Балық",   // Fish
            "Терең",   // Deep
            "Бір",     // One
            "Екі",     // Two
            "Үш",      // Three
            "Төрт",    // Four
            "Бес",     // Five
            "Алма",    // Apple
            "Сиыр",    // Cow
            "Қой",     // Sheep
            "Жылан",   // Snake
            "Орман",   // Forest
            "Теңіз",   // Sea
            "Көл",     // Lake
            "Қар",     // Snow
            "Жаңбыр",  // Rain
        ];
        $baskatDatabase = array_map('mb_strtolower', $baskatDatabase);
        $errors = [];

        foreach ($words as $word) {
            if (!in_array(mb_strtolower($word), $baskatDatabase)) {
                // Highlight word with red wavy underline.
                // You can also add other checks for errors here.
                $errors[] = $word;
            }
        }

        return response()->json(['errors' => $errors]);
    }

}

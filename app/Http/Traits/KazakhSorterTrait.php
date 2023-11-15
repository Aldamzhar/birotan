<?php

namespace App\Http\Traits;

class KazakhSorterTrait
{
    protected static string $kazakhAlphabet = "АӘБВГҒДЕЁЖЗИЙКҚЛМНҢОӨПРСТУҰҮФХҺЦЧШЩЪЫІЬЭЮЯ";

    public static function sort(array $words): array
    {
        usort($words, [self::class, 'kazakhSort']);
        return $words;
    }

    protected static function kazakhSort($a, $b)
    {
        $length = min(mb_strlen($a), mb_strlen($b));

        for ($i = 0; $i < $length; $i++) {
            $ai = mb_strpos(self::$kazakhAlphabet, mb_strtoupper(mb_substr($a, $i, 1)));
            $bi = mb_strpos(self::$kazakhAlphabet, mb_strtoupper(mb_substr($b, $i, 1)));

            if ($ai !== $bi) return $ai - $bi;
        }

        return mb_strlen($a) - mb_strlen($b);
    }
}

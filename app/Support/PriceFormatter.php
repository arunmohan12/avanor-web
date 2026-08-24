<?php

namespace App\Support;

class PriceFormatter
{
    public static function aed(float|string|null $price): string
    {
        if ($price === null || $price === '') {
            return 'Price on Request';
        }

        $price = (float) $price;

        if ($price >= 1_000_000_000) {
            return 'AED '.self::compact($price / 1_000_000_000).' B';
        }

        if ($price >= 1_000_000) {
            return 'AED '.self::compact($price / 1_000_000).' M';
        }

        if ($price >= 1_000) {
            return 'AED '.self::compact($price / 1_000).' K';
        }

        return 'AED '.number_format($price, 0);
    }

    public static function full(float|string|null $price): string
    {
        if ($price === null || $price === '') {
            return 'Price on Request';
        }

        return 'AED '.number_format((float) $price, 2);
    }

    private static function compact(float $value): string
    {
        return rtrim(
            rtrim(number_format($value, 2, '.', ''), '0'),
            '.'
        );
    }
}

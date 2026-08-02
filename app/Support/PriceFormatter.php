<?php

namespace App\Support;

class PriceFormatter
{
    public static function aed(?float $price): string
    {
        if (is_null($price)) {
            return 'Price on Request';
        }

        if ($price >= 1000000000) {
            return 'AED ' . number_format($price / 1000000000, 2) . 'B';
        }

        if ($price >= 1000000) {
            return 'AED ' . number_format($price / 1000000, 2) . 'M';
        }

        if ($price >= 1000) {
            return 'AED ' . number_format($price / 1000, 2) . 'K';
        }

        return 'AED ' . number_format($price, 0);
    }

    public static function full(?float $price): string
    {
        if (is_null($price)) {
            return 'Price on Request';
        }

        return 'AED ' . number_format($price, 2);
    }
}
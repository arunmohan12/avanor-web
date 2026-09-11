<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SafeLeadMessage implements ValidationRule
{
    private const SPAM_KEYWORDS = [
        'adult',
        'backlink',
        'betting',
        'bitcoin',
        'casino',
        'cialis',
        'crypto',
        'escort',
        'forex',
        'guest post',
        'payday loan',
        'porn',
        'seo service',
        'viagra',
    ];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || blank($value)) {
            return;
        }

        if ($this->containsLink($value)) {
            $fail('Links are not allowed in your message.');

            return;
        }

        $message = mb_strtolower($value);

        foreach (self::SPAM_KEYWORDS as $keyword) {
            if (str_contains($message, $keyword)) {
                $fail('Your message contains content that cannot be submitted.');

                return;
            }
        }
    }

    private function containsLink(string $message): bool
    {
        return preg_match(
            '~(?:https?://|www\.)[^\s<]+|(?<!@)\b[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.(?:com|net|org|io|co|biz|info|xyz|top|click|shop|site|online|ru|cn|ae|uk|de|in)\b~i',
            $message,
        ) === 1;
    }
}

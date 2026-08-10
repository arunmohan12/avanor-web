<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class MediaUrl
{
    public static function get(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        return Storage::disk('s3')->temporaryUrl(
            $path,
            now()->addMinutes(60)
        );
    }
}
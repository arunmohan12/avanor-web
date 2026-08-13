<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
    public static function fromMedia(
        ?Media $media,
        ?string $conversion = null,
        int $minutes = 60
    ): ?string {
        if (! $media) {
            return null;
        }

        return $media->getTemporaryUrl(
            now()->addMinutes($minutes),
            $conversion ?? ''
        );
    }

}
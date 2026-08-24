<?php

namespace App\Support;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class MediaPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        return $this->basePath($media);
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->basePath($media).'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->basePath($media).'responsive-images/';
    }

    private function basePath(Media $media): string
    {
        $model = $media->model;

        if (! $model) {
            return "media/{$media->id}/";
        }

        $modelName = strtolower(class_basename($model));

        $modelName = Str::plural(
            strtolower(class_basename($model))
        );

        return "{$modelName}/{$model->getKey()}/{$media->collection_name}/";
    }
}

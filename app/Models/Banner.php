<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Banner extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslations;

    protected $translatable = [
        'title',
        'description'
    ];

    protected $fillable = [
        'title',
        'description',
        'url'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('banner')
            ->width(1200)
            ->height(1200)
            ->sharpen(10);
    }
}

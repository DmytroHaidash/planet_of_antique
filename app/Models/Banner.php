<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
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
}

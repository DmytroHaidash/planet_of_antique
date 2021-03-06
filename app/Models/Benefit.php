<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Benefit extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslations;

    protected $translatable = [
        'title',
    ];

    protected $fillable = [
        'title',
        'page_id'
    ];

    public function getImageAttribute()
    {
        return $this->hasMedia('benefit')
            ? $this->getFirstMedia('benefit')->getFullUrl()
            : asset('images/no-image.png');
    }
}

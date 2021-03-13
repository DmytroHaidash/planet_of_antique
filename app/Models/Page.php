<?php

namespace App\Models;

use App\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Page extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslations, SluggableTrait;

    protected $translatable = [
        'title',
        'description'
    ];

    protected $fillable = [
        'slug',
        'title',
        'description'
    ];

    public function registerMediaCollections():void
    {
        $this->addMediaCollection('page')
            ->useFallbackUrl(asset('images/no-image.png'))
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('banner')
                    ->width(1920)
                    ->height(1080)
                    ->sharpen(10);
            });
    }

    public function getImageAttribute()
    {
        return $this->hasMedia('page')
            ? $this->getFirstMediaUrl('page')
            : asset('images/no-image.png');
    }
    /**
     * @return MorphMany
     */
    public function meta(): MorphMany
    {
        return $this->morphMany(Meta::class, 'metable');
    }

    /**
     * @return HasMany
     */
    public function benefits(): HasMany
    {
        return $this->hasMany(Benefit::class);
    }
}

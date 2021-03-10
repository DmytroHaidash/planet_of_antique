<?php

namespace App\Models;

use App\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Exhibit extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslations, SluggableTrait;

    protected $translatable = [
        'title',
        'body'
    ];

    protected $fillable = [
        'slug',
        'title',
        'body',
        'published',
        'museum_id',
        'recommended',
    ];

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_exhibit', 'exhibit_id', 'category_id');
    }

    /**
     * @return BelongsTo
     */
    public function museum(): BelongsTo
    {
        return $this->belongsTo(Museum::class);
    }

    /**
     * @return MorphMany
     */
    public function meta(): MorphMany
    {
        return $this->morphMany(Meta::class, 'metable');
    }

    public function getFirstImageAttribute()
    {
        return $this->hasMedia('uploads')
            ? $this->getFirstMedia('uploads')->getFullUrl('banner')
            : asset('images/no-image.png');
    }

    public function getBanner()
    {
        if ($this->hasMedia('uploads')) {
            return $this->getFirstMedia('uploads')->getFullUrl();
        }

        return asset('images/no-image.png');
    }

    public function registerMediaCollections():void
    {
        $this->addMediaCollection('uploads')
            ->useFallbackUrl(asset('images/no-image.png'))
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('thumb')
                    ->fit(Manipulations::FIT_CROP, 100, 100)
                    ->width(100)
                    ->height(100);

                $this->addMediaConversion('preview')
                    ->width(600)
                    ->height(400);

                $this->addMediaConversion('banner')
                    ->width(1920)
                    ->height(1080);
            });
    }

    protected static function boot()
    {
        parent::boot();
        if (app('router')->currentRouteNamed('client.*')) {
            self::addGlobalScope('available', function (Builder $builder) {
                $builder->where('published', 1);
            });
        };
    }
}

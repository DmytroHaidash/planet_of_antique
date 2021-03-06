<?php

namespace App\Models;

use App\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Shop extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslations, SluggableTrait;

    protected $translatable = [
        'title', 'description', 'delivery', 'contacts'
    ];
    protected $fillable = [
        'user_id', 'slug', 'title', 'description', 'delivery', 'published', 'partner', 'contacts', 'currency'
    ];


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return MorphMany
     */
    public function meta(): MorphMany
    {
        return $this->morphMany(Meta::class, 'metable');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 100, 100)
            ->width(250)
            ->height(250)
            ->sharpen(10);

        $this->addMediaConversion('preview')
            ->width(600)
            ->height(400)
            ->sharpen(10);

        $this->addMediaConversion('banner')
            ->width(1920)
            ->height(1080)
            ->sharpen(10);
    }

    public function getLogoAttribute()
    {
        return $this->hasMedia('logo')
            ? $this->getFirstMedia('logo')->getFullUrl()
            : asset('images/no-avatar.png');
    }
    public function getLogoThumbAttribute()
    {
        return $this->hasMedia('logo')
            ? $this->getFirstMedia('logo')->getFullUrl('thumb')
            : asset('images/no-avatar.png');
    }
}

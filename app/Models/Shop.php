<?php

namespace App\Models;

use App\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'title', 'description', 'delivery'
    ];
    protected $fillable = [
        'user_id', 'slug', 'title', 'description', 'delivery', 'published', 'partner'
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

    public function getLogoAttribute()
    {
        return $this->hasMedia('logo')
            ? $this->getFirstMedia('logo')->getFullUrl()
            : asset('images/no-image.png');
    }

    public function getBannerAttribute()
    {
        return $this->hasMedia('banner')
            ? $this->getFirstMedia('banner')->getFullUrl()
            : asset('images/no-image.png');
    }
}

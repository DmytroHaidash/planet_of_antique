<?php

namespace App\Models;

use App\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Article extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslations, SluggableTrait;

    protected $translatable = [
        'title',
        'description',
        'body'
    ];

    protected $fillable = [
        'slug', 'user_id', 'title', 'description', 'body'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
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
            ->width(100)
            ->height(100)
            ->sharpen(10);

        $this->addMediaConversion('preview')
            ->width(480)
            ->height(480)
            ->sharpen(10);

        $this->addMediaConversion('banner')
            ->width(1200)
            ->height(1200)
            ->sharpen(10);
    }

    public function getImageAttribute()
    {
        return $this->hasMedia('article')
            ? $this->getFirstMedia('article')->getFullUrl()
            : asset('images/no-image.png');
    }
}

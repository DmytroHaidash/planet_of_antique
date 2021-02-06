<?php

namespace App\Models;

use App\Traits\SluggableTrait;
use App\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslations, SluggableTrait;

    protected $translatable = [
        'title'
    ];

    protected $fillable = [
        'slug',
        'title',
        'parent_id'
    ];

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }

    /**
     * @return MorphMany
     */
    public function meta(): MorphMany
    {
        return $this->morphMany(Meta::class, 'metable');
    }

    public function registerMediaCollections():void
    {
        $this->addMediaCollection('category')
            ->useFallbackUrl(asset('images/no-image.png'))
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('preview')
                    ->width(600)
                    ->height(400)
                    ->sharpen(10);
            });
    }

    public function getImageAttribute()
    {
        return $this->hasMedia('category')
            ? $this->getFirstMedia('category')->getFullUrl('preview')
            : asset('images/no-image.png');
    }

//    /**
//     * @return HasMany
//     */
//    public function children(): HasMany
//    {
//        return $this->hasMany(Category::class, 'parent_id');
//    }
//
//    /**
//     * @param  Builder  $query
//     * @return Builder
//     */
//    public function scopeOnlyParents(Builder $query): Builder
//    {
//        return $query->whereNull('parent_id');
//    }

}

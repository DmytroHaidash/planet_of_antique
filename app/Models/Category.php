<?php

namespace App\Models;

use App\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements HasMedia, Sortable
{
    use InteractsWithMedia, HasTranslations, SortableTrait,  SluggableTrait;

    protected $translatable = [
        'title'
    ];

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];
    protected $fillable = [
        'slug',
        'title',
        'parent_id',
        'sort_order',
        'recommended',
    ];

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }

    public function exhibits():BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_exhibit', 'category_id', 'exhibit_id');
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

    protected static function boot()
    {
        parent::boot();

        self::addGlobalScope('sortById', function (Builder $builder) {
            $builder->orderBy('sort_order');
        });
    }
}

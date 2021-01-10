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
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
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

    public function getImageAttribute()
    {
        return $this->hasMedia('category')
            ? $this->getFirstMedia('category')->getFullUrl()
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

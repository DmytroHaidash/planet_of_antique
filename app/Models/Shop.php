<?php

namespace App\Models;

use App\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Shop extends Model implements HasMedia
{
    use InteractsWithMedia, SluggableTrait;

    protected $fillable = [
        'user_id', 'title', 'description', 'delivery', 'published', 'partner'
    ];


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products():HasMany
    {
        return $this->hasMany(Product::class);
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
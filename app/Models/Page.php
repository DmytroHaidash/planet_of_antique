<?php

namespace App\Models;

use App\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
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

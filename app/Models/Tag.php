<?php

namespace App\Models;

use App\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use SluggableTrait, HasTranslations;

    protected $translatable = [
        'title'
    ];

    protected $fillable = [
        'slug',
        'title'
    ];

    public function articles():BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
}

<?php

namespace App\Models;

use App\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use SluggableTrait;

    protected $fillable = [
        'slug',
        'title'
    ];

    public function articles():BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
}

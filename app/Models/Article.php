<?php

namespace App\Models;

use App\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use InteractsWithMedia, SluggableTrait;

    protected $fillable = [
        'slug', 'user_id', 'title', 'description', 'body'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

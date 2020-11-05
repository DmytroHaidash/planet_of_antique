<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'facebook',
        'youtube',
        'instagram',
        'pinterest',
        'email',
        'whatsapp',
        'ads_per_user'
    ];
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use Notifiable, InteractsWithMedia;

    public static $ROLES = [
        'seller', 'buyer', 'admin',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'active', 'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $dates = [
        'email_verified_at'
    ];

    /**
     * @param string|array $condition
     * @return bool
     */
    public function hasRole($condition): bool
    {
        if (is_string($condition)) {
            $condition = explode('|', $condition);
        }

        return in_array($this->role, $condition);
    }
    public function shop():HasOne
    {
        return $this->hasOne(Shop::class);
    }

    public function article():HasMany
    {
        return $this->hasMany(Article::class);
    }
    /**
     * @return string|integer
     */
    public static function current()
    {
        return Auth::check() ? Auth::user()->id : Session::getId();
    }

    public function getAvatarAttribute()
    {
        return $this->hasMedia('avatar')
            ? $this->getFirstMedia('avatar')->getFullUrl('thumb')
            : asset('images/no-avatar.png');
    }
    /* Helpers */

    public function getPath()
    {
        return [$this->getKey(), Str::slug($this->name)];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->useFallbackUrl(asset('images/no-avatar.png'))
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('thumb')
                    ->fit(Manipulations::FIT_CROP, 48, 48)
                    ->width(48)
                    ->height(48)
                    ->sharpen(10)
                    ->nonQueued();

                $this->addMediaConversion('large')
                    ->fit(Manipulations::FIT_CROP, 384, 384)
                    ->width(384)
                    ->height(384)
                    ->sharpen(10)
                    ->nonQueued();
            });
    }
}

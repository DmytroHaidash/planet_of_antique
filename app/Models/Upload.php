<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\Upload
 *
 * @property int $id
 * @property Carbon $created_at
 * @property-read Collection|Media[] $media
 * @property-read int|null $media_count
 * @method static Builder|Upload newModelQuery()
 * @method static Builder|Upload newQuery()
 * @method static Builder|Upload query()
 * @method static Builder|Upload whereCreatedAt($value)
 * @method static Builder|Upload whereId($value)
 * @property-read \App\Models\User $user
 */
class Upload extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('uploads')
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('thumb')
                    ->fit(Manipulations::FIT_CROP, 100, 100)
                    ->width(100)
                    ->height(100)
                    ->sharpen(10);

                $this->addMediaConversion('medium')
                    ->width(600)
                    ->height(600)
                    ->sharpen(10);

                $this->addMediaConversion('banner')
                    ->width(1920)
                    ->height(500)
                    ->sharpen(10);

                $this->addMediaConversion('large')
                    ->width(1200)
                    ->height(1200)
                    ->sharpen(10);
            });
    }
}

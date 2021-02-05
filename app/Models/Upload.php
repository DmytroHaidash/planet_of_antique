<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Upload extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaCollections():void
    {
        $this->addMediaCollection('uploads')
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('thumb')
                    ->fit(Manipulations::FIT_CROP, 100, 100)
                    ->width(100)
                    ->height(100);

                $this->addMediaConversion('preview')
                    ->width(480)
                    ->height(480);

                $this->addMediaConversion('banner')
                    ->width(1200)
                    ->height(1200);
            });
    }
}

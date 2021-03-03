<?php

namespace App\Models;

use App\Http\Resources\MediaResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Accounting extends Model  implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'product_id',
        'date',
        'price',
        'message',
        'supplier_id',
        'whom',
        'amount',
        'comment',
        'buyer',
        'sell_price',
        'sell_date'
    ];

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function registerMediaCollections():void
    {
        $this->addMediaCollection('uploads')
            ->useFallbackUrl(asset('images/no-image.png'))
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('thumb')
                    ->fit(Manipulations::FIT_CROP, 100, 100)
                    ->width(100)
                    ->height(100);
                $this->addMediaConversion('preview')
                    ->width(600)
                    ->height(400);

                $this->addMediaConversion('banner')
                    ->width(1920)
                    ->height(1080);
            });
    }

    public function getImagesListAttribute()
    {
        return MediaResource::collection($this->getMedia('uploads'));
    }
}

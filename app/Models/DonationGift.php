<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DonationGift extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'donation_gifts';

    public const PATH = 'donation_gift_image';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'amount',
        'description',
        'status',
        'delivery_date',
    ];

    public static $rules = [
        'title' => 'required|max:200',
        'amount' => 'required',
        'status' => 'required',
        'delivery_date' => 'required',
        'gifts.*.*' => 'required',
        'image' => 'required|mimes:jpg,jpeg,png',
    ];

    const PUBLISH = 1;

    const DRAFT = 2;

    const STATUS = [
        self::PUBLISH => 'Publish',
        self::DRAFT => 'Draft',
    ];

    protected $with = ['media', 'gifts'];

    public function gifts(): HasMany
    {
        return $this->hasMany(Gift::class);
    }

    /**
     * @return string
     */
    public function getDonationGiftImageAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PATH)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('front_landing/images/causes-hero-img.png');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FrontSlider2 extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'second_sliders';

    const FRONT_SLIDER_IMAGE = 'front_slider_image';

    protected $appends = ['slider_image'];

    protected $with = ['media'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title_1',
        'title_2',
    ];

    protected $casts = [
        'title_1' => 'string',
        'title_2' => 'string',
    ];

    public static $rules = [
        'title_1' => 'required|max:50',
        'title_2' => 'required|max:50',
        'image' => 'required',
    ];

    /**
     * @return string
     */
    public function getSliderImageAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::FRONT_SLIDER_IMAGE)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('front_landing/images/cause-details.png');
    }
}

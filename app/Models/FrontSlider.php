<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\FrontSlider
 *
 * @property int $id
 * @property string $title_1
 * @property string $title_2
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $slider_image
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FrontSlider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontSlider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontSlider query()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontSlider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontSlider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontSlider whereTitle1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontSlider whereTitle2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontSlider whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FrontSlider extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'front_sliders';

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

        return asset('front_landing/images/hero-image.png');
    }
}

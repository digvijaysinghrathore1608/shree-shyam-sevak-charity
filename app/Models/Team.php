<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class Team
 *
 * @version February 25, 2022, 6:09 am UTC
 *
 * @property string $name
 * @property string $designation
 */
class Team extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const PATH = 'image_url';

    public $table = 'teams';

    public $fillable = [
        'name',
        'designation',
    ];

    protected $with = ['media'];

    protected $appends = ['image_url'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'designation' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:teams|max:30',
        'designation' => 'required|max:30',
        'image' => 'required|mimes:jpg,jpeg,png',
    ];

    public function getImageUrlAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PATH)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('front_landing/images/team-2.png');
    }
}

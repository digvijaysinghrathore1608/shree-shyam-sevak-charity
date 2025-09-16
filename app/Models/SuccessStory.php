<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SuccessStory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'success_stories';

    const SUCCESS_STORY_IMAGE = 'success_story_image';

    protected $appends = ['image'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'short_description',
    ];

    protected $with = ['media'];

    public static $rules = [
        'title' => 'required|max:60',
        'image' => 'required|mimes:jpg,jpeg,png',
        'short_description' => 'required|max:500',
    ];

    protected $casts = [
        'title' => 'string',
        'short_description' => 'string',
    ];

    /**
     * @return string
     */
    public function getImageAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::SUCCESS_STORY_IMAGE)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('front_landing/web/media/avatars/150-2.jpg');
    }
}

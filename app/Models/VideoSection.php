<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class VideoSection extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'front_video_settings';

    public const VIDEO_SECTION_PATH = 'video_section';

    /**
     * @var string[]
     */
    protected $fillable = [
        'key',
        'value',
    ];

    protected $with = ['media'];

    public static $rules = [
        'short_title' => 'required|max:50',
        'title' => 'required|max:50',
        'bg_image' => 'nullable|mimes:jpg,jpeg,png',
        'youtube_video_link' => 'required',
    ];
}

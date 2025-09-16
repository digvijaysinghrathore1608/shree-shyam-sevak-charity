<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AboutUs extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'about_us';

    public const ABOUT_US_PATH = 'about_us';

    /**
     * @var string[]
     */
    protected $fillable = [
        'key',
        'value',
    ];

    protected $with = ['media'];

    public static $rules = [
        'menu_title' => 'required|max:50',
        'title' => 'required|max:50',
        'short_description' => 'required',
        'point_1' => 'required|max:50',
        'point_2' => 'required|max:50',
        'point_3' => 'required|max:50',
        'point_4' => 'required|max:50',
        'years_of_exp' => 'required',
    ];
}

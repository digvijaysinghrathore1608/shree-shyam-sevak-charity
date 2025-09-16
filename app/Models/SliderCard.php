<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SliderCard extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'slider_card';

    public const PATH = 'slider_card';

    /**
     * @var string[]
     */
    protected $fillable = [
        'key',
        'value',
    ];

    protected $with = ['media'];

    public static $rules = [
        'title_1' => 'required|max:15',
        'title_2' => 'required|max:15',
        'image' => 'nullable',
    ];
}

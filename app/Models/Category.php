<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'cms_2_categories';

    public const PATH = 'categories';

    /**
     * @var string[]
     */
    protected $fillable = [
        'key',
        'value',
    ];

    protected $with = ['media'];

    public static $rules = [
        'title_1' => 'required|max:50',
        'description_1' => 'required|max:255',
        'title_2' => 'required|max:50',
        'description_2' => 'required|max:255',
        'title_3' => 'required|max:50',
        'description_3' => 'required|max:255',
    ];
}

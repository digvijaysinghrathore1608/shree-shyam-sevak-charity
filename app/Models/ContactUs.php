<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ContactUs extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'contact_us';

    public const CONTACT_US_PATH = 'contact_us';

    /**
     * @var string[]
     */
    protected $fillable = [
        'key',
        'value',
    ];

    protected $with = ['media'];

    public static $rules = [
        'menu_title' => 'required|max:30',
        'menu_image' => 'nullable|mimes:jpg,jpeg,png',
    ];
}

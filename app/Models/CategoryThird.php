<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CategoryThird extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'cms_3_categories';

    public const PATH = 'categories';

    protected $appends = ['categories_image'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'value',
    ];

    protected $casts = [
        'title' => 'string',
    ];

    protected $with = ['media'];

    public static $rules = [
        'image' => 'required',
        'title' => 'required|unique:cms_3_categories|max:50',
    ];

    /**
     * @return string
     */
    public function getCategoriesImageAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PATH)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('front_landing/images/category-icon4.png');
    }
}

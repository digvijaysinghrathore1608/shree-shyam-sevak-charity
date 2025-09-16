<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class News
 *
 * @version February 12, 2022, 7:49 am UTC
 *
 * @property string $title
 * @property string $slug
 * @property int $news_category_id
 * @property string $description
 * @property int $added_by
 */
class News extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    public const PATH = 'news_image';

    public $table = 'news';

    public $fillable = [
        'title',
        'slug',
        'description',
        'news_category_id',
        'added_by',
    ];

    protected $with = ['media'];

    protected $appends = ['news_image'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'news_category_id' => 'integer',
        'added_by' => 'integer',
    ];

    /**
     * @var string[]
     */
    public static $rules = [
        'title' => 'required',
        'slug' => 'required|max:15',
        'news_category_id' => 'required',
        'description' => 'nullable',
        'image' => 'required|mimes:jpeg,png,jpg',
    ];

    /**
     * @return string
     */
    public function getNewsImageAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PATH)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('front_landing/images/news-post3.png');
    }

    public function newsCategory()
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }

    /**
     * @return mixed
     */
    public function newsTags()
    {
        return $this->belongsToMany(NewsTags::class);
    }

    /**
     * @return mixed
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id', 'added_by');
    }

    /**
     * @return HasMany
     */
    public function newsComments(): HasMany
    {
        return $this->hasMany(NewsComment::class, 'news_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by', 'id');
    }
}

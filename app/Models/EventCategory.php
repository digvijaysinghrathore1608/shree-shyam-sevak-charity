<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\EventCategory
 *
 * @property int $id
 * @property string $name
 * @property int $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $image_url
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EventCategory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const PATH = 'image_url';

    public static $rules = [
        'name' => 'required|unique:event_categories|max:30',
        'image' => 'required|mimes:jpg,jpeg,png',
    ];

    protected $table = 'event_categories';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'is_active',
    ];

    protected $casts = [
        'name' => 'string',
        'is_active' => 'integer',
    ];

    const ALL = 2;

    const ACTIVE = 1;

    const INACTIVE = 0;

    const STATUS = [
        self::ALL => 'All',
        self::ACTIVE => 'Active',
        self::INACTIVE => 'Inactive',
    ];

    protected $with = ['media'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PATH)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('front_landing/images/events-3.png');
    }

    /**
     * @return HasMany
     */
    public function events()
    {
        return $this->hasMany(Event::class, 'category_id', 'id');
    }
}

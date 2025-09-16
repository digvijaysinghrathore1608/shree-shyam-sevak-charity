<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int|null $category_id
 * @property string $description
 * @property string $event_date
 * @property string $start_time
 * @property string $end_time
 * @property int $available_tickets
 * @property string $event_organizer_name
 * @property string $event_organizer_email
 * @property string $event_organizer_phone
 * @property string $event_organizer_website
 * @property string $venue
 * @property string $venue_location
 * @property string $venue_phone
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereAvailableTickets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventOrganizerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventOrganizerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventOrganizerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventOrganizerWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereVenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereVenueLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereVenuePhone($value)
 * @mixin \Eloquent
 */
class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const PATH = 'image_url';

    const PUBLISHED = 1;

    const DRAFT = 2;

    const ALL = 3;

    const STATUS = [
        self::ALL => 'All',
        self::PUBLISHED => 'Published',
        self::DRAFT => 'Draft',
    ];

    const ADDSTATUS = [
        self::PUBLISHED => 'Published',
        self::DRAFT => 'Draft',
    ];

    public static $rules = [
        'title' => 'required|max:30',
        'slug' => 'required|max:15',
        'category_id' => 'required',
        'event_date' => 'required',
        'start_time' => 'required',
        'end_time' => 'required|nullable|after:start_time',
        'event_organizer_website' => 'nullable',
        'available_tickets' => 'required|integer',
        'event_organizer_email' => 'required|email:filter',
        'event_organizer_phone' => 'required',
        'venue' => 'required|max:30',
        'status' => 'required',
        'image' => 'required|mimes:jpg,jpeg,png',
    ];

    protected $table = 'events';

    /**
     * @var string[]
     */
    protected $fillable = [
        'title', 'slug', 'description', 'category_id', 'event_date', 'start_time', 'end_time', 'available_tickets',
        'event_organizer_name', 'event_organizer_email', 'event_organizer_phone', 'event_organizer_website', 'venue',
        'venue_location', 'venue_phone', 'status',
    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'description' => 'string',
        'category_id' => 'integer',
        'event_date' => 'date',
        'start_time' => 'timestamp',
        'end_time' => 'timestamp',
        'available_tickets' => 'integer',
        'event_organizer_name' => 'string',
        'event_organizer_email' => 'string',
        'event_organizer_phone' => 'string',
        'event_organizer_website' => 'string',
        'venue' => 'string',
        'venue_location' => 'string',
        'venue_phone' => 'string',
        'status' => 'integer',
    ];

    protected $with = ['media', 'eventCategory', 'eventParticipants'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PATH)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('front_landing/images/events-hero-img.png');
    }

    /**
     * @return BelongsTo
     */
    public function eventCategory(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }

    /**
     * @return HasMany
     */
    public function eventParticipants(): HasMany
    {
        return $this->hasMany(EventParticipant::class);
    }
}

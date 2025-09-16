<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\Campaign
 *
 * @property int $id
 * @property string $title
 * @property int $campaign_category_id
 * @property string $slug
 * @property string|null $short_description
 * @property string $description
 * @property float|null $goal
 * @property float|null $recommended_amount
 * @property string|null $amount_prefilled
 * @property int|null $campaign_end_method
 * @property string|null $video_link
 * @property int|null $country_id
 * @property string|null $location
 * @property string|null $start_date
 * @property string|null $deadline
 * @property int|null $status
 * @property int|null $is_featured
 * @property int|null $is_emergency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CampaignCategory $campaignCategory
 * @property-read string $image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign query()
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereAmountPrefilled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCampaignCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCampaignEndMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereIsEmergency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereRecommendedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereVideoLink($value)
 * @mixin \Eloquent
 */
class Campaign extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const AFTER_END_DATE = 1;

    const AFTER_GOAL_ACHIEVE = 2;

    const CAMPAIGN_IMAGE = 'campaign_image';

    const CAMPAIGN_DROP_IMAGE = 'campaign_drop_image';

    const STATUS_ACTIVE = 1;

    const STATUS_BLOCKED = 2;

    const STATUS_PENDING = 3;

    const STATUS_FINISHED = 4;

    const STATUS_All = 5;

    const STATUS_ARRAY = [
        self::STATUS_All => 'All',
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_BLOCKED => 'Blocked',
        self::STATUS_PENDING => 'Pending',
        self::STATUS_FINISHED => 'Finished',
    ];

    const ADD_STATUS = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_BLOCKED => 'Blocked',
        self::STATUS_PENDING => 'Pending',
        self::STATUS_FINISHED => 'Finished',
    ];

    /**
     * @var string
     */
    protected $table = 'campaigns';

    protected $appends = ['image', 'status_name'];

    protected $with = ['campaignCategory', 'media'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'campaign_category_id',
        'slug',
        'short_description',
        'description',
        'goal',
        'recommended_amount',
        'amount_prefilled',
        'campaign_end_method',
        'video_link',
        'currency',
        'country_id',
        'location',
        'start_date',
        'deadline',
        'status',
        'is_featured',
        'is_emergency',
        'gift_status',
    ];

    public static $rules = [
        'title' => 'required|unique:campaigns,title|max:50',
        'slug' => 'required|unique:campaigns,slug|max:15',
        'campaign_category_id' => 'required',
        'image' => 'required|mimes:jpeg,png,jpg',
        'status' => 'required',
    ];

    protected $casts = [
        'title' => 'string',
        'campaign_category_id' => 'integer',
        'slug' => 'string',
        'short_description' => 'string',
        'description' => 'string',
        'goal' => 'double',
        'recommended_amount' => 'double',
        'amount_prefilled' => 'string',
        'campaign_end_method' => 'integer',
        'video_link' => 'string',
        'currency' => 'string',
        'country_id' => 'integer',
        'location' => 'string',
        'start_date' => 'date',
        'deadline' => 'date',
        'status' => 'integer',
        'is_featured' => 'boolean',
        'is_emergency' => 'boolean',
    ];

    /**
     * @return string
     */
    public function getImageAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::CAMPAIGN_IMAGE)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('front_landing/images/causes-hero-img.png');
    }

    public function campaignCategory(): BelongsTo
    {
        return $this->belongsTo(CampaignCategory::class, 'campaign_category_id', 'id');
    }

    /**
     * @return string
     */
    public function getStatusNameAttribute(): string
    {
        $status = $this->status;

        return self::STATUS_ARRAY[$status];
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function campaignFaqs(): HasMany
    {
        return $this->hasMany(CampaignFaq::class);
    }

    public function campaignUpdates(): HasMany
    {
        return $this->hasMany(CampaignUpdate::class);
    }

    /**
     * @return HasMany
     */
    public function campaignDonations(): HasMany
    {
        return $this->hasMany(CampaignDonation::class);
    }

    /**
     * @return HasMany
     */
    public function campaignDonationTransactions(): HasMany
    {
        return $this->hasMany(CampaignDonationTransaction::class);
    }

    /**
     * @return HasMany
     */
    public function withdrawalRequest(): HasMany
    {
        return $this->hasMany(Withdraw::class, 'campaign_id', 'id')->orderBy('created_at', 'desc');
    }

    public function campaignGifts()
    {
        return $this->belongsToMany(DonationGift::class, 'campaign_gift');
    }
}

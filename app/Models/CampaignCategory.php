<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\CampaignCategory
 *
 * @property int $id
 * @property string $name
 * @property int $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|CampaignCategory newModelQuery()
 * @method static Builder|CampaignCategory newQuery()
 * @method static Builder|CampaignCategory query()
 * @method static Builder|CampaignCategory whereCreatedAt($value)
 * @method static Builder|CampaignCategory whereId($value)
 * @method static Builder|CampaignCategory whereIsActive($value)
 * @method static Builder|CampaignCategory whereName($value)
 * @method static Builder|CampaignCategory whereUpdatedAt($value)
 * @mixin Eloquent
 */
class CampaignCategory extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    const CAMPAIGN_CATEGORY_IMAGE = 'campaign__category_image';

    protected $table = 'campaign_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'is_active',
    ];

    protected $casts = [
        'name' => 'string',
        'is_active' => 'integer',
    ];

    protected $appends = ['image'];

    const ALL = 2;

    const ACTIVE = 1;

    const INACTIVE = 0;

    const STATUS = [
        self::ALL => 'All',
        self::ACTIVE => 'Active',
        self::INACTIVE => 'Inactive',
    ];

    public static $rules = [
        'name' => 'required|max:15|unique:campaign_categories',
    ];

    /**
     * @return string
     */
    public function getImageAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::CAMPAIGN_CATEGORY_IMAGE)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('front_landing/images/causes-hero-img.png');
    }

    /**
     * @return  HasMany
     */
    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class, 'campaign_category_id', 'id');
    }
}

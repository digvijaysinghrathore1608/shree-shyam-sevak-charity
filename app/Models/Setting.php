<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 * @mixin \Eloquent
 */
class Setting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'settings';

    public const PATH = 'settings';

    public const FAVICON = 'favicon';

    const FIXED = 1;

    const PERCENTAGE = 2;

    const STATUS_HOMEPAGE_1 = 1;

    const STATUS_HOMEPAGE_2 = 2;

    const STATUS_HOMEPAGE_3 = 3;

    const STATUS_ARRAY = [
        self::STATUS_HOMEPAGE_1 => 'Homepage 1',
        self::STATUS_HOMEPAGE_2 => 'Homepage 2',
        self::STATUS_HOMEPAGE_3 => 'Homepage 3',
    ];

    const PAYPAL_MODE = [
        'sandbox' => 'SandBox',
        'live' => 'Live',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'key',
        'value',
    ];

    protected $with = ['media'];

    public function getLogoUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PATH)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset($this->value);
    }

    public function getFaviconUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::FAVICON)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset($this->value);
    }
}

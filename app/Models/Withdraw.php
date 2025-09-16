<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Withdraw
 *
 * @property int $id
 * @property string|null $email
 * @property float|null $amount
 * @property int|null $is_approved
 * @property int|null $status
 * @property int $campaign_id
 * @property string|null $admin_notes
 * @property string|null $user_notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $payment_type
 * @property-read \App\Models\BankAccountDetail|null $bankDetails
 * @property-read \App\Models\Campaign $campaign
 * @property-read mixed $approved_type
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw query()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereAdminNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereCampaignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUserNotes($value)
 * @mixin \Eloquent
 */
class Withdraw extends Model
{
    use HasFactory;

    protected $table = 'withdrawal_requests';

    protected $fillable = [
        'email',
        'amount',
        'is_approved',
        'campaign_id',
        'admin_notes',
        'user_notes',
        'status',
        'payment_type',
        'deducate_amount',
        'charge_amount',
        'discount_type',
    ];

    protected $casts = [
        'email' => 'string',
        'amount' => 'float',
        'is_approved' => 'boolean',
        'campaign_id' => 'integer',
        'admin_notes' => 'string',
        'user_notes' => 'string',
        'status' => 'integer',
        'payment_type' => 'integer',
        'deducate_amount' => 'double',
        'charge_amount' => 'double',
        'discount_type' => 'integer',
    ];

    protected $with = [
        'bankDetails',
    ];

    protected $appends = [
        'approved_type',
    ];

    const APPROVED = 1;

    const PENDING = 2;

    const REJECTED = 3;

    const STATUS_All = 5;
    
    const NEED_TO_WITHDRAW = 4;

    const WITHDREW_REJECTED = 0;

    const STATUS = [
        self::STATUS_All => 'All',
        self::APPROVED => 'Approved',
        self::PENDING => 'Pending',
        self::REJECTED => 'Rejected',
    ];

    const APPROVED_TYPE = [
        self::APPROVED => 'Approved',
        self::REJECTED => 'Rejected',
        self::PENDING => 'Pending',
        self::NEED_TO_WITHDRAW => 'Need To Withdraw'
    ];

    const PAYPAL = 1;

    const BANK = 2;

    const TYPE = [
        self::PAYPAL => 'Paypal',
        self::BANK => 'Bank',
    ];

    /**
     * @return BelongsTo
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    public function bankDetails(): HasOne
    {
        return $this->hasOne(BankAccountDetail::class, 'withdrawal_request_id', 'id');
    }

    /**
     * @var array
     */
    public static $paypalRules = [
        'email' => 'required|email',
        'confirm_email' => 'required|email|same:email',
    ];

    public static $bankRules = [
        'account_number' => 'required|max:30',
        'isbn_number' => 'required',
        'branch_name' => 'required|max:30',
        'account_holder_name' => 'required|max:30',
    ];

    public function getApprovedTypeAttribute($value)
    {
        return self::APPROVED_TYPE[$this->status];
    }
}

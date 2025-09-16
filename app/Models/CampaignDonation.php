<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignDonation extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'campaign_donations';

    /**
     * @var string[]
     */
    protected $fillable = [
        'campaign_id',
        'user_id',
        'first_name',
        'last_name',
        'email',
        'donated_amount',
        'charge_amount',
        'campaign_donation_transaction_id',
        'is_withdrawal',
        'donate_anonymously',
        'gift_id',
    ];

    protected $casts = [
        'campaign_id' => 'integer',
        'user_id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'donated_amount' => 'float',
        'charge_amount' => 'double',
        'campaign_donation_transaction_id' => 'integer',
        'is_withdrawal' => 'boolean',
    ];

    protected $appends = ['full_name'];

    /**
     * @return BelongsTo
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * @return BelongsTo
     */
    public function CampaignDonationTransaction(): BelongsTo
    {
        return $this->belongsTo(CampaignDonationTransaction::class, 'campaign_donation_transaction_id', 'id');
    }
}

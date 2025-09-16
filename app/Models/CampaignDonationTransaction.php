<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CampaignDonationTransaction extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'campaign_donation_transaction';

    /**
     * @var string[]
     */
    protected $fillable = [
        'transaction_id',
        'payment_method',
        'campaign_id',
        'amount',
        'payload',
        'gift_id',
    ];

    protected $casts = [
        'transaction_id' => 'string',
        'payment_method' => 'integer',
        'campaign_id' => 'integer',
        'amount' => 'float',
        'payload' => 'string',
    ];

    protected $appends = ['payment_type'];

    const STRIPE = 1;

    const PAYPAL = 2;

    const TYPE = [
        self::STRIPE => 'Stripe',
        self::PAYPAL => 'PayPal',
    ];

    /**
     * @return BelongsTo
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }

    public function CampaignDonation(): HasOne
    {
        return $this->hasOne(CampaignDonation::class, 'campaign_donation_transaction_id', 'id');
    }

    public function getPaymentTypeAttribute(): string
    {
        $paymentMethod = $this->payment_method;

        return self::TYPE[$paymentMethod];
    }
}

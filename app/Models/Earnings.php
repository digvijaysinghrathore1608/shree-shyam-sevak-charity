<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earnings extends Model
{
    use HasFactory;

    protected $table = 'earnings';

    protected $fillable = [
        'campaign_id',
        'amount',
        'commission_amount',
        'is_withdrawal',
    ];

    protected $casts = [
        'campaign_id' => 'integer',
        'amount' => 'float',
        'commission_amount' => 'float',
        'is_withdrawal' => 'boolean',
    ];
}

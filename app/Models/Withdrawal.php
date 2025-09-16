<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Withdrawal
 *
 * @property int $id
 * @property string|null $payment_type
 * @property int|null $discount_type
 * @property float|null $discount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Withdrawal extends Model
{
    use HasFactory;

    protected $table = 'withdrawals';

    protected $fillable = [
        'payment_type',
        'discount_type',
        'discount',
    ];

    protected $casts = [
        'payment_type' => 'string',
        'discount_type' => 'integer',
        'discount' => 'double',
    ];

    const FIXED = 1;

    const PERCENTAGE = 2;

    const TYPE = [
        self::FIXED => 'Fixed',
        self::PERCENTAGE => 'Percentage',
    ];
}

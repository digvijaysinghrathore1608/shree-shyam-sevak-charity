<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccountDetail extends Model
{
    use HasFactory;

    protected $table = 'bank_account_details';

    /**
     * @var string[]
     */
    protected $fillable = [
        'withdrawal_request_id', 'account_number', 'isbn_number', 'branch_name', 'account_holder_name',
    ];

    protected $casts = [
        'withdrawal_request_id' => 'integer',
        'account_number' => 'string',
        'isbn_number' => 'string',
        'branch_name' => 'string',
        'account_holder_name' => 'string',
    ];
}

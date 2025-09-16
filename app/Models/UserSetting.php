<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    protected $table = 'user_settings';

    protected $fillable = ['email', 'account_number', 'account_holder_name', 'isbn_number', 'branch_name', 'user_id'];

    protected $casts = [
        'email' => 'string',
        'account_number' => 'string',
        'account_holder_name' => 'string',
        'isbn_number' => 'string',
        'branch_name' => 'string',
        'user_id' => 'integer',
    ];
}

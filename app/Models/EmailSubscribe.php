<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSubscribe extends Model
{
    use HasFactory;

    public $fillable = [
        'email',
    ];

    public static $rules = [
        'email' => 'email:filter|required|unique:email_subscribes,email',
    ];
}

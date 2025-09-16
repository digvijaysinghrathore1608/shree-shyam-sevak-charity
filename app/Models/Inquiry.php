<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'subject', 'message', 'status'];

    protected $table = 'inquiries';

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'subject' => 'string',
        'message' => 'string',
        'status' => 'boolean',
    ];

    const ALL = 2;

    const READ = 1;

    const UNREAD = 0;

    const STATUS = [
        self::ALL => 'All',
        self::READ => 'Read',
        self::UNREAD => 'Unread',
    ];
}

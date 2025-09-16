<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallToAction extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'address', 'zip', 'status'];

    protected $table = 'call_to_actions';

    public static $rules = [
        'name' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'zip' => 'required|max:6',
    ];

    protected $casts = [
        'name' => 'string',
        'phone' => 'string',
        'address' => 'string',
        'zip' => 'string',
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    use HasFactory;

    protected $table = 'event_participants';

    public $fillable = [
        'name', 'email', 'notes', 'event_id',
    ];

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'notes' => 'string',
        'event_id' => 'integer',
    ];
}

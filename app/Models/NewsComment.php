<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsComment extends Model
{
    use HasFactory;

    protected $fillable = ['comments', 'name', 'email', 'website_name', 'news_id', 'user_id'];

    protected $table = 'news_comments';

    public static $rules = [
        'comments' => 'required',
        'name' => 'required',
        'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
    ];

    protected $casts = [
        'comments' => 'string',
        'name' => 'string',
        'email' => 'string',
        'website_name' => 'string',
        'news_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

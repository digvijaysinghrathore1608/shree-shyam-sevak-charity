<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignFaq extends Model
{
    use HasFactory;

    protected $table = 'campaign_faqs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'campaign_id',
    ];

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'campaign_id' => 'integer',
    ];

    public static $rules = [
        'title' => 'required|max:255|unique:campaign_faqs',
    ];

    public function campaigns()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
}

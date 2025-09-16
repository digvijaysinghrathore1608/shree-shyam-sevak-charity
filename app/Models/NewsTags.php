<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class NewsTags
 *
 * @version February 10, 2022, 10:05 am UTC
 *
 * @property string $name
 */
class NewsTags extends Model
{
    use HasFactory;

    public $table = 'news_tags';

    public $fillable = [
        'name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:news_tags|max:25',
    ];

    public function news()
    {
        return $this->belongsToMany(NewsTags::class, 'news_news_tags');
    }
}

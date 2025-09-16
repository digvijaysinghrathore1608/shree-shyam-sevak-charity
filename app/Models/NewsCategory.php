<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class NewsCategory
 *
 * @version February 11, 2022, 9:22 am UTC
 *
 * @property string $name
 */
class NewsCategory extends Model
{
    use HasFactory;

    public $table = 'news_categories';

    protected $with = ['news'];

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
        'name' => 'required|max:20|unique:news_categories',
    ];

    public function news()
    {
        return $this->hasMany(News::class, 'news_category_id');
    }
}

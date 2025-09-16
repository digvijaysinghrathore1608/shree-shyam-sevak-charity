<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';

    protected $fillable = [
        'name',
        'iso_code',
    ];

    protected $casts = [
        'name' => 'string',
        'iso_code' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:languages,name|max:20',
        'iso_code' => 'required|unique:languages,iso_code|max:2|min:2',
    ];
}

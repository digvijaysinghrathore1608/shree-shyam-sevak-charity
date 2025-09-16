<?php

namespace App\Http\Requests;

use App\Models\NewsComment;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsCommentsRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules()
    {
        return NewsComment::$rules;
    }
}

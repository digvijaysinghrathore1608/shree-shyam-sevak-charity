<?php

namespace App\Http\Requests;

use App\Models\SuccessStory;
use Illuminate\Foundation\Http\FormRequest;

class CreateSuccessStoryRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return SuccessStory::$rules;
    }
}

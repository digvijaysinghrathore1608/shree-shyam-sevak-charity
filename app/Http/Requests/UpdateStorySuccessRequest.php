<?php

namespace App\Http\Requests;

use App\Models\SuccessStory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStorySuccessRequest extends FormRequest
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
        $rules = SuccessStory::$rules;
        $rules['image'] = 'nullable';

        return $rules;
    }
}

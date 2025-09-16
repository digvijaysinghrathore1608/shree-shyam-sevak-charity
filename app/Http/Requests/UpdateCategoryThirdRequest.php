<?php

namespace App\Http\Requests;

use App\Models\CategoryThird;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryThirdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
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
        $rules = CategoryThird::$rules;
        $rules['title'] = 'required||max:50|unique:cms_3_categories,title,'.$this->id;
        $rules['image'] = 'nullable';

        return $rules;
    }
}

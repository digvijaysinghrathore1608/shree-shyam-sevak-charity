<?php

namespace App\Http\Requests;

use App\Models\NewsCategory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsCategoryRequest extends FormRequest
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
        $rules = NewsCategory::$rules;

        $category = (int) $this->route('news_category');

        $rules['name'] = 'required|max:20|unique:news_categories,name,'.$this->id;

        return $rules;
    }
}

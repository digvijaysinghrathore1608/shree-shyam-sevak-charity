<?php

namespace App\Http\Requests;

use App\Models\EventCategory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEventCategoryRequest extends FormRequest
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
        $rules = EventCategory::$rules;
        $rules['name'] = 'required|max:30|unique:event_categories,name,'.$this->id;
        $rules['image'] = 'mimes:jpg,jpeg,png';

        return $rules;
    }
}

<?php

namespace App\Http\Requests;

use App\Models\CampaignCategory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCampaignCategoryRequest extends FormRequest
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
        $rules = CampaignCategory::$rules;
        $rules['name'] = 'required|max:15|unique:campaign_categories,name,'.$this->route('campaign_category')->id;

        return $rules;
    }
}

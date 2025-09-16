<?php

namespace App\Http\Requests;

use App\Models\CampaignUpdate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCampaignUpdateRequest extends FormRequest
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
        $rules = CampaignUpdate::$rules;

        $rules['title'] = 'required|max:255|unique:campaign_updates,title,'.$this->route('campaign_update')->id;

        return $rules;
    }
}

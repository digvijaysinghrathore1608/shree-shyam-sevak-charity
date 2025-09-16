<?php

namespace App\Http\Requests;

use App\Models\Campaign;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCampaignRequest extends FormRequest
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
        $rules = Campaign::$rules;

        $rules['title'] = 'required|max:50|unique:campaigns,title,'.$this->route('campaign')->id;
        $rules['slug'] = 'required|max:15|unique:campaigns,slug,'.$this->route('campaign')->id;

        $rules['image'] = 'nullable';

        return $rules;
    }
}

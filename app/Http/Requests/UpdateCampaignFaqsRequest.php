<?php

namespace App\Http\Requests;

use App\Models\CampaignFaq;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCampaignFaqsRequest extends FormRequest
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
        $rules = CampaignFaq::$rules;

        $rules['title'] = 'required||max:255|unique:campaign_faqs,title,'.$this->route('campaign_faq')->id;

        return $rules;
    }
}

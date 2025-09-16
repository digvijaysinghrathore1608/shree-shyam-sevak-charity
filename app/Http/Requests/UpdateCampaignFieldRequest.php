<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCampaignFieldRequest extends FormRequest
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
        return [
            'goal' => 'required|integer',
            'recommended_amount' => 'required|integer',
            'amount_prefilled' => 'required|integer|lte:goal',
            'campaign_end_method' => 'required|integer',
            'country_id' => 'required|integer',
            'start_date' => 'required',
            'deadline' => 'required|after_or_equal:start_date',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'country_id.required' => 'Country field is required',
        ];
    }
}

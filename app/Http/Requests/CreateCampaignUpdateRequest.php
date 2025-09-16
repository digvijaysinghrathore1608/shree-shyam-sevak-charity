<?php

namespace App\Http\Requests;

use App\Models\CampaignUpdate;
use Illuminate\Foundation\Http\FormRequest;

class CreateCampaignUpdateRequest extends FormRequest
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
        return CampaignUpdate::$rules;
    }
}

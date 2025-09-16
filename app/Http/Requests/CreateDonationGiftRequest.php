<?php

namespace App\Http\Requests;

use App\Models\DonationGift;
use Illuminate\Foundation\Http\FormRequest;

class CreateDonationGiftRequest extends FormRequest
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
        return DonationGift::$rules;
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'gifts.*.*.required' => 'The gift field is required.',
        ];
    }
}

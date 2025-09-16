<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserSettingRequest extends FormRequest
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
            'email' => 'nullable|email:filter',
            'account_number' => 'nullable|numeric',
            'isbn_number' => 'nullable|string',
            'branch_name' => 'nullable|string',
            'account_holder_name' => 'nullable|string',
        ];
    }
}

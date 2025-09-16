<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email:filter|unique:users,email,'.$this->route('user')->id,
            'contact' => 'required',
            'gender' => 'required',
            'is_active' => 'nullable',
            'country_id' => 'required',
            'address' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'contact.required' => 'The phone no. field is required',
        ];
    }
}

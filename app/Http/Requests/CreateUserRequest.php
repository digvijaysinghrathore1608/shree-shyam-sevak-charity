<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'email' => 'required|email:filter|unique:users',
            'contact' => 'required',
            'gender' => 'required',
            'is_active' => 'nullable',
            'password' => 'required|same:password_confirmation|min:6',
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

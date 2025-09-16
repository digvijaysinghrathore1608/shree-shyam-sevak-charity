<?php

namespace App\Http\Requests;

use App\Models\Team;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamRequest extends FormRequest
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
        $rules = Team::$rules;

        $rules['name'] = 'required|unique:teams,name,'.$this->route('team')->id;
        $rules['image'] = 'mimes:jpg,jpeg,png';

        return $rules;
    }
}

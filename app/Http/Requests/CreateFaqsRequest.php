<?php

namespace App\Http\Requests;

use App\Models\Faqs;
use Illuminate\Foundation\Http\FormRequest;

class CreateFaqsRequest extends FormRequest
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
        return Faqs::$rules;
    }
}

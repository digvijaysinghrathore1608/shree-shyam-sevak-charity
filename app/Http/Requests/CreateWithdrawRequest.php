<?php

namespace App\Http\Requests;

use App\Models\Withdraw;
use Illuminate\Foundation\Http\FormRequest;

class CreateWithdrawRequest extends FormRequest
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
        if (request()->payment_type == Withdraw::PAYPAL) {
            return Withdraw::$paypalRules;
        }

        return Withdraw::$bankRules;
    }
}

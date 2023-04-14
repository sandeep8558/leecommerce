<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            "mobile" => ['required', 'min:10'],
            "email" => ['required', 'string', 'email', 'max:255'],
            "name" => ['required', 'string', 'max:255'],
            "address" => "required",
            "city" => "required",
            "pincode" => "required",
            "state" => "required",
            "country" => "required",
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PlayerRequest extends Request
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
            'full_name' => 'required',
            'school' => 'required',
            'birthdate' => 'required',
            'home' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'email|unique:users',
            'username' => 'unique:users|regex:/^[a-z]+[0-9]*$/u',
        ];
    }
}

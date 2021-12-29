<?php

namespace App\Http\Requests\Manager;

use Illuminate\Foundation\Http\FormRequest;

class ManagerLoginRequest extends FormRequest
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
            'email'     => ['required'],
            'password'  => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'email.required'     => 'ایمیل را وارد کنید',
            'password.required'  => 'رمزعبور را وارد کنید',
        ];
    }
}

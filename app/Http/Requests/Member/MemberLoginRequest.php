<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class MemberLoginRequest extends FormRequest
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
            'username'  => ['required'],
            'password'  => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'username.required'     => 'نام کاربری را وارد کنید',
            'password.required'  => 'رمزعبور را وارد کنید',
        ];
    }
}

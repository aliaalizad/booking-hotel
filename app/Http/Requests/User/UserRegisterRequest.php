<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name'      => ['required',],
            'email'     => ['required'],
            'password'  => ['required'],
            'cpassword' => ['required', 'same:password'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => 'نام را وارد کنید',
            'email.required'     => 'ایمیل را وارد کنید',
            'password.required'  => 'رمزعبور را وارد کنید',
            'cpassword.required' => 'تکرار رمز عبور را وارد کنید',
            'cpassword.same'     => 'تاییدیه رمز عبور و رمز عبور همخوانی ندارند',
        ];
    }
}

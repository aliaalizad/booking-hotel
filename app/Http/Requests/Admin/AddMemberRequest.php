<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddMemberRequest extends FormRequest
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
            'name' => ['required'],
            'username' => ['required','unique:members,username'],
            'password' => ['required'],
            'cpassword' => ['required', 'same:password'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام را وارد کنید',
            'username.required' => 'نام کاربری را وارد کنید',
            'username.unique' => 'نام کاربری وارد شده قبلا در سیستم ثبت شده است',
            'password.required' => 'رمز عبور را وارد کنید',
            'cpassword.required' => 'تکرار رمز عبور را وارد کنید',
            'cpassword.same' => 'رمز عبور و تکرار همخوانی ندارند'
        ];
    }
}

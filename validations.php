<?php

return [
    'phone' => ['required', 'regex:/(09)[0-9]{9}/', 'digits:11', 'numeric', 'bail'],

    'title' => ['required', 'string', 'max:60', 'bail'],
    'phone' => ['required', 'numeric', 'digits_between:7,11' , 'bail'],
    'address' => ['required', 'string', 'max:200', 'bail'],
    'min_bookable' => ['required','integer', 'min:1', 'bail'],
    'max_bookable' => ['required','integer', 'gte:min_bookable', 'bail'],
    'bookable_until' => ['required','integer', 'min:1', 'bail'],
    'manager' => ['required', 'exists:managers,id', 'bail'],

    'name' => ['bail', 'required', 'string', 'max:40'],
    'username' => ['bail', 'required','unique:managers,username', 'numeric', 'digits:10'],
    'mobile' => ['bail', 'required','unique:managers,phone', 'regex:/(09)[0-9]{9}/', 'numeric', 'digits:11'],
    'email' => ['bail', 'required','unique:managers,email', 'email'],
    'city' => ['required', 'exists:cities,id'],
    'password' => ['bail', 'required', Password::min(8)->letters()->numbers(), 'confirmed'],
    'bank_account' => ['bail', 'required', 'numeric', 'digits:24', 'unique:managers,bank_account'],
    'commission' => ['bail', 'required', 'numeric', 'between:0, 100'],
];

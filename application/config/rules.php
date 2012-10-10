<?php

//--------------------------------------------------------------------------
// Check for correct password. Custom message can be found in 'language/en/validation.php'.
//--------------------------------------------------------------------------
Validator::register('verify_password', function($attribute, $value, $parameters)
{
    return Hash::check($value, Auth::user()->pass);
});

//--------------------------------------------------------------------------
// Validation rules
//--------------------------------------------------------------------------
return array(

    'login' => array(
        'login_email'      => 'required|max:30|email|exists:users,email',
        'login_password'   => 'required|between:6,20',
    ),

    'change_password' => array(
        'current_password' => 'required|between:6,20|verify_password',
        'new_password'     => 'required|between:6,20|match:/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*)$/',
        'confirm_password' => 'required|same:new_password',
    ),

    'forgot_password' => array(
        'email'             => 'required|between:3,30|email|exists:users',
    ),

    'register' => array(
        'first_name'       => 'required|between:3,30|alpha_dash',
        'last_name'        => 'required|between:3,30|alpha_dash',
        'username'         => 'required|between:3,30|alpha_dash|unique:users',
        'email'            => 'required|between:3,30|email|unique:users',
        'password'         => 'required|between:6,20|match:/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*)$/',
        'confirm_password' => 'required|same:password',
    ),

    'add_page' => array(
        'title'            => 'required|max:64',
        'category_id'      => 'required|exists:categories,id',
        'description'      => 'required|max:128',
        'content'          => 'required|max:1024',
    ),

    'add_pdf' => array(
        'title'            => 'required|max:64',
        'description'      => 'required|max:128',
        'pdf'              => 'required|mimes:pdf|max:1000',
    ),
);

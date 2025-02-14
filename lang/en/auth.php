<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    "login_success" => "Login successful!",
    "login_error" => "An error occurred during login. Please try again.",
    "invalid_credentials" => "The provided credentials are invalid.",
    "logout_success" => "Logout successful.",
    "logout_error" => "An error occurred during logout. Please try again.",


    "_comment" => "Auth-login Validation messages.",

    "name_required" => "The name field is required.",
    "name_must_be_string" => "The name field must be string.",
    "name_max" => "The name filed must be at more 255 characters.",

    "email_exists" => "The email does not exist in our records.",
    "email_required" => "The email field is required.",
    "email_must_be_string" => "The email field must be string.",
    "email_unique" => "The email does exist in our records.",


    "password_required" => "The password field is required.",
    "password_must_be_string" => "The password must be a string.",
    "password_min" => "The password must be at least 6 characters.",


    "user_id_required" => "The user id is required",
    "user_id_integer" => "The user id must be an integer",
    "user_id_exists" => "The user id must be exist",

    "_comment" => "Auth-check is admin",
    "admin_check"=>"you are not admin",

];

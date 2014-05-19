<?php
namespace App\Services\Validators;
 
class AdminValidator extends Validator {
 
    public static $rules = array(
        'email'                      => 'required|email|unique:users',
        'password'                   => 'Required|Between:4,8|Confirmed',
        'password_confirmation'      => 'Required|Between:4,8',
    );
 
}
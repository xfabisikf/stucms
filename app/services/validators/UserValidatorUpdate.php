<?php
namespace App\Services\Validators;
 
class UserValidatorUpdate extends Validator {
 
    public static $rules = array(
        'password'               => 'Required|Between:4,8|Confirmed',
        'password_confirmation'  => 'Required|Between:4,8',
        'activated'              => 'required',
    );
 
}
<?php
namespace App\Services\Validators;
 
class SubjectValidator extends Validator {
 
    public static $rules = array(
        'title'    => 'required',
        'semester' => 'required',
        'body'     => 'required',
    );
 
}
<?php namespace App\Models;
 
class Subject extends \Eloquent {
 
    protected $table = 'subjects';
 
    public function author()
    {
        return $this->belongsTo('User');
    }
 
}
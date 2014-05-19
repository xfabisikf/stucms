<?php namespace App\Models;
 
class Settings extends \Eloquent {
 
    protected $table = 'settings';
 
    public function author()
    {
        return $this->belongsTo('User');
    }
 
}
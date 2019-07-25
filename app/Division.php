<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    
    protected $fillable = ['*'];

    public function department()
    {
    	return $this->hasMany('App\Department');
    }

    public function company()
    {
    	return $this->hasMany('App\Company');
    }
}

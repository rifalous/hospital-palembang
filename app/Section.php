<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['*'];


    public function department()
    {
    	return $this->belongsTo('App\Department');	
    }

}

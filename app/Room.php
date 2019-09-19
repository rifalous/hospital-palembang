<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['*'];
	
    public function level()
    {
    	return $this->belongsTo('App\Level');	
    }

    public function inpatient()
    {
    	return $this->hasOne('App\Inpatient', 'room_id');
    	
    }
    public function details()
    {
        return $this->hasOne('App\PasienData');
    }
}

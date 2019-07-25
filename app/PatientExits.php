<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientExits extends Model
{
	protected $hidden = ['created_at', 'updated_at'];
	protected $fillable = ['*'];

    public function room()
    {
        return $this->belongsTo('App\Room', 'room_id', 'id');
    }

    public function pasien()
    {
        return $this->belongsTo('App\Pasien','pasien_id', 'id');
    }
	
}

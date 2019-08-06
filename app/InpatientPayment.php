<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InpatientPayment extends Model
{
	protected $hidden = ['created_at', 'updated_at'];
    protected $guarded = ['diskon', 'discount'];
	protected $fillable = ['*'];

    public function room()
    {
        return $this->belongsTo('App\Room', 'room_id', 'id');
    }

    public function pasien()
    {
        return $this->belongsTo('App\Pasien','pasien_id', 'id');
	}
	
    public function patient_exits()
    {
        return $this->belongsTo('App\PatientExits','pasien_id', 'id');
	}
	
}

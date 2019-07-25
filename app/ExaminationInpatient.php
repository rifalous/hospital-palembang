<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationInpatient extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['*'];
    protected $table = 'examination_inpatient';

     public function inpatient()
    {
        return $this->belongsTo('App\Inpatient', 'registration_id');
        
    }

    public function pasien()
    {
        return $this->belongsTo('App\Pasien','pasien_id', 'id');
    }

    public function data(){
    	return $this->hasMany(ExaminationInpatientData::class, 'examination_inpatient_id');
    }

    public function detail(){
    	return $this->hasMany(ExaminationInpatientDetail::class, 'examination_inpatient_id');
    }
}

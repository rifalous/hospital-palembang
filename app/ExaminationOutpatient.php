<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationOutpatient extends Model
{
	protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['*'];

    public function outpatient()
    {
        return $this->belongsTo('App\Outpatient', 'outpatient_id');
        
    }

    public function details()
    {
    	return $this->hasMany(ExaminationOutpatientData::class, 'examination_outpatient_id');
    }

    public function material()
    {
        return $this->hasMany(ExaminationOutpatientDetail::class, 'examination_outpatient_id');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor','doctor_id', 'id');
    }

    public function pasien()
    {
        return $this->belongsTo('App\Pasien','pasien_id', 'id');
    }

    public function material1()
    {
        return $this->belongsTo('App\Material','material_id', 'id');
    }

    public function action()
    {
        return $this->belongsTo('App\Action','action_id', 'id');
    }

    public function labs(){
    	return $this->hasMany(ExaminationOutpatientLab::class, 'examination_outpatient_id');
    }

}

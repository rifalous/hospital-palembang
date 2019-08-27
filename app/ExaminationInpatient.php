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
        return $this->belongsTo('App\Inpatient', 'inpatient_id');   
    }

    public function details()
    {
        return $this->hasMany(ExaminationInpatientData::class, 'examination_inpatient_id');
    }

    public function material()
    {
        return $this->hasMany(ExaminationInpatientDetail::class, 'examination_inpatient_id');
    }

    public function data(){
    	return $this->hasMany(ExaminationInpatientData::class, 'examination_inpatient_id');
    }

    public function detail(){
    	return $this->hasMany(ExaminationInpatientDetail::class, 'examination_inpatient_id');
    }

    public function labs(){
    	return $this->hasMany(ExaminationInpatientLab::class, 'examination_inpatient_id');
    }

    public function action()
    {
        return $this->belongsTo('App\Action','action_id', 'id');
    }

}

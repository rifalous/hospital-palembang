<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationInpatientLab extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
	protected $fillable = ['*'];

    public function doctor()
    {
        return $this->belongsTo('App\Doctor','doctor_id', 'id');
    }

    public function lab()
    {
        return $this->belongsTo('App\Laboratorium','lab_id', 'id');
    }
    public function ExaminationInpatient()
    {
    	return $this->belogsToMany(ExaminationInpatient::class, 'examination_inpatient_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationOutpatientLab extends Model
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
    public function ExaminationOutpatient()
    {
    	return $this->belogsToMany(ExaminationOutpatient::class, 'examination_outpatient_id');
    }
}

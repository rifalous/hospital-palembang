<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationOutpatientData extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
	protected $fillable = ['*'];

	public function action()
    {
        return $this->belongsTo('App\Action','action_id', 'id');
    }

	public function material()
    {
        return $this->belongsTo('App\Material','material_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor','doctor_id', 'id');
    }

    public function ExaminationOutpatient()
    {
    	return $this->belogsToMany(ExaminationOutpatient::class, 'examination_outpatient_id');
    }
}

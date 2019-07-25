<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationInpatientData extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
	protected $fillable = ['*'];
	protected $table = 'examination_inpatient_data';

	public function action()
    {
        return $this->belongsTo(Action::class, 'action_id');
    }

    public function ExaminationOutpatient()
    {
    	return $this->belogsToMany(ExaminationOutpatient::class, 'examination_outpatient_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationInpatientDetail extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['*'];

    public function material() 
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor','doctor_id', 'id');
    }

    public function ExaminationInpatient()
    {
    	return $this->belogsToMany(ExaminationInpatient::class, 'examination_inpatient_id');
    }


}

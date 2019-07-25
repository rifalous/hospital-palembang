<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationInpatientDetail extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['*'];
    protected $table = 'examination_inpatient_detail';

    public function material(){
    	return $this->belongsTo(Material::class, 'material_id');
    }

    public function examination_inpatient(){
    	return $this->belogsToMany(ExaminationInpatient::class, 'examination_inpatient_id');
    }
}

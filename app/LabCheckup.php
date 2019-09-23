<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabCheckup extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['*'];
    protected $table = 'lab_checkup';

    public function inpatient()
    {
        return $this->belongsTo('App\Inpatient', 'inpatient_id');   
    }

    public function labo()
    {
        return $this->hasMany(ExaminationLabCheckup::class, 'examination_checkup_id');
    }

    public function lab()
    {
        return $this->belongsTo('App\Laboratorium','lab_id', 'id');
    }

    public function test()
    {
        return $this->belongsTo('App\ExaminationLabCheckup','lab_id', 'id');
    }
}

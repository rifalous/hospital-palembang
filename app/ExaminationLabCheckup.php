<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationLabCheckup extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['*'];
    protected $table = 'examination_lab_checkup';

    public function LabCheckup()
    {
        return $this->belogsToMany(LabCheckup::class, 'examination_checkup_id');
    }

    public function lab()
    {
        return $this->belongsTo('App\Laboratorium','lab_id', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Doctor extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['*'];

    public function inpatient()
    {
    	return $this->hasOne('App\Inpatient', 'doctor_id');
    	
    }

    public function outpatient()
    {
    	return $this->hasOne('App\Outpatient', 'doctor_id');
    	
    }

    public static function getCodeDoctor()
    {
        // $code_doctor = 'DK';
        $q = DB::table('doctors')->select('code as code_r');
        
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->code_r)+1;
                $code_dr = sprintf("%03s", $tmp);
            }
        }
        else
        {
            $code_dr = "001";
        }

        return $code_dr;
    }

    public function examination_outpatient()
    {
        return $this->hasOne('App\ExaminationOutpatient', 'doctor_id');
        
    }

    public function examination_outpatient_data()
    {
        return $this->hasOne('App\ExaminationOutpatientData', 'doctor_id');
        
    }

    public function ExaminationOutpatientDetail()
    {
        return $this->hasOne('App\ExaminationOutpatientDetail', 'doctor_id');
        
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Inpatient extends Model
{
	protected $hidden = ['created_at', 'updated_at'];
	protected $fillable = ['*'];

    public function room()
    {
        return $this->belongsTo('App\Room', 'room_id', 'id');
    }
    
    public function doctor()
    {
        return $this->belongsTo('App\Doctor','doctor_id', 'id');
    }

    public function pasien()
    {
        return $this->belongsTo('App\Pasien','pasien_id', 'id');
    }

    public function examination()
    {
        return $this->hasMany('App\ExaminationPatient');
    }

     public function examination_inpatient()
    {
        return $this->hasOne('App\ExaminationInpatient');
    }

    public static function getCodeInpatient()
    {
        // $code_doctor = 'DK';
        $q = DB::table('inpatients')->select('no_registrasi as no_registrasi');
        
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->no_registrasi)+1;
                $code_dr = sprintf("%03s", $tmp);
            }
        }
        else
        {
            $code_dr = "001";
        }

        return $code_dr;
    }
}

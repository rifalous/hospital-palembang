<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Outpatient extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
	protected $fillable = ['*'];

    
    
    public function doctor()
    {
        return $this->belongsTo('App\Doctor','doctor_id', 'id');
    }

    public function pasien()
    {
        return $this->belongsTo('App\Pasien','pasien_id', 'id');
    }

    public function examination_outpatient()
    {
        return $this->hasOne('App\ExaminationOutpatient');
    }

    public static function getCodeOutpatient()
    {
        // $code_doctor = 'DK';
        $q = DB::table('outpatients')->select('no_registrasi as no_registrasi');
        
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

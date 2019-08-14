<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pasien extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $guarded = ['no_bpjs'];
	protected $fillable = ['*'];
    
    public function details()
    {
        return $this->hasOne('App\PasienData');
    }

    public function inpatient()
    {
        return $this->hasOne('App\Inpatient', 'pasien_id');
        
    }

    public function outpatient()
    {
        return $this->hasOne('App\Outpatient', 'pasien_id');
        
    }

    public static function getRegistrationNumber()
    {
        // $code = 'PS';
        $q = DB::table('pasiens')->select('no_rm as no_rm');
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->no_rm)+1;
                $code_rm = sprintf("%08s", $tmp);
            }
        }
        else
        {
            $code_rm = "00000001";
        }

        return $code_rm;
    }

    public function payment()
    {
        return $this->hasOne('App\Payment', 'pasien_id');
        
    }


   
}


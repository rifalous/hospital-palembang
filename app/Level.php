<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Level extends Model
{
     protected $fillable = ['*'];

    public static function getCodeLevel()
    {
        
        $q = DB::table('levels')->select('code as code_r');
        
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
}

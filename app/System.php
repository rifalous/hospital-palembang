<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    public function scopeConfig($query, $code)
    {

    	$config = $query->select('system_val')
    					->where('system_type', 'config_other')
    					->where('system_code', $code)
    					->first();


        if (!empty($config)) {

            $data_result = [];

            $data_config = explode(';', $config->system_val);

            

            foreach ($data_config as $data) {

                $data_result[] = ['id' => $data, 'text' => $data];

            }

        }

        else {

            $data_result = [['id' => '', 'text' => '']];

        }

    	return collect($data_result);

    }

    public function scopeConfigMultiply($query, $code)
    {
        $config = $query->select('system_val')
                        ->where('system_code', $code)
                        ->where('system_type', 'config_multiply')
                        ->first();

        if (!empty($config)) {

            $array = explode(';', $config->system_val);
            $array_3 = [];

            foreach ($array as $data_array) {
                $array_2 = explode(',', $data_array);
                $array_3[] = ['id' => $array_2[0], 'text' => $array_2[1]];
            }

            $data_result = $array_3;
        
        } else {
             $data_result = [['id' => '', 'text' => '']];
        }

        return collect($data_result);

    }
}

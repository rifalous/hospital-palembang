<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function scopeGetValue($query, $setting)
    {
    	$result = $query->where('key', $setting)
    					->first();

    	return json_decode($result->value);
    }
}

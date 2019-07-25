<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'supplier_code', 'supplier_name', 
    ];

    public function item()
    {
    	return $this->hasMany('App\Item');	
    }

}

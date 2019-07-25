<?php

namespace App\Temporary;

use Illuminate\Database\Eloquent\Model;

class TemporaryBom extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
	protected $fillable = ['*'];

    public function parts()
    {
        return $this->belongsTo('App\Part', 'part_number', 'part_number');
    }
     public function suppliers()
    {
        return $this->belongsTo('App\Supplier','supplier_code', 'supplier_code');
    }
    public function details_temporary()
    {
    	return $this->hasMany('App\Temporary\TemporaryBomData', 'part_id_head', 'part_number');
    }
}

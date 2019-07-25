<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
	protected $fillable = ['*'];
    protected $hidden = ['created_at', 'updated_at'];
    
    public function supplier()
    {
        return $this->belongsTo('App\Supplier','supplier_id', 'id');
    }
}

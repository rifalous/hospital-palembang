<?php

namespace App\Temporary;

use Illuminate\Database\Eloquent\Model;

class TemporaryBomData extends Model
{
    protected $fillable = ['*'];
    public function parts()
    {
        return $this->belongsTo('App\Part', 'part_number', 'part_number');
    }
     public function suppliers()
    {
        return $this->belongsTo('App\Supplier','supplier_code', 'supplier_code');
    }
}

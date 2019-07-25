<?php

namespace App\SapModel;

use Illuminate\Database\Eloquent\Model;

class SapTaxe extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
	protected $fillable = ['*'];
}

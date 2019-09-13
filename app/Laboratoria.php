<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratoria extends Model
{
    public $table = "laboratoria";
    protected $hidden = ['created_at', 'updated_at'];
	protected $fillable = ['*'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasienData extends Model
{
	protected $hidden = ['created_at', 'updated_at'];
	protected $fillable = ['*'];
	
    public function pasien()
    {
        return $this->belongsTo('App\Pasien', 'pasien_id', 'id');
    }
}

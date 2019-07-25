<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserData extends Model
{

	use SoftDeletes;

	protected $hidden = [
							'created_at', 'updated_at'
						];

	protected $dates = ['deleted_at'];
	protected $fillable = ['*'];

}

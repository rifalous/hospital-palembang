<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    use EntrustUserTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];



    public function user_data()
    {
        return $this->hasOne('App\UserData');

    }

    public function division()
    {
        return $this->belongsTo('App\Division');    
    }

    public function department()
    {
        return $this->belongsTo('App\Department');    
    }

    public function getGravatarAttribute()
    {
        return !empty($this->photo) && file_exists($this->photo) ? url($this->photo) : \Gravatar::src($this->email);

    }

}

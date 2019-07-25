<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
   public function parent(){
   	return $this->hasOne('App\Permission', 'id', 'parent_id');

   }
   public function children(){
   	return $this->hasMany('App\Permission', 'parent_id');

   }
}

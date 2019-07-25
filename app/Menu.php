<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    public function parent()
    {
    	return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Menu', 'parent_id')
                    ->orderby('order_number');
    }

    public function scopeList($query, $parent_id)
    {
    	return $query->where('parent_id', $parent_id)
                    ->where('is_showed', 1)
    				->orderby('order_number', 'asc');

    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'item_id', 'qty', 'total', 'price', 'reason'];

    public function item()
    {
        return $this->belongsTo('App\Item');
    }
    
    public function scopeCountTotal($query)
    {
        if (auth()->check()) {
            return $query->where('user_id', auth()->user()->id)
                        ->get();
        }

        return collect([]);
    }
}

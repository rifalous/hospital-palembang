<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function set($type)
    {	
    	session(['currency' => $type]);
    	return redirect()->back();
    }
}

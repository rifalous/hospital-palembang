<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoginHistory;
use Carbon\Carbon;

class LoginHistoryController extends Controller
{
    public function login(Request $request)
    {
    	$login_history = new LoginHistory;
        $login_history->user_id = auth()->user()->id;
        $login_history->datetime = Carbon::now();
        $login_history->type = 0;
        $login_history->save();

        return response()->json($login_history, 200);
    }

    public function logout(Request $request)
    {
    	$login_history = new LoginHistory;
        $login_history->user_id = auth()->user()->id;
        $login_history->datetime = Carbon::now();
        $login_history->type = 1;
        $login_history->save();

        return response()->json($login_history, 200);
    }
}

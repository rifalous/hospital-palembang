<?php

namespace App\Http\Middleware;

use Closure;

class AllowUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       if (request()->ajax()) {
            return $next($request);
        } else {
            $allow = Menu::where('url', 'like', '%'.request()->segment(1).'%')
                    ->first();
                    
            $user_group = ($allow) ? $allow->user_group : null;
            $exp_id = explode(';', $user_group); 
                    
            if (in_array(Auth::user()->user_group, $exp_id)) {
                return $next($request);
            } else {
                return abort('403');    
            }
        }  
    }
}

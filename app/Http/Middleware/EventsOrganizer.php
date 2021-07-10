<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class EventsOrganizer
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
        if(Auth::user()->user_type == 'provider_man'){ 
            return redirect()->route('provider-man.home');
        }elseif(Auth::user()->user_type == 'staff'){ 
            return redirect()->route('admin.home');
        }
        return $next($request);
    }
}

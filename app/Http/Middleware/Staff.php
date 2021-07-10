<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Staff
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
        }elseif(Auth::user()->user_type == 'events_organizer'){ 
            return redirect()->route('events-organizer.home');
        }
        return $next($request);
    }
}

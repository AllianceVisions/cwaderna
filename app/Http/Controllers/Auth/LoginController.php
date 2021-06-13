<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated($request , $user){
        if($user->user_type =='staff'){
            return redirect()->route('admin.home') ;
        }elseif($user->user_type == 'provider_man'){
            return redirect()->route('provider-man.home') ;
        }elseif($user->user_type == 'events_organizer'){
            return redirect()->route('events-organizer.home') ;
        }elseif($user->user_type == 'cader'){
            return redirect()->route('cader.home') ;
        }
    }
}

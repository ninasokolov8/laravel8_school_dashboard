<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use RedirectsUsers;
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
    protected function authenticated(Request $request, $user)
    {
        $roleName = $user->getRoleName($user->id);
        $user->role = $roleName;
        if($roleName){
            $this->redirectTo = RouteServiceProvider::DASHBOARD[$roleName];
            session(['route'=> $this->redirectTo,'user'=>$user]);
        }
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    public function login(Request $request)
    {
        $input=$request->all();
        if(auth()->attempt(array("email" => $input["email"],"password" => $input["password"])))
        {
            // dd(auth()->user()->type);
            if(auth()->user()->type == 2)
            {
                // return "Admin";
                return redirect()->route('admin.home');

            }
            elseif(auth()->user()->type == 1)
            {
                // return "Manegere";
                return redirect()->route('manager.home');
            }
            else
            {
                // return "User";
                return redirect()->route('user.home');
            }
        }
        else
        {
            return "Invalid user";
        }
    }


}

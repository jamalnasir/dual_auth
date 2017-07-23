<?php

namespace App\Http\Controllers\Cp\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = '/admin';
    protected $redirectAfterLogout = '/admin/login';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){
        return view('cp.auth.login');
    }
    public function login(Request $request){
        if (Auth::guard('admin')->attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            return Redirect::to('/admin');
        } else {
            session()->flash('error', 'Username/password is invalid.');
            return Redirect::to('/admin/login');
        }

    }


    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->to('/admin');

    }

}

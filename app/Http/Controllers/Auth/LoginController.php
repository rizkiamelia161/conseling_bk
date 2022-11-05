<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

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
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock'
        ]);
    }

    /** login view */
    public function login()
    {
        return view('auth.login');
    }

    /** login form */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $username  = '@gmail.com';
        $email     = $request->email . $username;
        $password  = $request->password;
        $dt        = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        if (Auth::attempt(['email'=>$email,'password'=>$password,'status'=>'Active'])) {
            Toastr::success('Login successfully :)','Success');
            return redirect()->intended('home');
        } elseif (Auth::attempt(['email'=>$email,'password'=>$password,'status'=> null])) {
            Toastr::success('Login successfully :)','Success');
            return redirect()->intended('home');
        } else {
            Toastr::error('fail, WRONG USERNAME OR PASSWORD :)','Error');
            return redirect('login');
        }
    }

    /** logout */
    public function logout()
    {
        $user = Auth::User();
        Session::put('user', $user);
        $user = Session::get('user');
        Auth::logout();
        Toastr::success('Logout successfully :)','Success');
        return redirect('login');
    }
}

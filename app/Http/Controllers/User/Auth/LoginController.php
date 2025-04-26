<?php

namespace App\Http\Controllers\User\Auth;                       

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;                       

class LoginController extends Controller
{
    // use AuthenticatesUsers;                              
    use AuthenticatesUsers {                                
        logout as performLogout;                            
    }                                                       

    protected function redirectTo()
    {
    return route('user.top');
    }  
   
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout'); 
    }


    protected function guard()                              
    {                                                       
        return Auth::guard('user');                        
    }                  
    
    public function login(Request $request)
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string', 'min:8'],
    ],trans('validation.login'));


    $credentials = $request->only('email', 'password');

    if (Auth::guard('user')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('user.top'); 
    }

    return back()->withErrors([
        'email' => 'ログイン情報が正しくありません。', 
    ])->withInput();
}


    public function logout(Request $request)                
    {                                                       
        $this->performLogout($request);                     
        return redirect('user/login');                     
    }                                                       
}
<?php

namespace App\Http\Controllers\Admin\Auth;                       

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
    return route('admin.top');
    }  
   
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout'); 
    }


    protected function guard()                              
    {                                                       
        return Auth::guard('admin');                        
    }                  
    
    public function login(Request $request)
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string', 'min:8'],
    ],trans('validation.login'));


    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('admin.top'); 
    }

    return back()->withErrors([
        'email' => 'ログイン情報が正しくありません。', 
    ])->withInput();
}


    public function logout(Request $request)                
    {                                                       
        $this->performLogout($request);                     
        return redirect('admin/login');                     
    }                                                       
}
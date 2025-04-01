<?php

namespace App\Http\Controllers\admin;                       

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;                        

class LoginController extends Controller
{
    // use AuthenticatesUsers;                              
    use AuthenticatesUsers {                                
        logout as performLogout;                            
    }                                                       

    protected $redirectTo = '/admin/home';                  


    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout'); 
    }


    protected function guard()                              
    {                                                       
        return Auth::guard('admin');                        
    }                                                       


    public function logout(Request $request)                
    {                                                       
        $this->performLogout($request);                     
        return redirect('admin/login');                     
    }                                                       
}
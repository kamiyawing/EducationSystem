<?php
namespace App\Http\Controllers\Admin\Auth;       

use App\Http\Controllers\Controller;
use App\Models\Admin;                         
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;  
use Illuminate\Http\Request;   
use App\Http\Requests\RegisterRequest;        

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/admin/top';      

    public function __construct()
    {
        $this->middleware('guest:admin');      
    }

    protected function guard()                  
    {                                           
        return Auth::guard('admin');           
    }                                           
    

    public function register(RegisterRequest $request)
    { 
        $credentials = $request->only('name','kana','email', 'password');

        $admin = Admin::create([
            'name' => $request->name,
            'kana' => $request->kana,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

    

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.top')->with('success', '管理者登録が完了しました。');
    }
}

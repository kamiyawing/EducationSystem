<?php
namespace App\Http\Controllers\Admin\Auth;       

use App\Http\Controllers\Controller;
use App\Models\Admin;                         
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;  
use Illuminate\Http\Request;          

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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:admins,name'],
            'kana' => ['required', 'regex:/^[ァ-ヶー]+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], trans('validation.register'));
    }
    

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();  

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

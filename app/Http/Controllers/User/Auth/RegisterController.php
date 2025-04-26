<?php
namespace App\Http\Controllers\User\Auth;       

use App\Http\Controllers\Controller;
use App\Models\User;                         
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;  
use Illuminate\Http\Request;          

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/user/top';      

    public function __construct()
    {
        $this->middleware('guest:user');      
    }

    protected function guard()                  
    {                                           
        return Auth::guard('user');           
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

        $user = User::create([
            'name' => $request->name,
            'kana' => $request->kana,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

    

        Auth::guard('user')->login($user);

        return redirect()->route('user.top')->with('success', 'ユーザー登録が完了しました。');
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    public function index()
    {
         
        if (!Auth::guard('user')->check()) {
            return redirect()->route('user.login.form');
        }

        return view('user.top');
    }
}

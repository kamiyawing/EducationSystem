<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index()
    {
        return view('/'); // ビューは存在している前提
    }
}

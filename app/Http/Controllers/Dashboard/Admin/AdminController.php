<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:ROLE_ADMIN');
    }

    public function index()
    {
        return view('dashboard.admin.home');
    }
    public function users(Request $request){
        return redirect()->route('user.index');
       // return redirect()->route('user.edit',[4]);
    }

}

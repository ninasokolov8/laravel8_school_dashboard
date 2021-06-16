<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_TEACHER');
    }

    public function index()
    {
        return view('superadmin.home');
    }
}

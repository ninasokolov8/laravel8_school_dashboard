<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
      public function __construct()
    {
    }

    public function index()
    {
        return view('dashboard.teacher.home');
    }
}

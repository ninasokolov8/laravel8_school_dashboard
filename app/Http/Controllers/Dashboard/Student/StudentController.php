<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
      public function __construct()
    {
    }

    public function index()
    {
        return view('dashboard.student.home');
    }
}

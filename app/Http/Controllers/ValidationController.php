<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function index(Request $request)
    {
        return view('validator.students');
    }
}

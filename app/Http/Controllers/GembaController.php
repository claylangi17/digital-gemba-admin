<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GembaController extends Controller
{
    public function index() 
    {
        return view('gemba.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Lines;
use Illuminate\Http\Request;

class LineController extends Controller
{
    public function get()
    {
        $data = Lines::all();

        return $data;
    }
}

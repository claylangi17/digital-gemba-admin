<?php

namespace App\Http\Controllers;

use App\Models\Lines;

class LineController extends Controller
{
    public function get()
    {
        $data = Lines::all();

        return $data;
    }
}

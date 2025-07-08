<?php

namespace App\Http\Controllers;

use App\Models\GenbaSessions;

class WebController extends Controller
{
    public function index()
    {
        $data = [
            "sessions" => GenbaSessions::all()->sortByDesc('created_at')
        ];

        return view('index', $data);
    }
}

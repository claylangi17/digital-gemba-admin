<?php

namespace App\Http\Controllers;

use App\Models\GenbaSessions;
use Illuminate\Http\Request;
use Ramsey\Collection\Sort;

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

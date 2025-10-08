<?php

namespace App\Http\Controllers;

use App\Models\Lines;
use Illuminate\Http\Request;

class SpinwheelController extends Controller
{
    /**
     * Display the spinwheel page
     */
    public function index()
    {
        $lines = Lines::orderBy('name', 'asc')->get();
        return view('spinwheel.index', compact('lines'));
    }

    /**
     * Get all lines for AJAX request
     */
    public function getLines()
    {
        $lines = Lines::orderBy('name', 'asc')->get(['id', 'name', 'description']);
        return response()->json([
            'success' => true,
            'data' => $lines
        ]);
    }
}

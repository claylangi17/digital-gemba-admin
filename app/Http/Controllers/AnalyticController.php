<?php

namespace App\Http\Controllers;

use App\Models\Actions;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class AnalyticController extends Controller
{
    public function index()
    {
        $data = [
            "overdue_actions" => Actions::whereDate("due_date", "<", Carbon::now())->get()
        ];
        
        return view('gemba.analytics', $data);
    }
}

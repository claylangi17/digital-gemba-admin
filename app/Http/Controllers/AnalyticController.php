<?php

namespace App\Http\Controllers;

use App\Models\Actions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AnalyticController extends Controller
{
    public function index()
    {
        $data = [
            "overdue_actions" => Actions::where("status", "PROGRESS")->whereDate("due_date", "<", Carbon::now())->get()
        ];
        
        return view('gemba.analytics', $data);
    }

    // API Functions

    // Authentication Barrier 
    public function check_auth()
    {
        if (Auth::check())
        {
            return true;
        } else {
            return false;
        };
    }

    public function get_actions_count()
    {
        try {
            $actions = Actions::all();
    
            $overdue = $actions->where('status', "PROGRESS")->whereDate('due_date', '<', Carbon::now())->count();
            $finish = $actions->where("status", "FINISH")->count();
            $progress = $actions->where('status', "PROGRESS")->whereDate('due_date', '>=', Carbon::now())->count();
    
            return response()->json([
                "status" => "success",
                "code" => 200,
                "data" => [
                    "overdue" => [
                        "name" => "overdue",
                        "count" => $overdue
                    ],
                    "progress" => [
                        "name" => "progress",
                        "count" => $progress
                    ],
                    "finish" => [
                        "name" => "finish",
                        "count" => $finish
                    ],
                ]
            ], 200);
    
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "error",
                "code" => 500,
                "message" => "Failed to get actions count.",
                "error" => $th->getMessage(), // optional
            ], 500);
        }

    } 
}

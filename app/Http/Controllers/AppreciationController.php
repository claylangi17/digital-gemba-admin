<?php

namespace App\Http\Controllers;

use App\Models\AppreciationNotes;
use App\Models\PointHistories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class AppreciationController extends Controller
{
    public function index()
    {
        $topUsers = User::orderByDesc('points')->take(3)->get();

        $topUserIds = $topUsers->pluck('id')->toArray();

        $otherUsers = User::whereNotIn('id', $topUserIds)
                          ->orderByDesc('points') 
                          ->get();

        $data = [
            "users" => $otherUsers, 
            "top" => $topUsers      
        ];

        return view('appreciation', $data);
    }
    
    public function create(Request $request)
    {

        try {

            $request->validate([
                "session_id" => "required",
                "line" => "required",
                "receivers" => "required",
                "description" => "required",
            ]);

            if ($request->hasFile('photos'))
            {
                $path = $request->file('photos')->store('uploads/appreciation/note', 'public');
            } else {
                $path = '';
            }


            $receivers_array = explode(',', $request->receivers);
            $receivers_id = [];
            $receivers_name = [];

            foreach ($receivers_array as $person) {
                $temp = explode("#",$person);

                $receivers_id[] = $temp[0];
                $receivers_name[] = $temp[1];
            }

            AppreciationNotes::create([
                'session_id' => $request->session_id,
                'by' => Auth::user()->name,
                'receivers_id' => implode(",",$receivers_id),
                'receivers_name' => implode(", ",$receivers_name),
                'line' => $request->line,
                'description' => $request->description,
                'files' => $path
            ]);

            foreach ($receivers_id as $receiver) {

                $user = User::where('id', $receiver)->first();

                $point_before = (int) $user->points;
                $point_after = $point_before + 10;
                
                PointHistories::create([
                    'userid' => $receiver,
                    'type' =>  "INC",
                    'category' =>  "NOTE",
                    'point_before' =>  $point_before,
                    'point_earned' => 10,
                    'point_after' =>  $point_after
                ]);

                User::where('id', $receiver)->update([
                    "points" => $point_after
                ]);

            }

            Alert::toast('Berhasil Menambahkan Catatan Apresiasi', 'success')->position('top-end')->timerProgressBar();

            return redirect()->back();
    
        } catch (\Exception $e) {
            Log::error('Failed to create Appreciation Notes', ['error' => $e->getMessage()]);
    
            Alert::toast('Gagal: ' . $e->getMessage(), 'error')
            ->position('top-end')
            ->timerProgressBar();
    
            return redirect()->back()->withInput();
        } 

    }
}

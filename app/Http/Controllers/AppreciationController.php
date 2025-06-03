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
    public function create(Request $request)
    {

        try {

            $request->validate([
                "session_id" => "required",
                "line" => "required",
                "receivers" => "required",
                "description" => "required",
            ]);

            $path = $request->file('photos')->store('uploads/appreciation/note', 'public');

            AppreciationNotes::create([
                'session_id' => $request->session_id,
                'by' => Auth::user()->name,
                'receivers' => $request->receivers,
                'line' => $request->line,
                'description' => $request->description,
                'files' => $path
            ]);

            $receivers = explode(',', $request->receivers);

            foreach ($receivers as $receiver) {

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

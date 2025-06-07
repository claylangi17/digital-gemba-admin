<?php

namespace App\Http\Controllers;

use App\Models\AppreciationNotes;
use App\Models\Attendances;
use App\Models\PointHistories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    public function create(Request $request)
    {
        try {

            $request->validate([
                "user_ids" => "required",
                "session_id" => "required"
            ]);

            $user_ids = explode(',', $request->user_ids);

            foreach ($user_ids as $id){

                if (!Attendances::where('session_id', $request->session_id)->where('user_id', $id)->exists())
                {
                    Attendances::create([
                        'session_id' =>  $request->session_id,
                        'user_id' => $id,
                        'status' => "ABSENT",
                    ]);
                }
                
            }

            Alert::toast('Peserta Berhasil Ditambahkan', 'success')->position('top-end')->timerProgressBar();

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

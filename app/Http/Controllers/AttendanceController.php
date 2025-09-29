<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function create(Request $request)
    {
        try {

            $request->validate([
                "user_ids" => "required",
                "session_id" => "required"
            ]);

            // Parse user ids and insert them into session attendance 
            $user_ids = explode(',', $request->user_ids);
            foreach ($user_ids as $id){

                if (!Attendances::where('session_id', $request->session_id)->where('user_id', $id)->exists())
                {
                    Attendances::create([
                        'session_id' =>  $request->session_id,
                        'user_id' => $id,
                        'status' => "PRESENT",
                        'time_in' => Carbon::now(),
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

    public function delete($id)
    {
        $action = Attendances::find($id);
        if ($action) {
            $action->delete();
            Alert::toast('Peserta Berhasil Dihapus!', 'success')->position('top-end')->timerProgressBar();
        } else {
            Alert::toast('Peserta Tidak Ditemukan', 'error')->position('top-end')->timerProgressBar();
        }

        return redirect()->back();
    }
}

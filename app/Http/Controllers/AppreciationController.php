<?php

namespace App\Http\Controllers;

use App\Models\AppreciationNotes;
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

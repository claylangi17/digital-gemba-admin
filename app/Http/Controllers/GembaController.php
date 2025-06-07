<?php

namespace App\Http\Controllers;

use App\Models\AppreciationNotes;
use App\Models\Attendances;
use App\Models\GenbaSessions;
use App\Models\Lines;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GembaController extends Controller
{
    public function index() 
    {
        return view('gemba.index');
    }

    public function create(Request $request) 
    {
        
        try {
            $request->validate([
                'name' => 'required',
            ]);
    
            $genba = GenbaSessions::create([
                            'name' => $request->name,
                            'created_by' => Auth::user()->name
                        ]);
    
            return redirect()->route('genba.view', [$genba->id]);
    
        } catch (\Exception $e) {
            Log::error('Failed to create GenbaSession', ['error' => $e->getMessage()]);
    
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
    }

    public function view($id)
    {
        $data = [
            "genba" => GenbaSessions::where('id', $id)->first(),
            "attendances" => Attendances::where('session_id', $id)->get(),
            "appreciations" => AppreciationNotes::where('session_id', $id)->get(),
            "users" => User::all(),
            "lines" => Lines::all(),
        ];
        
        return view('gemba.view', $data);
    }


}

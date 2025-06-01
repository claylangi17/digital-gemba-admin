<?php

namespace App\Http\Controllers;

use App\Models\GenbaSessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

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
        return view('gemba.view');
    }
}

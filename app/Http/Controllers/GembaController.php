<?php

namespace App\Http\Controllers;

use App\Models\AppreciationNotes;
use App\Models\Attendances;
use App\Models\GenbaSessions;
use App\Models\Issues;
use App\Models\Items;
use App\Models\Lines;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class GembaController extends Controller
{
    public function index() 
    {
        $data = [
            "genbas" => GenbaSessions::orderByDesc('created_at')->get()
        ];
        
        return view('gemba.index', $data);
    }

    public function create(Request $request) 
    {
        try {
            $request->validate([
                'name' => 'required',
                'start_time' => 'required'
            ]);

            // Parse timedate format 
            $carbon = Carbon::createFromFormat('d/m/Y H:i', $request->start_time);
            $start_time = $carbon->format('Y-m-d H:i:s');
    
            // Create Session 
            $genba = GenbaSessions::create([
                            'name' => $request->name,
                            'created_by' => Auth::user()->name,
                            'start_time' => $start_time
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
        // Message for sweetalert delete confirmation 
        $title = 'Hapus Peserta!';
        $text = "Apakah kamu yakin untuk menghapus peserta ini?";
        confirmDelete($title, $text);
        
        // Collect Data from related session 
        $data = [
            "genba" => GenbaSessions::where('id', $id)->first(),
            "issues" => Issues::where('session_id', $id)->orderBy('created_at', 'DESC')->get(),
            "attendances" => Attendances::where('session_id', $id)->get(),
            "appreciations" => AppreciationNotes::where('session_id', $id)->get(),
            "users" => User::all(),
            "items" => Items::all(),
            "lines" => Lines::all(),
        ];
        
        return view('gemba.view', $data);
    }

    public function close(Request $request)
    {
        try {

            $request->validate([
                'id' => "required",
            ]);

            // Check if Session still has unresolved issues 
            $open_issue = GenbaSessions::where('id', $request->id)->first()->issues->where('status', "OPEN")->count();
            if ($open_issue > 0) {
                Alert::toast('Sesi Genba gagal diselesaikan, tandai semua isu menjadi "Terselesaikan"', 'error')->position('top-end')->timerProgressBar();
                return redirect()->back();
            };

            // Update Session Status 
            GenbaSessions::where('id', $request->id)->update([
                "status" => "FINISH"
            ]);

            Alert::toast('Sesi Genba berhasil diselesaikan', 'success')->position('top-end')->timerProgressBar();
    
            return redirect()->route('genba.history');
    
        } catch (\Exception $e) {
            Log::error('Failed to Close Genba Session', ['error' => $e->getMessage()]);
            
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
    }
}

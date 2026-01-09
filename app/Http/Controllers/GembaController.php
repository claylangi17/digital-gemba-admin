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
            "genbas" => GenbaSessions::orderByDesc('created_at')->get(),
            "factories" => \App\Models\Factory::all()
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
        $genba = GenbaSessions::where('id', $id)->first();

        $userQuery = User::query();
        $itemQuery = Items::query();
        $lineQuery = Lines::query();

        if ($genba && $genba->factory_id) {
            $userQuery->where('factory_id', $genba->factory_id);
            $itemQuery->where('factory_id', $genba->factory_id);
            $lineQuery->where('factory_id', $genba->factory_id);
        }

        $data = [
            "genba" => $genba,
            "issues" => Issues::where('session_id', $id)->orderBy('created_at', 'DESC')->get(),
            "appreciations" => AppreciationNotes::with('byUser')->where('session_id', $id)->get(),
            "users" => $userQuery->get(),
            "items" => $itemQuery->get(),
            "lines" => $lineQuery->get(),
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

    public function edit(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'start_time' => 'required'
            ]);

            // Find the genba session first to check if it exists
            $genba = GenbaSessions::find($id);
            
            if (!$genba) {
                Alert::toast('Sesi Genba tidak ditemukan', 'error')
                    ->position('top-end')
                    ->timerProgressBar();
                return redirect()->back();
            }

            // Parse timedate format 
            $carbon = Carbon::createFromFormat('d/m/Y H:i', $request->start_time);
            $start_time = $carbon->format('Y-m-d H:i:s');

            // Update Session 
            $genba->update([
                'name' => $request->name,
                'start_time' => $start_time
            ]);

            Alert::toast('Sesi Genba berhasil diperbarui', 'success')
                ->position('top-end')
                ->timerProgressBar();

            return redirect()->route('genba.history');

        } catch (\Exception $e) {
            Log::error('Failed to update Genba Session', ['error' => $e->getMessage()]);
            
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();

            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        try {
            // Find the genba session first to check if it exists
            $genba = GenbaSessions::find($id);
            
            if (!$genba) {
                Alert::toast('Sesi Genba tidak ditemukan', 'error')
                    ->position('top-end')
                    ->timerProgressBar();
                return redirect()->back();
            }

            // Delete the genba session using Eloquent (which will use the database connection)
            $genba->delete();

            Alert::toast('Sesi Genba berhasil dihapus', 'success')
                ->position('top-end')
                ->timerProgressBar();

            return redirect()->route('genba.history');

        } catch (\Exception $e) {
            Log::error('Failed to delete Genba Session', ['error' => $e->getMessage()]);
            
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();

            return redirect()->back();
        }
    }
}

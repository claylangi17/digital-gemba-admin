<?php

namespace App\Http\Controllers;

use App\Models\RootCauseFiles;
use App\Models\RootCauses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class RootCauseController extends Controller
{
    public function create(Request $request)
    {
        try {

            $request->validate([
                'issue_id' => 'required',
                'category' => 'required',
                'description' => 'required',
                'files.*' => "file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,webm|max:20480"
            ]);

            // Create root cause
            $cause = RootCauses::create([
                'issue_id' => $request->issue_id,
                'category' => $request->category,
                'description' => $request->description,
                'created_by' => Auth::user()->id,
                'supporting_files' => ''
            ]);


            foreach ($request->file('files', []) as $file) {
                // Name Obfuscate
                $filename = uniqid() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
    
                // Storing
                $path = $file->storeAs('uploads/issue/' . (string) $request->issue_id . '/', $filename, 'public');
    
                // Save the record
                $mime = $file->getMimeType();
                RootCauseFiles::create([
                    'root_cause_id' => $cause->id,
                    'user_id' => Auth::user()->id,
                    'type' => str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO",
                    'path' => $path,
                ]);
            }

            Alert::toast("Berhasil menambahkan akar masalah", 'success')->position('top-end')->timerProgressBar();
    
            return redirect()->back();
    
        } catch (\Exception $e) {
            Log::error('Failed to create Root Cause', ['error' => $e->getMessage()]);
    
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'cause_id' => 'required',
                'category' => 'required',
                'description' => 'required',
            ]);

            // Update related cause 
            RootCauses::where('id', $request->cause_id)->update([
                'category' => $request->category,
                'description' => $request->description,
            ]);

            if ($request->file('files', []))
            {
                foreach ($request->file('files', []) as $file) {
                    // Name Obfuscate
                    $filename = uniqid() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        
                    // Storing
                    $path = $file->storeAs('uploads/issue/' . (string) $request->issue_id . '/', $filename, 'public');
        
                    // Save the record
                    $mime = $file->getMimeType();
                    RootCauseFiles::create([
                        'root_cause_id' => $request->cause_id,
                        'user_id' => Auth::user()->id,
                        'type' => str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO",
                        'path' => $path,
                    ]);
                }
            }

            Alert::toast("Berhasil memperbaharui detail akar masalah", 'success')->position('top-end')->timerProgressBar();
    
            return redirect()->back();
    
        } catch (\Exception $e) {
            Log::error('Failed to Update Root Cause', ['error' => $e->getMessage()]);
    
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
    }
    
    public function delete($id)
    {
        $action = RootCauses::find($id);
        if ($action) {
            $action->delete();
            Alert::toast('Akar Masalah Berhasil Dihapus!', 'success')->position('top-end')->timerProgressBar();
        } else {
            Alert::toast('Akar Masalah Tidak Ditemukan', 'error')->position('top-end')->timerProgressBar();
        }

        return redirect()->back();
    }
}

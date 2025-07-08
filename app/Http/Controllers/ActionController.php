<?php

namespace App\Http\Controllers;

use App\Models\ActionCompletionFiles;
use App\Models\Actions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;


class ActionController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'issue_id' => 'required',
                'root_cause_selector' => "required",
                'type' => "required",
                'pic_id' => 'required',
                'description' => 'required',
                'due_date' => "required",
            ]);

            // Parse timedate data 
            $carbon = Carbon::createFromFormat('d/m/Y H:i', $request->due_date);
            $due_date = $carbon->format('Y-m-d H:i:s');

            // Create new Action 
            Actions::create([
                'issue_id' => $request->issue_id,
                'root_cause_id' => $request->root_cause_selector,
                'type' => $request->type,
                'pic_id' => $request->pic_id,
                'description' => $request->description,
                'due_date' => $due_date,
                'status' => "PROGRESS",
                'created_by' => Auth::user()->id
            ]);

            Alert::toast("Berhasil menambahkan aksi", 'success')->position('top-end')->timerProgressBar();
    
            return redirect()->back();
    
        } catch (\Exception $e) {
            Log::error('Failed to create Action', ['error' => $e->getMessage()]);
    
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
                'action_id' => 'required',
                'root_cause_selector' => "required",
                'type' => 'required',
                'pic_id' => 'required',
                'description' => 'required',
                'due_date' => "required",
            ]);

            // Parse Timedate data 
            $carbon = Carbon::createFromFormat('d/m/Y H:i', $request->due_date);
            $due_date = $carbon->format('Y-m-d H:i:s');

            // Update related action 
            Actions::where('id', $request->action_id)->update([
                'type' => $request->type,
                'root_cause_id' => $request->root_cause_selector,
                'pic_id' => $request->pic_id,
                'description' => $request->description,
                'due_date' => $due_date,
            ]);

            Alert::toast("Berhasil memperbaharui detail aksi", 'success')->position('top-end')->timerProgressBar();
    
            return redirect()->back();
    
        } catch (\Exception $e) {
            Log::error('Failed to Update Action', ['error' => $e->getMessage()]);
    
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        // Find Related action 
        $action = Actions::find($id);
        if ($action) {
            $action->delete(); //delete
            Alert::toast('Aksi Berhasil Dihapus!', 'success')->position('top-end')->timerProgressBar();
        } else {
            Alert::toast('Aksi Tidak Ditemukan', 'error')->position('top-end')->timerProgressBar();
        }

        return redirect()->back();
    }

    public function complete(Request $request)
    {
        try {
            $request->validate([
                'action_id' => 'required',
                'description' => 'required',
                'files.*' => "file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,webm|max:20480"
            ]);

            foreach ($request->file('files', []) as $file) {
                // Name Obfuscate
                $filename = uniqid() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
    
                // Storing
                $path = $file->storeAs('uploads/action/completion/' . (string) $request->action_id . '/', $filename, 'public');
    
                // Save the record
                $mime = $file->getMimeType();
                ActionCompletionFiles::create([
                    'action_id' => $request->action_id,
                    'user_id' => Auth::user()->id,
                    'type' => str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO",
                    'path' => $path,
                ]);
            }

            // Update Action status 
            Actions::where('id', $request->action_id)->update([
                'done_at' => Carbon::now(),
                'status' => "FINISHED",
                'completion_description' => $request->description
            ]);

            Alert::toast("Berhasil menyelesaikan aksi", 'success')->position('top-end')->timerProgressBar();
    
            return redirect()->back();
    
        } catch (\Exception $e) {
            Log::error('Failed to Finish Action', ['error' => $e->getMessage()]);
    
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
    }
}

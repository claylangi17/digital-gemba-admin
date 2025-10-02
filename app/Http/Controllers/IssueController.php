<?php

namespace App\Http\Controllers;

use App\Models\Actions;
use App\Models\IssueFiles;
use App\Models\Issues;
use App\Models\Items;
use App\Models\RootCauses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class IssueController extends Controller
{
    public function view($id)
    {
        // Get Data from Related issue 
        $data = [
            "issue" => Issues::where("id", $id)->first(),
            "users" => User::all()
        ];

        // Message for sweetalert delete confirmation 
        $title = 'Hapus Item!';
        $text = "Apakah kamu yakin untuk menghapus item ini?";
        confirmDelete($title, $text);

        $data["items"] = Items::whereIn('id', explode(',', $data["issue"]->items))->pluck('name')->implode(', ');
        $data["root_causes"] = RootCauses::where('issue_id', $data["issue"]->id)->orderByDesc('created_at')->get();
        $data["actions"] = Actions::where('issue_id', $data["issue"]->id)->orderByDesc('created_at')->get();

        return view('gemba.issue', $data);
    }

    public function create (Request $request)
    {
        try {

            $request->validate([
                'session_id' => "required",
                'line_id' => "required",
                'items' => "required",
                'assigned_ids' => "required",
                'description' => "required",
                'files.*' => "file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,webm|max:20480"
            ]);

            // Normalize item values and ensure their IDs are stored
            $submittedItems = array_filter(array_map('trim', explode(',', $request->items)));
            $itemIds = [];

            foreach ($submittedItems as $item) {
                $originalItem = $item;
                $normalizedName = strtolower($originalItem);

                $itemModel = ctype_digit($originalItem) ? Items::find($originalItem) : null;

                if (!$itemModel) {
                    $itemModel = Items::whereRaw('LOWER(name) = ?', [$normalizedName])->first();
                }

                if (!$itemModel) {
                    $itemModel = Items::create([
                        'name' => $originalItem,
                        'description' => ''
                    ]);
                }

                $itemIds[] = $itemModel->id;
            }

            // Create Issue 
            $issue = Issues::create([
                        'session_id' => $request->session_id,
                        'line_id' => $request->line_id,
                        'items' => implode(',', $itemIds),
                        'assigned_ids' => $request->assigned_ids,
                        'description' => $request->description,
                        'status' => "OPEN"
                    ]);

            // Handle file uploads 
            $last_id = Issues::latest()->first() ? Issues::latest()->first()->id : 1;
            foreach ($request->file('files', []) as $file) {
                // Name Obfuscate
                $filename = uniqid() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

                // Storing
                $path = $file->storeAs('uploads/issue/' . (string) $last_id . '/', $filename, 'public');

                // Save the record
                $mime = $file->getMimeType();
                IssueFiles::create([
                    'issue_id' => $issue->id,
                    'user_id' => Auth::user()->id,
                    'type' => str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO",
                    'path' => $path,
                ]);
            }

            Alert::toast('Isu berhasil ditambahkan', 'success')->position('top-end')->timerProgressBar();
    
            return redirect()->back();
    
        } catch (\Exception $e) {
            Log::error('Failed to create Issue', ['error' => $e->getMessage()]);
            
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
    }

    public function update (Request $request)
    {
        try {

            $request->validate([
                'issue_id' => "required",
                'line_id' => "required",
                'items' => "required",
                'assigned_ids' => "required",
                'description' => "required",
                'files.*' => "file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,webm|max:20480",
                'remove_files' => 'array',
                'remove_files.*' => 'integer|exists:issue_files,id'
            ]);

            $issue = Issues::with('files')->findOrFail($request->issue_id);

            // Normalize item values and ensure their IDs are stored
            $submittedItems = array_filter(array_map('trim', explode(',', $request->items)));
            $itemIds = [];

            foreach ($submittedItems as $item) {
                $originalItem = $item;
                $normalizedName = strtolower($originalItem);

                $itemModel = ctype_digit($originalItem) ? Items::find($originalItem) : null;

                if (!$itemModel) {
                    $itemModel = Items::whereRaw('LOWER(name) = ?', [$normalizedName])->first();
                }

                if (!$itemModel) {
                    $itemModel = Items::create([
                        'name' => $originalItem,
                        'description' => ''
                    ]);
                }

                $itemIds[] = $itemModel->id;
            }

            // Update Issue 
            $issue->update([
                'line_id' => $request->line_id,
                'items' => implode(',', $itemIds),
                'assigned_ids' => $request->assigned_ids,
                'description' => $request->description,
                'status' => "OPEN"
            ]);

            if ($request->filled('remove_files')) {
                $filesToRemove = IssueFiles::whereIn('id', $request->remove_files)
                    ->where('issue_id', $issue->id)
                    ->get();

                foreach ($filesToRemove as $file) {
                    Storage::disk('public')->delete($file->path);
                    $file->delete();
                }
            }

            // Handle file uploads 
            foreach ($request->file('files', []) as $file) {
                // Name Obfuscate
                $filename = uniqid() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

                // Storing
                $path = $file->storeAs('uploads/issue/' . (string) $issue->id . '/', $filename, 'public');

                // Save the record
                $mime = $file->getMimeType();
                IssueFiles::create([
                    'issue_id' => $issue->id,
                    'user_id' => Auth::user()->id,
                    'type' => str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO",
                    'path' => $path,
                ]);
            }

            Alert::toast('Detail Isu berhasil diperbaharui', 'success')->position('top-end')->timerProgressBar();
    
            return redirect()->back();
    
        } catch (\Exception $e) {
            Log::error('Failed to update Issue', ['error' => $e->getMessage()]);
            
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
    }

    public function close(Request $request)
    {
        try {

            $request->validate([
                'id' => "required",
                'session_id' => "required"
            ]);

            // Check if issue still has unfinished action 
            if (Issues::where('id', $request->id)->first()->actions->where('status', "PROGRESS")->count() > 0)
            {
                Alert::toast('Aksi dari isu ini belum terselesaikan, Harap selesaikan terlebih dahulu', 'error')->position('top-end')->timerProgressBar();
                return redirect()->back();
            }

            // Update Issue Status 
            Issues::where('id', $request->id)->update([
                "status" => "CLOSED"
            ]);

            Alert::toast('Isu berhasil ditutup', 'success')->position('top-end')->timerProgressBar();
    
            return redirect()->route('genba.view', [$request->session_id]);
    
        } catch (\Exception $e) {
            Log::error('Failed to Close Issue', ['error' => $e->getMessage()]);
            
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
    }
}

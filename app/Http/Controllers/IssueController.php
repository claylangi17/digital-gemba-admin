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
use PhpParser\Node\Expr\FuncCall;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class IssueController extends Controller
{
    public function view($id)
    {
        $data = [
            "issue" => Issues::where("id", $id)->first(),
            "users" => User::all()
        ];

        $title = 'Hapus Item!';
        $text = "Apakah kamu yakin untuk menghapus item ini?";
        confirmDelete($title, $text);

        $data["items"] = Items::whereIn('id', explode(',', $data["issue"]->items))->pluck('name')->implode(', ');
        $data["root_causes"] = RootCauses::where('issue_id', $data["issue"]->id)->get();
        $data["actions"] = Actions::where('issue_id', $data["issue"]->id)->get();

        return view('gemba.issue', $data);
    }

    public function create (Request $request)
    {
        try {

            $request->validate([
                'session_id' => "required",
                'line' => "required",
                'items' => "required",
                'assigned_ids' => "required",
                'description' => "required",
                'files.*' => "file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,webm|max:20480"
            ]);

            // Create Item if it didnt exist 
            $items = explode(',', $request->items);
            foreach ($items as $item)
            {
                $item = strtolower($item);
                if (!Items::where('name', $item)->exists() && !Items::where('id', $item)->exists())
                {
                    Items::create([
                        "name" => $item,
                        "description" => ""
                    ]);
                }
            }

            // Create Issue 
            $issue = Issues::create([
                        'session_id' => $request->session_id,
                        'line' => $request->line,
                        'items' => $request->items,
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

    public function close(Request $request)
    {
        try {

            $request->validate([
                'id' => "required",
                'session_id' => "required"
            ]);

            $issue = Issues::where('id', $request->id)->update([
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

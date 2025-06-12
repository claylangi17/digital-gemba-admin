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

class IssueFileController extends Controller
{
    public function create(Request $request)
    {
        try {

            $request->validate([
                'issue_id' => "required",
                'files.*' => "file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,webm|max:20480"
            ]);

            foreach ($request->file('files', []) as $file) {
                // Name Obfuscate
                $filename = uniqid() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
    
                // Storing
                $path = $file->storeAs('uploads/issue/' . (string) $request->issue_id . '/', $filename, 'public');
    
                // Save the record
                $mime = $file->getMimeType();
                IssueFiles::create([
                    'issue_id' => $request->issue_id,
                    'user_id' => Auth::user()->id,
                    'type' => str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO",
                    'path' => $path,
                ]);
            }
    
            Alert::toast('File pendukung berhasil ditambahkan', 'success')->position('top-end')->timerProgressBar();
    
            return redirect()->back();

        } catch (\Exception $e) {
            Log::error('Failed to add Issue Files', ['error' => $e->getMessage()]);
            
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
        
        
    }
}

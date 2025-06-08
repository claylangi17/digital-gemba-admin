<?php

namespace App\Http\Controllers;

use App\Models\Actions;
use App\Models\Issues;
use App\Models\Items;
use App\Models\RootCauses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\FuncCall;
use RealRashid\SweetAlert\Facades\Alert;

class IssueController extends Controller
{
    public function view($id)
    {
        $data = [
            "issue" => Issues::where("id", $id)->first(),
            "users" => User::all()
        ];

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
                'photos' => "required",
            ]);

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

            $last_id = Issues::latest()->first() ? Issues::latest()->first()->id : 1;

            $path = $request->file('photos')->store('uploads/issue/' . (string) $last_id . '/', 'public');

            Issues::create([
                'session_id' => $request->session_id,
                'line' => $request->line,
                'items' => $request->items,
                'assigned_ids' => $request->assigned_ids,
                'description' => $request->description,
                'files' => $path,
                'status' => "OPEN"
            ]);

            Alert::toast('Isu berhasil ditambahkan', 'success')->position('top-end')->timerProgressBar();
    
            return redirect()->back();
    
        } catch (\Exception $e) {
            Log::error('Failed to create GenbaSession', ['error' => $e->getMessage()]);
            
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
    }
}

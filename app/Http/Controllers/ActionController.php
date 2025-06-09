<?php

namespace App\Http\Controllers;

use App\Models\Actions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class ActionController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'issue_id' => 'required',
                'type' => "required",
                'pic_id' => 'required',
                'description' => 'required',
                'due_date' => "required",
            ]);

            $carbon = Carbon::createFromFormat('d/m/Y H:i', $request->due_date);
            $due_date = $carbon->format('Y-m-d H:i:s');

            Actions::create([
                'issue_id' => $request->issue_id,
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
                'type' => 'required',
                'pic_id' => 'required',
                'description' => 'required',
                'due_date' => "required",
            ]);

            $carbon = Carbon::createFromFormat('d/m/Y H:i', $request->due_date);
            $due_date = $carbon->format('Y-m-d H:i:s');

            Actions::where('id', $request->action_id)->update([
                'type' => $request->type,
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
        $action = Actions::find($id);
        if ($action) {
            $action->delete();
            Alert::toast('Aksi Berhasil Dihapus!', 'success')->position('top-end')->timerProgressBar();
        } else {
            Alert::toast('Aksi Tidak Ditemukan', 'error')->position('top-end')->timerProgressBar();
        }

        return redirect()->back();
    }
}

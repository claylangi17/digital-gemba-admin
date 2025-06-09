<?php

namespace App\Http\Controllers;

use App\Models\Actions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class ActionController extends Controller
{
    public function update(Request $request)
    {
        try {
            $request->validate([
                'action_id' => 'required',
                'pic_id' => 'required',
                'description' => 'required',
                'due_date' => "required",
            ]);

            $carbon = Carbon::createFromFormat('d/m/Y H:i', $request->due_date);
            $due_date = $carbon->format('Y-m-d H:i:s');

            Actions::where('id', $request->action_id)->update([
                'pic_id' => $request->pic_id,
                'description' => $request->description,
                'due_date' => $due_date,
            ]);

            Alert::toast("Berhasil memperbaharui detail aksi", 'success')->position('top-end')->timerProgressBar();
    
            return redirect()->back();
    
        } catch (\Exception $e) {
            Log::error('Failed to create Update Action', ['error' => $e->getMessage()]);
    
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
    }
}

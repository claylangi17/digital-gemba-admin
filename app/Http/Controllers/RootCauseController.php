<?php

namespace App\Http\Controllers;

use App\Models\RootCauses;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RootCauseController extends Controller
{
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

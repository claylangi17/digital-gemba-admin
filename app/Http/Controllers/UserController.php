<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{   
    public function index()
    {
        $data = [
            'users' => User::all(),
        ];

        $title = 'Hapus Pengguna!';
        $text = "Apakah kamu yakin untuk menghapus pengguna?";
        confirmDelete($title, $text);

        return view('users', $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'department' => $request->department,
            'password' => bcrypt($request->password),
        ]);

        Alert::toast('Pengguna Berhasil Ditambahkan!', 'success')->position('top-end')->timerProgressBar();

        return redirect()->back();
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            Alert::toast('Pengguna Berhasil Dihapus!', 'success')->position('top-end')->timerProgressBar();
        } else {
            Alert::toast('Pengguna Tidak Ditemukan', 'error')->position('top-end')->timerProgressBar();
        }

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCoverPhoto;
use App\Models\UserProfilePhoto;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

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

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'department' => $request->department,
            'password' => bcrypt($request->password),
        ]);

        if ($request->hasFile('profile_photo')) {
            $profileFile = $request->file('profile_photo');
            $profileFilename = uniqid() . '_' . Str::random(10) . '.' . $profileFile->getClientOriginalExtension();
            $profilePath = $profileFile->storeAs('uploads/user/profile/' . $user->id, $profileFilename, 'public');
        
            UserProfilePhoto::create([
                'user_id' => $user->id,
                'path' => $profilePath,
            ]);
        }
        
        if ($request->hasFile('cover_photo')) {
            $coverFile = $request->file('cover_photo');
            $coverFilename = uniqid() . '_' . Str::random(10) . '.' . $coverFile->getClientOriginalExtension();
            $coverPath = $coverFile->storeAs('uploads/user/cover/' . $user->id, $coverFilename, 'public');
        
            UserCoverPhoto::create([
                'user_id' => $user->id,
                'path' => $coverPath,
            ]);
        }
        

        Alert::toast('Pengguna Berhasil Ditambahkan!', 'success')->position('top-end')->timerProgressBar();

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        User::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'department' => $request->department,
        ]);

        if ($request->hasFile('profile_photo')) {
            $profileFile = $request->file('profile_photo');
            $profileFilename = uniqid() . '_' . Str::random(10) . '.' . $profileFile->getClientOriginalExtension();
            $profilePath = $profileFile->storeAs('uploads/user/profile/' . $request->id, $profileFilename, 'public');
        
            UserProfilePhoto::where('user_id', $request->id)->update([
                'path' => $profilePath,
            ]);
        }
        
        if ($request->hasFile('cover_photo')) {
            $coverFile = $request->file('cover_photo');
            $coverFilename = uniqid() . '_' . Str::random(10) . '.' . $coverFile->getClientOriginalExtension();
            $coverPath = $coverFile->storeAs('uploads/user/cover/' . $request->id, $coverFilename, 'public');
        
            UserCoverPhoto::where('user_id', $request->id)->update([
                'path' => $coverPath,
            ]);
        }

        if (!$request->password)
        {
            User::where('id', $request->id)->update([
                'password' => bcrypt($request->password),
            ]);
        }

        Alert::toast('Pengguna Berhasil Diperbaharui!', 'success')->position('top-end')->timerProgressBar();

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

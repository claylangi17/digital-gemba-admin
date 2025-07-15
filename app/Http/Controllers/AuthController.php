<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        try {

            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ],[
                "email.required" => "Email tidak boleh kosong",
                "email.email" => "Email tidak valid",
                "password.required" => "Password tidak boleh kosong"
            ]);

            // Extract the data from the request 
            $data = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            
            // Attemt the auth by passing the data 
            if (Auth::attempt($data, false)){
                // get user data 
                $request->session()->regenerate();

                return redirect()->route('index');
            } else{
                // if user data not exists, bail out 
                
                Alert::toast('Email / Password Salah!', 'error')->position('top-end')->timerProgressBar();

                return redirect()->route('auth.login');
            }
    
        } catch (\Exception $e) {
            Log::error('User Failed to Login', ['error' => $e->getMessage()]);
    
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Alert::toast('Berhasil Logout!', 'success')->position('top-end')->timerProgressBar();

        return redirect()->route('auth.login');
    }

    public function indexForget()
    {
        return view('auth.forget');
    }

    public function forget(Request $request)
    {
        try {

            $request->validate([
                'email' => 'required|email',
            ],[
                "email.required" => "Email tidak boleh kosong",
                "email.email" => "Email tidak valid",
            ]);
    
            // Check if User exists
            if (!User::where('email', $request->email)->exists()) {
                Alert::toast('Pengguna tidak ditemukan!', 'error')->position('top-end')->timerProgressBar();
                return redirect()->back();
            }
    
            // Create Password Reset Token 
            $data = [
                'email' => $request->email,
                'expires_at' => now()->addMinutes(30)->timestamp,
            ];
            $encrypted = Crypt::encryptString(json_encode($data));
    
            // Send Email along with the token
            $link = route('auth.reset', ['token' => $encrypted]);
            Mail::to($request->email)->send(new ForgetPassword($link));
    
            Alert::toast('Link Reset Password Telah Dikirim!', 'success')->position('top-end')->timerProgressBar();
    
            return redirect()->back();
    
        } catch (\Exception $e) {
            Log::error('Failed to Sent Password Reset Email', ['error' => $e->getMessage()]);
    
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
    }

    public function indexReset($token)
    {
        // Validate The Password Reset Token 
        $data = json_decode(Crypt::decryptString($token), true);
        if (now()->timestamp > $data['expires_at']) {
            abort(403, 'Link expired');
        }

        return view('auth.reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        try {

            $request->validate([
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password',
            ],[
                "password.required" => "Password tidak boleh kosong",
                "password.min" => "Password minimal 8 karakter",
                "confirm_password.required" => "Konfirmasi password tidak boleh kosong",
                "confirm_password.same" => "Konfirmasi password tidak sesuai"
            ]);
    
            $request->validate([
                'password' => 'required|min:8',
            ]);
    
            // Check if time limit reached 
            $data = json_decode(Crypt::decryptString($request->secret), true);
            if (now()->timestamp > $data['expires_at']) {
                Alert::toast('Link Kadaluarsa, Silahkan Ulangi', 'error')->position('top-end')->timerProgressBar();
                return redirect()->route('auth.forget');
            }
    
            // Check if password confirmation is same with the new one 
            if ($request->password != $request->confirm_password) {
                Alert::toast('Konfirmasi password tidak sesuai!', 'error')->position('top-end')->timerProgressBar();
                return redirect()->back();
            }
    
            // Double Check user existence 
            $user = User::where('email', $data['email'])->first();
            if (!$user) {
                Alert::toast('Pengguna tidak ditemukan!', 'error')->position('top-end')->timerProgressBar();
                return redirect()->back();
            }
    
            // Update User Password 
            $user->update(['password' => bcrypt($request->password)]);
            Alert::toast('Password berhasil diubah!', 'success')->position('top-end')->timerProgressBar();
            return redirect()->route('auth.login');
    
        } catch (\Exception $e) {
            Log::error('Failed to Reset Password', ['error' => $e->getMessage()]);
    
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
    }
}

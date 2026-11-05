<?php

namespace App\Http\Controllers;

use App\models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(){
        return view('autentikasi.login');
    }
     public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kecocokan di database dan mulai Sesi
        if (Auth::attempt($credentials)) {
            // Jika berhasil, buat ulang sesi untuk keamanan (mencegah session fixation)
            $request->session()->regenerate();

            // Arahkan ke halaman dashboard admin
            return redirect()->intended('/admin/dashboard');
        }

        // Jika email/password salah, kembalikan ke halaman login beserta pesan error
        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan salah.',
        ])->onlyInput('email'); // Biarkan email tetap terisi agar user tidak perlu mengetik ulang
    }

    public function showRegistrasi()
    {
            return view('autentikasi.registrasi');
    }
    public function registrasi(Request $request)
    {
            $request->validate([
                'name'      =>'required|string|max:255',
                'email'     =>'required|email|unique:users',
                'password'  =>'required|min:6|confirmed',
            ],[
                //kustomisasi pesan error
                'email.unique'=>'email sudah digunakan.',
                'password.confirmed'=>'konfirmasi kata sandi salah.'   
                ]);
                //simpan ke database
                User::create([
                    'name' =>$request->name,
                    'email' =>$request->email,
                    'password' =>hash::make($request->password),
                ]);
                return redirect('/admin/dashboard')->with('success','registrasi admin baru berhasil!');
    }

    // 3. Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showDaftarAdmin()
    {
        if (Auth::user()->role !== 'superadmin') {
        abort(403, 'Akses Ditolak: Hanya Super Admin yang boleh membuka halaman ini.');

        // return view('admin.register'); 

        }else{
             $dataAdmin = User::get();
            return view('admin.AdminList', compact('dataAdmin'));
        }
    
        
    }

    public function deleteAdmin(int $id)
    {
        $dataAdmin = User::findOrFail($id);
        $dataAdmin->delete();
        return redirect('/daftar-admin')->with("massage","Berhasil menghapus data");
    }
}

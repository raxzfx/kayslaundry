<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Tampilan login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'no_telp' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Menggunakan auth() helper atau Auth facade
            $user = Auth::user(); // atau auth()->user()
            
            return match($user->role) {
                'customer'  => redirect('/customer/dashboard'),
                'operator'  => redirect('/operator/dashboard'),
                'pelaksana' => redirect('/pelaksana/dashboard'),
                'direktur'  => redirect('/direktur/dashboard'),
                default     => redirect('/'),
            };
        }

        return back()->withErrors([
            'no_telp' => 'Nomor telepon atau password salah.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

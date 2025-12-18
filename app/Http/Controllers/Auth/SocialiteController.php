<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    // 1. Redirect user ke halaman login Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2. Handle balikan (callback) dari Google
    public function callback()
    {
        try {
            // Ambil data user dari Google
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user ini sudah ada di database (berdasarkan google_id atau email)
            $user = User::where('google_id', $googleUser->id)
                ->orWhere('email', $googleUser->email)
                ->first();

            if ($user) {
                // Jika user sudah ada, login-kan mereka
                // Update google_id jika sebelumnya daftar manual (via email biasa)
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->id]);
                }

                Auth::login($user);
                return redirect()->route('dashboard');
            } else {
                // Jika user belum ada, buat user baru
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make('password_acak_' . rand(1000, 9999)), // Password dummy
                    'role' => 'user', // Default role user biasa
                ]);

                Auth::login($newUser);
                return redirect()->route('dashboard');
            }

        } catch (\Exception $e) {
            // Jika user membatalkan login atau ada error lain
            return redirect()->route('login')->with('error', 'Login Google Gagal, silakan coba lagi.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use \Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function authLogin()
    {
        return view('frontend.auth.login');
    }

    public function authRegister()
    {
        return view('frontend.auth.register');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $result = $response->json();

        if (!($result['success'] ?? false)) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => 'Lütfen reCAPTCHA doğrulamasını tamamlayın.'
            ]);
        }

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'credentials' => 'Bu bilgilere sahip herhangi bir kullanıcı veritabanımızda bulunmamaktadır.'
            ]);
        }

        if ($user->status === 'passive') {
            throw ValidationException::withMessages([
                'credentials' => 'Giriş başarısız! Bu bilgilere sahip kullanıcının hesabı geçici veya temelli olarak kapatılmıştır.'
            ]);
        }

        if (Auth::attempt($validated, $request->has('remember'))) {
            return redirect()->route('blog');
        }

        throw ValidationException::withMessages([
            'credentials' => 'E-posta veya şifre yanlış.'
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'g-recaptcha-response' => 'required',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $result = $response->json();

        if (!($result['success'] ?? false)) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => 'Lütfen reCAPTCHA doğrulamasını tamamlayın.'
            ]);
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $user->assignRole('user');

        Auth::login($user);

        return redirect()->route('blog');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('blog');
    }
}

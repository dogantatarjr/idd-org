<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function updateName(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return redirect()->back()->with('success', 'İsim başarıyla güncellendi!');
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'current_password' => ['required', 'string'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mevcut şifreniz hatalı!']);
        }

        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'E-posta başarıyla güncellendi!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mevcut şifreniz hatalı!']);
        }

        if (Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Yeni şifre mevcut şifrenizden farklı olmalıdır!']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Şifre başarıyla değiştirildi!');
    }

    function deactivate(Request $request)
    {
        $user = Auth::user();
        $user->status = 'passive';
        $user->save();

        Auth::logout();

        return redirect('/blog')->with('deactivation', 'Hesabınız devre dışı bırakıldı.');
    }
}

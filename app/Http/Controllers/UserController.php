<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{

    public function show(){

        $users = User::with('roles')->get();

        return view('frontend.admin.users', compact('users'));
    }

    public function update(Request $request) {
        $user = User::findOrFail($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->syncRoles([$request->role]);
        $user->status = $request->status;
        $user->save();

        return redirect()->back()->with('success', 'Kullanıcı güncellendi!');
    }

}

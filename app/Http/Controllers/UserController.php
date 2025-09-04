<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{

    public function show(){

        $users = User::with(['roles'])
                    ->select('id', 'name', 'email', 'created_at', 'updated_at', 'email_verified_at')
                    ->get();

        return view('frontend.admin.users', compact('users'));
    }
}

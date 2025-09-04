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
}

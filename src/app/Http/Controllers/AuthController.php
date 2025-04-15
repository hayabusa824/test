<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ユーザー登録ページ表示
    public function index() {
        return view('auth.register');
    }

    public function store(AuthRequest $request) {

        $users = $request->only(['name', 'email', 'password']);
        User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password), // ← これ重要！
]);;

        return redirect('/login');
    }


}
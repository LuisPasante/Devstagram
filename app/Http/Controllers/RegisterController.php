<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;//hashear
use App\Models\User; // ✅ Importación correcta

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        // Convertimos el username en slug antes de validar
        $request->merge([
            'username' => Str::slug($request->input('username'))
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'username' => 'required|unique:users,username|min:3|max:20',
            'email' => 'required|unique:users,email|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]); 

        //Autenticar usuario
        // auth()->attempt([
        //     'email' => $validated['email'],
        //     'password' => $validated['password']
        // ]);
        //otra forma
        auth()->attempt($request->only('email','password'));
        return redirect()->route('posts.index',auth()->user());
        
    }
} 

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function store(Request $request)
    {
        // Cerrar sesión del usuario
        Auth::logout();

        // Invalidar sesión y regenerar token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redireccionar al login o a la página principal
        return redirect()->route('login');
    }
}

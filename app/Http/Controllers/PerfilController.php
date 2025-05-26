<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        // Convertimos el username en slug antes de validar
        $request->merge([
            'username' => Str::slug($request->input('username'))
        ]);

        $validated = $request->validate([
            'username' => [
                'required',
                'min:3',
                'max:20',
                Rule::unique('users', 'username')->ignore(auth()->user()->id),
            ],
            'email' => [
                'required',
                'email',
                'max:60',
                Rule::unique('users', 'email')->ignore(auth()->user()->id)
            ],
            'oldpassword' => [
                'required',
                'min:6',
            ],
            'newpassword' => [
                'required',
                'min:6',
            ]
        ]);

        // Verificar contraseña actual
        if (!Hash::check($request->oldpassword, auth()->user()->password)) {
            return back()->withErrors(['oldpassword' => 'La contraseña actual no es correcta.'])->withInput();
        }

        // Procesar imagen si se envía
        $nombreImagen = auth()->user()->imagen ?? null;

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();

            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->newpassword); // Asegúrate de hashear la nueva contraseña
        $usuario->imagen = $nombreImagen;
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}

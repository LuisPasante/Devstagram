<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        $request->validate([
            'comentario' => 'required|max:250'
        ]);

        Comentario::create([
            'comentario' => $request->comentario,
            'user_id' => auth()->id(),
            'post_id' => $post->id
        ]);

        return back()->with('mensaje', 'Comentario realizado correctamente');
    }

}

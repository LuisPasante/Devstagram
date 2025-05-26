<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Seguir a un usuario
    public function store(User $user)
    {
        $authUser = auth()->user();

        if ($authUser->id === $user->id) {
            return back()->withErrors(['error' => 'No puedes seguirte a ti mismo.']);
        }

        $authUser->followings()->attach($user->id);

        return back();
    }

    // Dejar de seguir a un usuario
    public function destroy(User $user)
    {
        auth()->user()->followings()->detach($user->id);
        return back();
    }
}


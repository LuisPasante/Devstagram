<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; // ✅ Esta es la clase base correcta

class PostController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['auth', 'verified']);
        $this->middleware(['auth']);
    }
    public function index(User $user)
    {  
        return view('dashboard', [
            'user' => $user,  
        ]);
    }


    public function create() 
    {
        return view('posts.create');
    }

    public function store(){
        dd("Entra");
    }
}

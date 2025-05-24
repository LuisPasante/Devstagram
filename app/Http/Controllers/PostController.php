<?php
namespace App\Http\Controllers;

use App\Models\Post;
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

    // public function store(Request $request){
         
    //    $request->validate([
    //         'titulo' => 'required|max:250',
    //         'descripcion' => 'required|max:250',
    //         'imagen' => 'required|string'
    //     ]);

    //     Post::create([
    //         'titulo'=>$request->titulo,
    //         'descripcion'=>$request->descripcion,
    //         'imagen'=>$request->imagen,
    //         'user_id'=> auth()->id()
    //     ]);
    //        return redirect()->route('posts.index', auth()->user()->username);
    // }
    public function store(Request $request)
    {
        $datos = $request->validate([
            'titulo' => 'required|max:250',
            'descripcion' => 'required|max:250',
            'imagen' => 'required|string'
        ]);

        // Agregar el ID del usuario autenticado
        $datos['user_id'] = auth()->id();

        Post::create($datos);

        return redirect()->route('posts.index', auth()->user()->username);
    }

 
}

<?php
namespace App\Http\Controllers;

use App\Models\Post; // Modelo Post (publicaciones)
use App\Models\User; // Modelo User (usuarios)
use Illuminate\Http\Request; // Para manejar solicitudes HTTP
use Illuminate\Routing\Controller; // Clase base del controlador
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{ 
    use AuthorizesRequests;
    public function __construct()
    {
        // Middleware para requerir autenticación (usuario logueado)
        // También podrías usar 'verified' si quieres usuarios con email verificado
        $this->middleware(['auth'])->except(['show','index']);
    }

    // Muestra los posts del usuario (vista dashboard)
    public function index(User $user)
    {
        $posts = Post::where('user_id',$user->id)->latest()->paginate(5);
        // Se pasa un objeto User a la vista 'dashboard'
        // Esto utiliza route model binding de Laravel
        return view('dashboard', [
            'user' => $user,
            'posts' =>$posts,
        ]);
    }

    // Muestra el formulario para crear un nuevo post
    public function create()
    {
        return view('posts.create'); // Vista con el formulario
    }

    // Guarda el post en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $datos = $request->validate([
            'titulo' => 'required|max:250',       // Campo obligatorio, máximo 250 caracteres
            'descripcion' => 'required|max:250',  // Campo obligatorio, máximo 250 caracteres
            'imagen' => 'required|string'         // Campo obligatorio (nombre de archivo de imagen)
        ]);

        // Asociar el post al usuario autenticado
        $datos['user_id'] = auth()->id();

        // Crear el post en la base de datos
        Post::create($datos);

        // Redireccionar al dashboard del usuario
        return redirect()->route('posts.index', auth()->user()->username);

        // --- Alternativa comentada ---
        // Otra forma de guardar el post, usando la relación con el usuario:
        //
        // $request->user()->posts()->create([
        //     'titulo'=> $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen'=>  $request->imagen,
        //     'user_id'=> auth()->user()->id,
        // ]);
        //
        // return redirect()->route('posts.index', auth()->user()->username);
    }
    public function show(User $user, Post $post)
    {
        // Validamos que el post pertenezca al usuario (seguridad)
        // if ($post->user_id !== $user->id) {
        //     abort(403); // o 404 si prefieres no revelar su existencia
        // }

        return view('posts.show', [
            'user' => $user,
            'post' => $post,
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        // Eliminar imagen si existe
        $imagen_path = public_path('uploads/' . $post->imagen);
        if  (File::exists($imagen_path)){
            unlink($imagen_path);
        }

        $post->delete();

        return redirect()->route('posts.index', auth()->user()->username)
            ->with('mensaje', 'Publicación eliminada correctamente.');
    }
    

}

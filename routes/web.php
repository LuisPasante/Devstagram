<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;

//Pagina Principal

Route::get('/', HomeController::class)->name('home');

// Registro
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Login y logout
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//Ruta para Perfil
Route::post('/editar-perfil',[PerfilController::class,'store'])->name('perfil.store');
Route::get('/editar-perfil',[PerfilController::class,'index'])->name('perfil.index');

// Rutas para posts
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); 
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Siguiendo Usuarios
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

// Comentarios
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); 

// Likes
Route::post('posts/{post}/like', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('posts/{post}/like', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

// Esta ruta debe ir al final
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');




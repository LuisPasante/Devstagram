@extends('layouts.app')

@section('titulo')
Perfil {{$user->username}}
@endsection


@section('contenido')
<div class="flex justify-center">
    <div class="w-full md:w8-12 lg:w-6/12 flex flex-col items-center md:flex-row">
        <div class="w-8/12 lg:w-6/12 p-5">
            <img src="{{asset('img/usuario.svg')}}" alt="Imagen usuario">
        </div>
        <div class="md:w-8/12 lg:w-6/12 p-5 flex flex-col items-center py-10 md:py-10 md:items-start md:justify-center">
            <p class="text-gray-700 text-2xl">{{$user->username}}</p>

            <p class="text-gray-800 text-sm font-bold mb-3 mt-5">
                0
                <span class="font-normal">Seguidores</span>
            </p>
            <p class="text-gray-800 text-sm font-bold mb-3">
                    0
                <span class="font-normal">Siguiendo</span>
            </p>
            <p class="yexy-gray-800 text-sm font-bold mb-3">
                    0
                <span class="font-normal">Posts</span>
            </p>
        </div>
    </div>
</div>
<section class="container mx-auto mt-10">
    <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2> 
    <p class="text-gray-500 text-center uppercase text-sm font-bold mb-3"> {{ $posts->count() }} posts</p>

    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['user' => $user->username, 'post' => $post->id]) }}">
                        <img src="{{ asset('uploads/' . $post->imagen) }}" alt="Imagen del post {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach 
        </div> 
        <div class="mt-6">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @else
        <p class="text-gray-500 text-center uppercase text-sm font-bold">No hay posts</p>
    @endif



</section>
@endsection



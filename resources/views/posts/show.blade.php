@extends('layouts.app')
 
@section('titulo')
 {{$post->titulo}} 
@endsection

@section('contenido')
<div class="container mx-auto md:flex  ">
    <div class="md:w-1/2 p-5">
    <a> 
        <img src="{{asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
        <div class="p-3 flex items-center gap-2">
            @auth 
                <livewire:like-post :post="$post"/>  
            @endauth 
            
        </div>

        <div class="">
            <p class="font-bold">{{$post->user->username}}</p> 
            <p class="text-gray-500 text-sm  ">
             Publicado {{ $post->created_at->diffForHumans() }}
            </p>
            <p class="mt-5 ">
                 {{$post->descripcion}}
            </p>
            @auth
                @if($post->user_id === auth()->user()->id)
                  <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE') 
                        <input type="submit"
                        value="Eliminar publicación"
                        class="bg-red-500 hover:bg-red-600 p-2 rounded-lg text-white font-bold mt-4 cursor-pointer"
                        >
                    </form>
                @endif
            @endauth
           
        </div>
    </a>
    </div>
   
    <div class="md:w-1/2 p-5"> 
        <div class="shadow bg-white p-5 mb-5 ">
            @auth
            @if (session('mensaje'))
                <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center font-bold uppercase">
                    {{ session('mensaje') }}
                </div>
            @endif

            <form action="{{route('comentarios.store',['post' => $post, 'user' => $user ] ) }}" method="POST">
                @csrf
                <p class="text-xl font-bold text-center mb-4">Agrega un nuevo Comentario</p>
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                            Añade un Comentario
                        </label>
                        <textarea  id="comentario"
                            name="comentario"
                            placeholder="Comentario"
                            class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                        > </textarea>
                      @error('comentario') border-red-500 @enderror
                    </div>  
                <input
                    type="submit"
                    value="Postear"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
            @endauth
            <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                 @if($post->comentarios->count())
                    @foreach ($post->comentarios as $comentario)
                        <div class="p-5 border-gray-300 border-b">
                            <a href="{{route('posts.index', $comentario->user)}}" class="font-bold">
                                {{$comentario->user->username}}
                            </a>
                            <p>{{$comentario->comentario}}</p>
                            <p class="text-sm text-gray">{{$comentario->created_at->diffForHumans()}}</p>
                        </div>
                    @endforeach
                 @else
                 <p class="text-center p-10">No hay Comentarios</p>
                 @endif
            </div>
        </div>
     
    </div>
</div>

@endsection
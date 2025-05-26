@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center mt-5">
        <div class="md:-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-10" action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data"> 
                @csrf
               <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input id="username"
                     name="username"
                     type="username"
                     placeholder="Ingresa tu Corrreo" 
                     class="border p-3 w-full rounded-lg" 
                     value="{{ old('username', auth()->user()->username) }}"> 
                     @error('username')
                         <p class="bg-red-500 text-white my-2 text-sm p-2   
                         text-center border rounded-lg">{{$message}}</p>
                     @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input id="email"
                     name="email"
                     type="email"
                     placeholder="Ingresa tu Corrreo" 
                     class="border p-3 w-full rounded-lg" 
                     value="{{ old('email', auth()->user()->email) }}"> 
                     @error('email')
                         <p class="bg-red-500 text-white my-2 text-sm p-2   
                         text-center border rounded-lg">{{$message}}</p>
                     @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input id="email"
                     name="email"
                     type="email"
                     placeholder="Ingresa tu Corrreo" 
                     class="border p-3 w-full rounded-lg" 
                     value="{{ old('email', auth()->user()->email) }}"> 
                     @error('email')
                         <p class="bg-red-500 text-white my-2 text-sm p-2   
                         text-center border rounded-lg">{{$message}}</p>
                     @enderror
                </div>
                <div class="mb-5">
                    <label for ="newpassword" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password Nueva
                    </label>
                    <input
                        id="newpassword"
                        name="newpassword"
                        type="newpassword"
                        placeholder="Password nueva"
                        class="border p-3 w-full rounded-lg"
                        > 
                     @error('password')
                         <p class="bg-red-500 text-white my-2 text-sm p-2   
                         text-center border rounded-lg">{{$message}}</p>
                     @enderror
                </div>
                <div class="mb-5">
                    <label for ="oldpassword" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password Antigua
                    </label>
                    <input
                        id="oldpassword"
                        name="oldpassword"
                        type="oldpassword"
                        placeholder="Password Anterior"
                        class="border p-3 w-full rounded-lg"
                        > 
                     @error('oldpassword')
                         <p class="bg-red-500 text-white my-2 text-sm p-2   
                         text-center border rounded-lg">{{$message}}</p>
                     @enderror
                </div>
                 <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen Perfil
                    </label>
                    <input id="imagen"
                     name="imagen"
                     type="file" 
                     class="border p-3 w-full rounded-lg" 
                     accept=".jpg, .jpeg, .png">  
                </div>

                 <input
                type="submit"
                value="Guardar Cambios"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3
                text-white border rounded-lg w-full"
                />
            </form>
        </div>
    </div>
         
@endsection
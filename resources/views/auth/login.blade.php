@extends('layouts.app')
@section('titulo')
    Inicia Sesion en  Devstagram
@endsection

@section('contenido')
    <div class="mt-10  md:flex md:justify-center  md:gap-6  md:items-center">
        <div class="md:w-6/12  md:justify-center  p-5 "> 
            <img   src ="{{asset('img/login.jpg')}} "alt="Imagen de Registro de usuario">
        </div>
        <div class="md:w-4/12 bg-white shadow-xl p-6 rounded-lg">  
            <form action= "{{route('login')}}" method="POST" novalidate>
            @csrf  
            @if(session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2
                    text-center">
                    {{session('mensaje')}}
                </p>
            @endif 
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        email
                    </label>
                    <input id="email"
                     name="email"
                     type="email"
                     placeholder="Ingresa tu Corrreo" 
                     class="border p-3 w-full rounded-lg" 
                     value={{old('email')}} > 

                     @error('email')
                         <p class="bg-red-500 text-white my-2 text-sm p-2   
                         text-center border rounded-lg">{{$message}}</p>
                     @enderror
                </div>
                <div class="mb-5">
                    <label for ="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Password de Registro"
                        class="border p-3 w-full rounded-lg"
                        > 
                     @error('password')
                         <p class="bg-red-500 text-white my-2 text-sm p-2   
                         text-center border rounded-lg">{{$message}}</p>
                     @enderror
                </div>
                <div class="mb-7">
                    <input type="checkbox" name="remember">
                    <label class=" text-gray-500 text-sm">Mantener mi sesión abierta</label>
                <div>
                <input
                type="submit"
                value="Iniciar Sesión"
                class="  bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3
                text-white border rounded-lg w-full"
                />
            </form>
        </div>
    </div>
@endsection
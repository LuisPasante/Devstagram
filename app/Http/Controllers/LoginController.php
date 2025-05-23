<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
        return view('auth.login');
    }
    public function store(Request $request){
        $validated=$request->validate([
            'email' => 'email|required',
            'password'=> 'required'
        ]); 
 
        //dd($request->remember);

        if(!auth()->attempt($request->only('password','email'),$request->remember)){
            return back()->with('mensaje','Credenciales Incorrectas');
        } 
        return redirect()->route('posts.index', auth()->user()->username);

    }
}

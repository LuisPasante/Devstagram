<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public  function __construct(){
        $this->middleware('auth');
    }
    public function __invoke(){
        //obterner a quien seguimos 
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $post = Post::whereIn('user_id',$ids)->latest()->paginate(20); 
        return view('home',[
            'posts' => $post
        ]);
    }
}

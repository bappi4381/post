<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function index() 
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->get();
        return view('Posts.index', compact('posts'));
    }
    
}
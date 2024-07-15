<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(){
        $posts = Post::withCount('comment')->get();

        // Pass $posts to your view or do further processing
        return view('posts.index', compact('posts'));
    }
    public function create(){

    }
    public function store(Request $request){
         // Validate the request data
         $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string',
        ]);
       
        // Get the authenticated user (assuming you have authentication set up)
        $user = Auth::user();
        
        // Create the comment
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->save();
        return redirect()->route('home.index')->with('success', 'comment created successfully.');
    }
}

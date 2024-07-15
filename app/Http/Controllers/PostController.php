<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return view('home.index',compact('posts'));
    }

    public function create()
    {
       
    }
    public function show(Post $post)
    {
        // Retrieve the count of likes for the post
        $post = $post->likes()->count();

        return view('posts.show', compact('post', 'post'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
    
        $post = new Post();
        $post->title = 'Post ' . Str::uuid();
        $post->content = $request->content;
        $post->user_id = Auth::id();
        $post->save();
    
        return redirect()->route('home.index')
            ->with('success', 'Post created successfully.');
    }
    public function like(Post $post)
    {
        $user_id = auth()->id();

        // Check if the user has already liked the post
        $hasLiked = Like::where('user_id', $user_id)
                        ->where('post_id', $post->id)
                        ->exists();

        if (!$hasLiked) {
            // If user hasn't liked the post yet, create a new like
            $like = new Like();
            $like->user_id = $user_id;
            $like->post_id = $post->id;
            $like->save();

            // Increment the likes count in the post
            $post->increment('likes');

            return back()->with('success', 'You liked the post.');
        } else {
            // If user has already liked the post, unlike it
            Like::where('user_id', $user_id)
                ->where('post_id', $post->id)
                ->delete();

            // Decrement the likes count in the post (if you track individual likes)
            // $post->decrement('likes');

            return back()->with('success', 'You unliked the post.');
        }
    }
}

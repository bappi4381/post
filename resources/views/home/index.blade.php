@extends('layouts.app-master')

@section('content')
<div class="container">
    @if(session('success'))
        <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf
                        <div class="mb-3">
                            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center mt-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Posts</div>
                @foreach ($posts as $post )
                    <div class="card-body">
                        <h3>@ {{$post->user->username}}</h3>
                        <p>{{ $post->content }}</p>
                    </div>
                    <div class="d-flex flex-row justify-content-between fs-10">
                        <div class="p-2"><span class="ml-1">{{ $post->likes()->count() }}Like</span></div>
                        <div class="p-2"><span class="ml-1">{{ $post->comments()->count() }}Comment</span></div>
                    </div>
                    <div class="bg-white">
                        <div class="d-flex flex-row fs-10">
                            <div class="like p-2 cursor">
                            <form action="{{ route('posts.like', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn ">
                                    @php
                                        $hasLiked = App\Models\Like::where('user_id', auth()->id())->where('post_id', $post->id)->exists();
                                    @endphp
                                    {{ auth()->check() && $hasLiked ? 'Unlike' : 'Like' }}
                                </button>
                            </form>
                            </div>
                            <div class="like p-2 cursor"> <button type="submit" class="btn "><i class="fa fa-commenting-o"></i><span class="ml-1">Comment</span></button></div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('comments.store') }}">
                        @csrf 
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="bg-light p-2">
                            <textarea class="form-control ml-1 shadow-none textarea" name="comment"></textarea>
                            <div class="mt-2 text-right">
                                <button class="btn btn-primary btn-sm shadow-none" type="submit">comment</button>
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
    
</div>
@endsection

<script>
    // Auto dismiss alert after 5 seconds
    setTimeout(function() {
        document.getElementById('alert').style.display = 'none';
    }, 2000); 
</script>
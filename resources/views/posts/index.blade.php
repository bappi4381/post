@extends('layouts.app-master')

@section('content')
<div class="container">
    @if(session('success'))
        <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center mt-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Posts</div>

                
                    @foreach ($posts as $post )
                    <div class="card border border-primary rounded m-2">
                        <div class="card-body">
                            <p>{{ $post->content }}</p>
                        </div>
                        <div class="d-flex flex-row justify-content-between fs-10">
                            <div class="p-2"><span class="ml-1">{{ $post->likes()->count() }}Like</span></div>
                            <div class="p-2"><span class="ml-1">{{ $post->comments()->count() }}Comment</span></div>
                        </div>

                        <div class="d-flex flex-row  fs-10">
                            <div class="p-2"><button class="btn btn-primary shadow-none" type="submit">EDIT</button></div>
                            <div class="p-2"><button class="btn btn-primary shadow-none" type="submit">DELETE</button></div>
                        </div>
                    </div>
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
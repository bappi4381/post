@extends('layouts.auth-master')

@section('content')
   <div class="container mt-5 ">
    <div class="d-flex justify-content-center vh-100 align-items-center">

    
    <div class="card" style="width: 28rem;">
        <div class="card-body">
            <form method="post" action="{{ route('login.perform') }}">
        
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <img class="mb-4" src="{!! url('images/bootstrap-logo.svg') !!}" alt="" width="72" height="57">
                
                <h1 class="h3 mb-3 fw-normal">Login</h1>
        
                @include('layouts.partials.massages')
        
                <div class="form-group form-floating mb-3">
                    <label for="floatingName">Email or Username</label>
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Email or Username" required="required" autofocus>
                    @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                
                <div class="form-group form-floating mb-3">
                    <label for="floatingPassword">Password</label>
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>
        
                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                <div class="text-center">
                    <p>Not a member? <a href="{{ route('register.perform') }}">Register</a></p>
                </div>
                @include('auth.partials.copy')
            </form>
        </div>
      </div>
    </div>
</div>
@endsection
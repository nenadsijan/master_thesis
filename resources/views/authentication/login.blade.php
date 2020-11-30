<script>
    window.onload = function () {
        if (typeof history.pushState === "function") {
            history.pushState("jibberish", null, null);
            window.onpopstate = function () {
                history.pushState('newjibberish', null, null);
            };
        } else {
            var ignoreHashChange = true;
            window.onhashchange = function () {
                if (!ignoreHashChange) {
                    ignoreHashChange = true;
                    window.location.hash = Math.random();
                } else {
                    ignoreHashChange = false;   
                }
            };
        }
    }
 </script>
@extends('layouts.index')

@section('content2')

        <div class="card card-container">
          
            <h1 style="text-align: center;">Login</h1>

<form method="POST" class="form-horizontal" role="form" action="/login">
                                {{csrf_field()}}
                                @include('inc._messages')
                                @if(session('error'))   
                                    <div class="alert alert-danger">
                                        {{ session('error') }}  
                                    </div>
                                @endif
    {{ csrf_field() }}
    <div class="form-group">
     <label>Email:</label>
        <input type="email" name="email" class="form-control"  placeholder="example@example.com"  required></input>
    </div>
    <div class="form-group">
     <label>Password:</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required></input>
    </div>
        <div class="form-group">
            <a href="/password_forgot">Forgot your password ?</a>
      </div>   
    <div class="form-group">
     <input type="submit" name="login" class="btn btn-primary" value="Login" />
     <a href="{{ route('clients.home') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Back</a>
    </div>

   </form>
             </div><!-- /card-container -->
      


@endsection
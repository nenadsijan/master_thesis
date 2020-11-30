@extends('layouts.index')

@section('content')

       <div class="jumbotron text-center" style="background: whitesmoke">
        <h1>Welcome To Diagnostic Application!</h1>
        <p>This is a master thesis work</p>

          @if(Sentinel::check() )
              <li role="presentation">
                <form method="POST"  action="/logout" id="logout-form">
                    {{csrf_field()}}

                    <input type="submit" value="logout" class="btn btn-primary btn-lg">

                </form>  
              </li>
            @else
        
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
        @endif  
    </div>

@endsection


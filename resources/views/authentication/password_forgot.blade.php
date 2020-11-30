@extends('layouts.index')
@section('content2')
 <div class="card card-container">        
     <h1 style="text-align: center;">Password Forgot</h1>
     @include('inc._messages')
		<form method="POST" class="form-horizontal" role="form" action="/password_forgot">
                                {{csrf_field()}}
    		<div class="form-group">
     			<label>Email:</label>
 					<input type="email" name="email" class="form-control" placeholder="example@example.com" required></input>
    		</div>
    		<div class="form-group">
     				<input type="submit" class="btn btn-primary" value="Send Code" />
     				<a href="{{ route('clients.home') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Back</a>
    		</div>

   		</form>
             </div><!-- /card-container -->
@endsection





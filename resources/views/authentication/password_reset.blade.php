
@extends('layouts.index')
@section('content2')
 <div class="card card-container">        
     <h1 style="text-align: center;">Password Reset</h1>
		<form method="POST" class="form-horizontal" role="form" action="">
                                	{{csrf_field()}}
 								 @include('inc._messages')

    		<div class="form-group">
     			<label>Password:</label>
 					<input type="password" name="password" class="form-control{{($errors->first('password') ? " form-error" : "")}}" placeholder="Password" required></input>
    		</div>
    		<div class="form-group">
     			<label>Password Confirmation:</label>
 					<input type="password" name="password_confirmation" class="form-control{{($errors->first('password_confirmation') ? " form-error" : "")}}" placeholder="Password Confirmaton" required></input>
    		</div>
    		<div class="form-group">
 				<input type="submit" value="Change Password" class="btn btn-success pull-right"></input>
   			</div>
   		</form>
    </div><!-- /card-container -->
@endsection

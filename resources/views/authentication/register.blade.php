@extends('layouts.index')

@section('content2')
 <div class="card card-container"> 
		   <h1 style="text-align: center;">Registrate</h1>
 
 							<form method="POST" class="form-horizontal" role="form" action="/register">
 								@include('inc._messages')
 								{{csrf_field()}}
 						 
							  
 								<div class="form-group">
 										  <label>First Name:</label>
 										<input type="name" name="first_name" class="form-control{{($errors->first('first_name') ? " form-error" : "")}}" placeholder="First name" value="{{ Request::old('first_name') }}" required></input>
 										
 								</div>	


 								<div class="form-group">
 										 <label>Last Name:</label>
  										<input type="name" name="last_name" class="form-control{{($errors->first('last_name') ? " form-error" : "")}}" placeholder="Last name" value="{{ Request::old('last_name') }}" required></input>
 										
 								</div>	

 									<div class="form-group">
 										 <label>Email:</label>
 										<input type="email" name="email" class="form-control{{($errors->first('email') ? " form-error" : "")}}" placeholder="example@example.com" value="{{ Request::old('email') }}"></input>
 										
 								</div>	

 								<div class="form-group">
 										<label>Password:</label>
 										<input type="password" name="password" class="form-control{{($errors->first('password') ? " form-error" : "")}}"placeholder="Password" ></input>
 								</div>	

 								<div class="form-group">
 										<label>Password Confirmation:</label>
 										<input type="password" name="password_confirmation" class="form-control{{($errors->first('password_confirmation') ? " form-error" : "")}}" placeholder="Password Confirmation"></input>
 										
 								</div>	



 							<div class="form-group">
 									
 										
 										<input type="submit" value="Registrate" class="btn btn-success pull-right"></input>
 										 <a href="{{ route('clients.home') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Back</a>
 								
 							</form>
	</div>
	




@endsection
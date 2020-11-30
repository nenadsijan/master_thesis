@extends('layouts.index')

@section('content2')

<div class="card card-container"> 
           <h1 style="text-align: center;">Register a Admin</h1>
            
                            <form method="POST" class="form-horizontal" role="form" action="{{ route('admin.create') }}">
                                 @include('inc._messages')
                                {{csrf_field()}}
                                <div class="form-group">
                                          <label>First Name:</label>
                                        <input type="name" name="first_name" class="form-control{{($errors->first('first_name') ? " form-error" : "")}}"  placeholder="First name"></input>
                                </div>  


                                <div class="form-group">
                                     <label>Last Name:</label>
                                        <input type="name" name="last_name" class="form-control{{($errors->first('last_name') ? " form-error" : "")}}"  placeholder="Last name"></input>
                                    
                                </div>  

                                    <div class="form-group">
                                           <label>Email:</label>
                                        <input type="email" name="email" class="form-control{{($errors->first('email') ? " form-error" : "")}}"  placeholder="example@example.com"></input>      
                                </div>  

                                <div class="form-group">
                                           <label>Password:</label>
                                        <input type="password" name="password" class="form-control{{($errors->first('password') ? " form-error" : "")}}"  placeholder="Password"></input>     
                                </div>  

                                <div class="form-group">
                                           <label>Password Confirmation:</label>
                                        <input type="password" name="password_confirmation" class="form-control{{($errors->first('password_confirmation') ? " form-error" : "")}}" placeholder="Password Confirmation"></input>   
                                </div>  



                            <div class="form-group">
                                    
                                         <a href="{{ route('admins.profiles') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Back</a>
                                        <input type="submit" value="Register" class="btn btn-success pull-right"></input>
                                    
                                
                            </form>
     
</div>




@endsection
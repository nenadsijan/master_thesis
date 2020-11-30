
@extends('layouts.index')

@section('content2')

<div class="card card-container"> 

           <h1 style="text-align: center;">Edit a Viewer</h1>
                
                          <form action="{{ route('admin.update') }}" method="post">
                                @include('inc._messages')

                <div class="form-group">
                    <label for="title">First Name:</label>
                    <input
                            type="text"
                            class="form-control{{($errors->first('first_name') ? " form-error" : "")}}"
                            id="first_name"
                            name="first_name"
                            value="{{ $user-> first_name }}">
                </div>
                <div class="form-group">
                    <label for="content">Last Name:</label>
                    <input
                            type="text"
                            class="form-control{{($errors->first('last_name') ? " form-error" : "")}}"
                            id="last_name"
                            name="last_name"
                            value="{{ $user->last_name }}">
                </div>
                <div class="form-group">
                    <label for="content">Email:</label>
                    <input
                            type="text"
                            class="form-control{{($errors->first('email') ? " form-error" : "")}}"
                            id="email"
                            name="email"
                            value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="content">New Password</label>
                    <input  required
                            type="password"
                            class="form-control{{($errors->first('password') ? " form-error" : "")}}"
                            id="new_password"
                            name="new_password"
                            value="{{ $user->new_password }}">

                    </input>        
                </div>
                <div class="form-group">
                    <label for="content">Password Confirmation</label>
                    <input required
                            type="password"
                            class="form-control{{($errors->first('new_password_confirmation') ? " form-error" : "")}}"
                            id="new_password_confirmation"
                            name="new_password_confirmation"
                            value="{{ $user->new_password_confirmation}}">
                    </input> 

                </div>
                 <div class="form-group">

                    <label for="content">Role:</label>
                    <select id="role" name="role">
                             <option value="2">Viewer</option>
                            <option value="1">Admin</option>
                           

                     </select>
                </div>
                @foreach($roles as $role)
                    {{$role->user_id}}
                @endforeach



                {{ csrf_field() }}
              
                <div class="form-group">
                           <input type="hidden" name="id" value="{{ $userId }}">
                               <a href="{{ route('viewers.profiles') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Back</a>
                            <button type="submit" class="btn btn-success ">Submit</button>
                        
               </div> 



            </form>
          
</div>




@endsection

@extends('layouts.index')

@section('content')
<h2 class="text-center">{{$admin->first_name}} profile page</h2>
      

   <table class="table table-striped">

  <tbody>
    <tr>
      <td scope="row">Name:</td>
      <td>{{$admin->first_name}}</td>
      
    </tr>
    <tr>
      <td scope="row">Last Name:</td>
      <td>{{$admin->last_name}}</td>
      
    </tr>
      <tr>
      <td scope="row">Email:</td>
      <td>{{$admin->email}}</td>
      
    </tr>
   
    <tr>
      <td scope="row">Last Activity:</td>
      <td>


@if(empty($admin->last_login))

<p>Never logged on to the system</p>
@else
{{
date('d-m-Y H:i:s', strtotime($admin->last_login))
}} 
@endif


      </td>
    </tr>
  </tbody>
</table>

<a href="{{ route('admins.profiles') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Return to all list of Admins</a>

@endsection
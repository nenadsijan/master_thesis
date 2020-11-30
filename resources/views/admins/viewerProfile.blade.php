
@extends('layouts.index')

@section('content')

<h2 class="text-center">{{$user->first_name}} profile page</h2>
			

   <table class="table table-striped" style="text-align: center;">

  <tbody>
    <tr>
      <td scope="row">Name:</td>
      <td>{{$user->first_name}}</td>
      
    </tr>
    <tr>
      <td scope="row">Last Name:</td>
      <td>{{$user->last_name}}</td>
      
    </tr>
      <tr>
      <td scope="row">Email:</td>
      <td>{{$user->email}}</td>
      
    </tr>
   
    <tr>
      <td scope="row">Last Activity:</td>
      <td>

@if(empty($user->last_login))

<p>Never logged on to the system</p>
@else
{{
date('d-m-Y H:i:s', strtotime($user->last_login))
}} 
@endif

      </td>
    </tr>
  </tbody>
</table>



@endsection
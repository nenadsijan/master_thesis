 	
@extends('layouts.index')

@section('content')

<style type="text/css">
  @media
    only screen 
    and (max-width: 760px), (min-device-width: 768px) 
    and (max-device-width: 1024px)  {

    /* Force table to not be like tables anymore */
    table, thead, tbody, th, td, tr {
      display: block;
    }

  }  
</style>

			

<h1>
          
          @if(Sentinel::check())

          Administrator, {{Sentinel::getUser()->first_name}}
           @endif 
          

        </h1>

       <h2 class="text-center" >{{$user->first_name}}List of viewers</h2>



        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Date/Time Added</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Last acitivity</th>
                    <th>Edit Viewer</th>
                    <th>Delete Viewer</th>
            
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                
                <tr>
                    <td> {{date('d-m-Y H:i:s', strtotime($user->created_at))}}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                   <td>              
                              @if(empty($user->last_login))

                              <p>Never logged</p>
                              @else
                              {{
                              date('d-m-Y H:i:s', strtotime($user->last_login))
                              }} 
                              @endif
                    </td>
                    

            <td> 
               <a href="{{ route('admin.edit', ['id' =>  $user -> id ]) }}" class="btn btn-info" style="text-align: center;">Edit</a>  
            </td>
            <td>
             <a href="{{ route('admin.delete', ['id' =>  $user -> id ]) }}" class="btn btn-danger" style="margin-right: 3px;">Delete</a>
            </td>
       
                      @endforeach  
   
                       </tr> 

 
                              
                

            </tbody>
        </table>  {{$users->links()}}

   <a href="{{ route('viewer.create') }}" class="btn btn-success pull-right">Register a new Viewer</a>
           

<style type="text/css">
  /*
  Max width before this PARTICULAR table gets nasty. This query will take effect for any screen smaller than 760px and also iPads specifically.
  */
  @media
    only screen 
    and (max-width: 760px), (min-device-width: 768px) 
    and (max-device-width: 1024px)  {
  
    /*
    Label the data
    You could also use a data-* attribute and content for this. That way "bloats" the HTML, this way means you need to keep HTML and CSS in sync. Lea Verou has a clever way to handle with text-shadow.
    */
    td:nth-of-type(1):before { content: "Date/Time Added"; }
    td:nth-of-type(2):before { content: "Name"; }
    td:nth-of-type(3):before { content: "Username"; }
    td:nth-of-type(4):before { content: "Email"; }
    td:nth-of-type(5):before { content: "Last acitivity"; }
    @if(!Sentinel::guest())
    @if(Sentinel::inRole('admin')) 
    td:nth-of-type(6):before { content: "Edit Viewer"; }
    td:nth-of-type(7):before { content: "Delete Viewer"; }
   @endif
  @endif  
  }
</style>
@endsection
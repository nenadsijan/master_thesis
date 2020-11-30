 	


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

       <h2 class="text-center" >{{$admins->first_name}}List of Admins</h2>



 <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Date/Time Added</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Last Activity</th>
 
                  
                </tr>
            </thead>

            <tbody>
                @foreach ($admins as $admin)
                
                <tr>

                    <td>  {{date('d-m-Y H:i:s', strtotime($admin->created_at))}}</td>
                    <td>{{ $admin->first_name }}</td>
                    <td>{{ $admin->last_name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>

                          @if(empty($admin->last_login))

                          <p>Never logged</p>
                          @else
                          {{
                          date('d-m-Y H:i:s', strtotime($admin->last_login))
                          }} 
                          @endif
                    </td>          
			     
                      @endforeach  
   
                       </tr> 

 
                              
                

            </tbody>
            
        </table>
         {{$admins->links()}}
    </div>


            <a href="{{ route('admin.create') }}" class="btn btn-success pull-right">Register a new Admin</a>

</div>
      

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
 

  }
</style>

@endsection
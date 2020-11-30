


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

<h2 class="text-center" >List of clients</h2>

<div class="row table-responsive">
  <table class="table table-bordered table-striped" id="results" style="text-align: center;">
    <thead>
      <tr>
  
        <th>Client Allias</th>
      @if(!Sentinel::guest())
      @if(Sentinel::inRole('admin'))
        <th>Client IP</th>
        <th>Client Port</th>
        <th>Data Collection Frequency</th>
        <th>Data Upload Frequency</th>
        <th>Server Allias</th>
        <th>Server IP</th>
        <th>Server Port</th>
      @endif
      @endif  
        <th>Client avialibilty</th>
        @if(!Sentinel::guest())
          @if(Sentinel::inRole('admin'))          
            <th>Change Client Frequencies</th>
            <th>Change Client IP and Ports</th> 
            <th>Delete Client</th>
          @endif
        @endif                      
      </tr>
    </thead>
    <tbody style="font-size: 14px;">
      @forelse ($clients as $client)
        <tr>
               
          <td>{{ $client->clientAllias }}</td>
           @if(!Sentinel::guest())
          @if(Sentinel::inRole('admin'))
          <td>{{ $client->clientIp }}</td>
          <td>{{ $client->clientPort }}</td>
          <td>{{ $client->dataCollectionFrequency }}</td>
          <td>{{ $client->dataUploadFrequency }}</td>
          <td>{{ $client->serverAllias }}</td>
          <td>{{ $client->serverIp }}</td>
          <td>{{ $client->serverPort }}</td>
        @endif
       @endif
         <td>
             @if($client->status  == 'true')
              <i class="fa fa-check-circle" style="font-size:18px;color:green">Online</i><br><br>
              @else
                <i class="fa fa-remove" style="font-size:18px;color:red">Offline</i><br><br>     
               @endif   


         </td>
  
          @if(!Sentinel::guest())
          @if(Sentinel::inRole('admin'))
          <td> 
            <a href="{{route('client.edit',  ['clientId' =>  $client -> clientId ])}}" class="btn btn-info" style="margin-right: 3px; ">Change</a>
          </td>  
          <td> 
            <a href="{{route('client.edit.port',  ['clientId' =>  $client -> clientId ])}}" class="btn btn-info" style="margin-right: 3px;">Edit</a>
          </td> 
          <td>  
            <a href="{{route('client.delete',  ['clientId' =>  $client -> clientId ])}}" class="btn btn-danger" style="margin-right: 3px;">Delete</a>
          </td> 
          @endif
          @endif    
          @empty
          @if(session('error')) 
          <div class="alert alert-danger">
            {{ session('error') }}  
            <p>Status:  {{$status}} </p>   
            <p> Error description:  {{ $message}} </p> 
          </div>
          @endif
          @endforelse
        </tr> 
      </tbody>
  </table>

</div>

  @if(!Sentinel::guest())
    @if(Sentinel::inRole('admin'))  
      @if(count($clients) !== 0)
      <div id="pageNavPosition"> </div>
        <a href="{{ route('client.create') }}" class="btn btn-success pull-right">Register a new Client</a>
      @endif
    @endif
  @endif 


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
       @if(!Sentinel::guest())
        td:nth-of-type(1):before { content: "Client Allias"; }
        td:nth-of-type(2):before { content: "Client avialibilty"; } 
          @endif 
   @if(!Sentinel::guest())
    @if(Sentinel::inRole('admin'))
        td:nth-of-type(1):before { content: "Client Allias"; }
        td:nth-of-type(2):before { content: "Client IP"; }
        td:nth-of-type(3):before { content: "Client Port"; }
        td:nth-of-type(4):before { content: "Data Collection Frequency"; }
        td:nth-of-type(5):before { content: "Data Upload Frequency"; }
        td:nth-of-type(6):before { content: "Server Allias"; }
        td:nth-of-type(7):before { content: "Server IP"; }
        td:nth-of-type(8):before { content: "Server Port"; }         
  
     @endif
    @endif
                    
  @if(!Sentinel::guest())
    @if(Sentinel::inRole('admin')) 
        td:nth-of-type(9):before { content: "Client avialibilty"; }     
        td:nth-of-type(10):before { content: "Change Client Frequencies"; }
        td:nth-of-type(11):before { content: "Change Client IP and Ports"; }  
        td:nth-of-type(12):before { content: "Delete Client"; }  
    @endif
  @endif  
}
</style>
    <script type="text/javascript">
      

// Instantiate pagination after data is available    
pager = new Pager('results', 5);
pager.init();
pager.showPageNav('pager', 'pageNavPosition');
pager.showPage(1);
      
// pagination object codes.
function Pager(tableName, itemsPerPage) {
    this.tableName = tableName;
    this.itemsPerPage = itemsPerPage;
    this.currentPage = 1;
    this.pages = 0;
    this.inited = false;

    this.showRecords = function (from, to) {
        var rows = document.getElementById(tableName).rows;
        // i starts from 1 to skip table header row
        for (var i = 1; i < rows.length; i++) {
            if (i < from || i > to) rows[i].style.display = 'none';
            else rows[i].style.display = '';
        }
    }

    this.showPage = function (pageNumber) {
        if (!this.inited) {
            alert("not inited");
            return;
        }

        var oldPageAnchor = document.getElementById('pg' + this.currentPage);
        oldPageAnchor.className = 'pg-normal';

        this.currentPage = pageNumber;
        var newPageAnchor = document.getElementById('pg' + this.currentPage);
        newPageAnchor.className = 'pg-selected';

        var from = (pageNumber - 1) * itemsPerPage + 1;
        var to = from + itemsPerPage - 1;
        this.showRecords(from, to);
    }

    this.prev = function () {
        if (this.currentPage > 1) this.showPage(this.currentPage - 1);
    }

    this.next = function () {
        if (this.currentPage < this.pages) {
            this.showPage(this.currentPage + 1);
        }
    }

    this.init = function () {
        var rows = document.getElementById(tableName).rows;
        var records = (rows.length - 1);
        this.pages = Math.ceil(records / itemsPerPage);
        this.inited = true;
    }

    this.showPageNav = function (pagerName, positionId) {
        if (!this.inited) {
            alert("not inited");
            return;
        }
        var element = document.getElementById(positionId);
        var pagerHtml = '<span onclick="' + pagerName + '.prev();" class="pg-normal">&#60</span>  ';
        for (var page = 1; page <= this.pages; page++)
            pagerHtml += '<span id="pg' + page + '" class="pg-normal" onclick="' + pagerName + '.showPage(' + page + ');">' + page + '</span>  ';
        pagerHtml += '<span onclick="' + pagerName + '.next();" class="pg-normal">&#62;</span>';
        element.innerHTML = pagerHtml;
    }
}
    </script>

 @endsection


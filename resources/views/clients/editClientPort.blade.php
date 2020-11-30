@extends('layouts.index')

@section('content2')




<div class="card card-container"> 
                <h1 style="text-align: center;"> {{ $client->data->clientAllias }} </h1>
                 <h3 style="text-align: center;"> Edit Ip and Port</h3>

                            <form method="POST" class="form-horizontal" role="form" action="{{ url('/editClientPort')}}/{{$client->data->clientId}}">
                            @include('inc._messages')    
                            {{csrf_field()}}
                            <div class="form-group">
                                        <label>Client IP:</label>
                                        <input 
                                            type="ip" 
                                            id="ip"
                                            name="ip"
                                            class="form-control{{($errors->first('ip') ? " form-error" : "")}}" 
                                            placeholder="ip"
                                            value="{{ $client->data->clientIp }}">
                                        </input>      
                            </div>  

                                    <div class="form-group">
                                        <label>Client Port:</label>
                                        <input 
                                            type="port" 
                                            id="port" 
                                            name="port" 
                                            class="form-control{{($errors->first('port') ? " form-error" : "")}}" 
                                            placeholder="port" 
                                            value="{{ $client->data->clientPort }}">
                                        </input>     
                                </div>
                            
                                  
                            <div class="form-group">
                                    
                                        
                                        <input type="submit" value="Submit" class="btn btn-success pull-right"></input>
                                     <a href="{{ route('clients.home') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Back</a>
                                
                            </form>
        
</div>


@endsection
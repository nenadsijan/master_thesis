@extends('layouts.index')

@section('content2')


     <div class="card card-container"> 
                        <h1 style="text-align: center;">{{ $client->data->clientAllias }}</h1>
                        <h3 style="text-align: center;"> Edit Frequencies</h3>
                            <form method="POST" class="form-horizontal" role="form" action="{{ url('/editClient')}}/{{$client->data->clientId}}">
                            @include('inc._messages')    
                            {{csrf_field()}}
                                <div class="form-group">
                                        <label>Collection Frequency:</label>
                                        <input 
                                            type="name" 
                                            id="collectionFrequency" 
                                            name="collectionFrequency" 
                                            class="form-control{{($errors->first('collectionFrequency') ? " form-error" : "")}}" 
                                            placeholder="collectionFrequency" 
                                            value="{{$client->data->dataCollectionFrequency}}">
                                        </input>    
                                </div>  

                                <div class="form-group">
                                     <label>Upload Frequency:</label>
                                        <input id="uploadFrequency"
                                             type="name" 
                                             name="uploadFrequency" 
                                            class="form-control{{($errors->first('uploadFrequency') ? " form-error" : "")}}" 
                                             placeholder="uploadFrequency " 
                                             value="{{$client->data->dataUploadFrequency}}">
                                         </input>    
                                </div>  
                            
                                  
                            <div class="form-group">
                                    
                                        
                                        <input type="submit" value="Submit" class="btn btn-success pull-right"></input>
                                     <a href="{{ route('clients.home') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Back</a>
                                
                            </form>
             
    </div>



@endsection
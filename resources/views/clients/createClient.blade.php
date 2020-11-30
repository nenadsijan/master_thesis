@extends('layouts.index')

@section('content2')


    <div class="card card-container"> 
                        <h1 style="text-align: center;">Register a Client</h1>
                
                            <form method="POST" class="form-horizontal" role="form" action="{{ route('client.create') }}">
                                @include('inc._messages')   
                                {{csrf_field()}}
                                <div class="form-group">
                                        <label>Client Alias:</label>
                                        <input type="name" id="clientAllias" name="clientAllias"
                                         class="form-control{{($errors->first('clientAllias') ? " form-error" : "")}}" 
                                         placeholder="clientAllias" value="{{ Request::old('clientAllias') }}"></input>      
                                </div>  


                                <div class="form-group">
                                    <label>Client IP:</label>
                                        <input type="name" id="clientIp" name="clientIp" 
                                         class="form-control{{($errors->first('clientIp') ? " form-error" : "")}}" 
                                         placeholder="clientIp" value="{{ Request::old('clientIp') }}"></input>
                                </div>  

                                    <div class="form-group">
                                    <label>Client Port:</label>
                                         <input type="name" id="clientPort" name="clientPort" 
                                          class="form-control{{($errors->first('clientPort') ? " form-error" : "")}}" 
                                         placeholder="clientPort" value="{{ Request::old('clientPort') }}"></input>    
                                </div>  

                                <div class="form-group">
                                        <label>Data Collection Frequency:</label>
                                        <input type="name" id="dataCollectionFrequency" name="dataCollectionFrequency" 
                                         class="form-control{{($errors->first('dataCollectionFrequency') ? " form-error" : "")}}" 
                                        placeholder="dataCollectionFrequency" value="{{ Request::old('dataCollectionFrequency') }}"></input>  
                                </div>  

                                <div class="form-group">
                                    <label>Data Upload Frequency:</label>
                                        <input id="dataUploadFrequency" type="name" name="dataUploadFrequency" class="form-control{{($errors->first('dataUploadFrequency') ? " form-error" : "")}}"  
                                        placeholder="dataUploadFrequency " value="{{ Request::old('dataUploadFrequency') }}"></input>    
                                </div>  
                            
                                  <div class="form-group">
                                        <label>Server Alias:</label>
                                        <input type="name" id="serverAllias" name="serverAllias" 
                                        class="form-control{{($errors->first('serverAllias') ? " form-error" : "")}}"  
                                        placeholder="serverAllias" value="{{ Request::old('serverAllias') }}"></input>    
                                </div>  

                                  <div class="form-group">
                                        <label>Server IP:</label>
                                        <input type="name" id="serverIp" name="serverIp" 
                                         class="form-control{{($errors->first('serverIp') ? " form-error" : "")}}" 
                                         placeholder="serverIp" value="{{ Request::old('serverIp') }}"></input>  
                                </div>  

                                 <div class="form-group">
                                    <label>Server Port:</label>
                                        <input type="name"  id="serverPort" name="serverPort" 
                                        class="form-control{{($errors->first('serverPort') ? " form-error" : "")}}"  
                                        placeholder="serverPort" value="{{ Request::old('serverPort') }}"></input>     
                                </div>  

                            <div class="form-group">
                                    
                                        
                                        <input type="submit" value="Register" class="btn btn-success pull-right"></input>
                                     <a href="{{ route('clients.home') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Back</a>
                                
                            </form>
           
</div>




@endsection
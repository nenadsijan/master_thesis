<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Exception;
use Session;
use Validator;
use File;


class ClientsController extends Controller
{

 
 

//Listing clients from java application 
public function getClients(){
$path=file_get_contents("C:\Users\Sijan\Desktop\master6.7.2018\change_api_path\change_url.txt");

   try{
    $client = new Client();

    $response = $client->request('GET', $path.'clients');
    $body = $response->getBody();
    $status = 'true';
    $message = 'Data found!';
    $data = json_decode($body);
        $id_array = array();
    foreach ($data as $item) {
        // Add each id value in your array
        $id_array[]= $item->clientId;
    }

//$clients_status = array();
    foreach($id_array as $key => $my_id) {
       $response2 = $client->request('GET', $path.'clients/clientAvailability/'.$my_id );
       $status = json_decode($response2->getBody());
     //  $clients_status[] = $status;
       $data[$key]->status = $status;
    }

return view('clients.home', ['clients' => $data]);
    // is thrown for 400 level errors 
}catch(ClientException $ce){
    $status = 'false';
    $message = $ce->getMessage();
    $data = [];
    Session::flash('error', 'Clients list is empty because there is no connection !');
return view('clients.home', ['status'=>$status,'message'=>$message,'clients'=>$data]);
    //In the event of a networking error (connection timeout, DNS errors, etc.)
}catch(RequestException $re){
   $status = 'false';
   $message = $re->getMessage();
   $data = [];
    Session::flash('error', 'Clients list is empty because there is no connection !');
return view('clients.home', ['status'=>$status,'message'=>$message,'clients'=>$data]);
}//If some error occurs
catch(Exception $e){
   $this->status = 'false';
   $this->message = $e->getMessage();
   $data = [];
    Session::flash('error', 'Clients list is empty because there is no connection !');
return view('clients.home', ['status'=>$status,'message'=>$message,'clients'=>$data]);
}

}




//function for redirecting to create client page
public function getCreateClient(){
		   return view('clients.createClient');
	}



//function for sending data to restapi
public function postCreateClient(Request $request){
    $path=file_get_contents("C:\Users\Sijan\Desktop\master6.7.2018\change_api_path\change_url.txt");
    $this->validate($request, [
            'clientAllias' => 'required|min:4|max:50',
            'clientIp' => 'required|ip',
            'clientPort' => 'required|numeric',
            'dataCollectionFrequency' => 'required|numeric',
            'dataUploadFrequency'  =>  'required|numeric',
            'serverAllias'  =>  'required|min:4|max:50',
            'serverIp'  =>  'required|ip',
            'serverPort'  =>  'required|numeric',
        ]);

    $clientAllias = $request->get('clientAllias');
    $clientIp = $request->get('clientIp');
    $clientPort = $request->get('clientPort');
    $dataCollectionFrequency = $request->get('dataCollectionFrequency');
    $dataUploadFrequency = $request->get('dataUploadFrequency');
    $serverAllias = $request->get('serverAllias');
    $serverIp = $request->get('serverIp');
    $serverPort = $request->get('serverPort');
        try {
            $client = new Client(); 
            $request = $client->request('POST', $path.'clients/createClient', [
                'json' => [
            "clientAllias"            => $clientAllias,
            'clientIp'                => $clientIp,
            'clientPort'              => $clientPort,
            'dataCollectionFrequency' => $dataCollectionFrequency,
            'dataUploadFrequency'     => $dataUploadFrequency,
            'isClientAvailable'       => false,
            'serverAllias'            => $serverAllias,
            'serverIp'                => $serverIp,
            'serverPort'              => $serverPort
                ]
            ]);
           $response = $request->getBody()->getContents(); 
           Session::flash('success', 'You created a client !');
           return redirect()->route('clients.home', ['status'=>$status,'message'=>$message]);
        }catch(ClientException $ce){
            $status = 'false';
            $message = $ce->getMessage();
           Session::flash('success', 'Operation is not successful, There is no connection');
           return redirect()->route('clients.home', ['status'=>$status,'message'=>$message]);
            
            //In the event of a networking error (connection timeout, DNS errors, etc.)
        }catch(RequestException $re){
           $status = 'false';
           $message = $re->getMessage();
          Session::flash('success', 'Operation is not successful, There is no connection !');
           return redirect()->route('clients.home', ['status'=>$status,'message'=>$message]);
        }//If some error occurs
        catch(Exception $e){
           $this->status = 'false';
           $this->message = $e->getMessage();
              Session::flash('error', 'Operation is not successful, There is no connection !');
           return redirect()->route('clients.home', ['status'=>$status,'message'=>$message]);
          
}       
       
    }
//Function for changing Frequencies page
public function getEditClient($clientId)
    {
   $path=file_get_contents("C:\Users\Sijan\Desktop\master6.7.2018\change_api_path\change_url.txt");
      try {
      
        $client = new Client();

    $response = $client->request('GET', $path.'clients/'.$clientId);
    $body = $response->getBody();
    $status = 'true';
    $message = 'Data found!';
    $data = json_decode($body);
    return view('clients.editClient', ['client' => $data]);
    }catch(ClientException $ce){
            $status = 'false';
            $message = $ce->getMessage();
           
            
            //In the event of a networking error (connection timeout, DNS errors, etc.)
        }catch(RequestException $re){
           $status = 'false';
           $message = $re->getMessage();
        
        }//If some error occurs
        catch(Exception $e){
           $this->status = 'false';
           $this->message = $e->getMessage();
            
          
        }       
           Session::flash('success', 'You can not access!');
           return redirect()->route('clients.home', ['status'=>$status,'message'=>$message]);
    }   
    

//Function for changing Frequencies 
public function postEditClient(Request $request, $clientId)
    {
      $path=file_get_contents("C:\Users\Sijan\Desktop\master6.7.2018\change_api_path\change_url.txt");
      $this->validate($request, [
            'collectionFrequency' => 'required|numeric',
            'uploadFrequency'  =>  'required|numeric',
          
        ]);

        $collectionFrequency = $request->get('collectionFrequency');
        $uploadFrequency = $request->get('uploadFrequency');
         try {
            $client = new Client(); 
            $request = $client->request('POST',  $path.'clients/changeFrequencyByClientId/'.$clientId, [
                'json' => [
           
            'collectionFrequency' => $collectionFrequency,
            'uploadFrequency'     => $uploadFrequency,
            
                ]
            ]);
           $response = $request->getBody()->getContents();
           $status = 'true';
            $message = 'Data found!';  
            
        }catch(ClientException $ce){
            $status = 'false';
            $message = $ce->getMessage();
           
            return view('clients.home');
            //In the event of a networking error (connection timeout, DNS errors, etc.)
        }catch(RequestException $re){
           $status = 'false';
           $message = $re->getMessage();
        
        }//If some error occurs
        catch(Exception $e){
           $this->status = 'false';
           $this->message = $e->getMessage();
            
          
        }       
           Session::flash('success', 'You Updated a client Frequencies!');
           return redirect()->route('clients.home', ['status'=>$status,'message'=>$message]);
    }


       
  //Function for changing Ports and IP page
public function getEditClientPort($clientId)
    {
   $path=file_get_contents("C:\Users\Sijan\Desktop\master6.7.2018\change_api_path\change_url.txt");
      try {
        $url= $path. 'clients/'.$clientId;
        $client = new Client();

    $response = $client->request('GET', $url);
    $body = $response->getBody();
    $status = 'true';
    $message = 'Data found!';
    $data = json_decode($body);
    return view('clients.editClientPort', ['client' => $data]);
    }catch(ClientException $ce){
            $status = 'false';
            $message = $ce->getMessage();
           
            
            //In the event of a networking error (connection timeout, DNS errors, etc.)
        }catch(RequestException $re){
           $status = 'false';
           $message = $re->getMessage();
        
        }//If some error occurs
        catch(Exception $e){
           $this->status = 'false';
           $this->message = $e->getMessage();
            
          
        }       
           Session::flash('success', 'You can not access!');
           return redirect()->route('clients.home', ['status'=>$status,'message'=>$message]);
    }   


//Function for changing Ports and Ip 
public function postEditClientPort(Request $request, $clientId)
    {
       $path=file_get_contents("C:\Users\Sijan\Desktop\master6.7.2018\change_api_path\change_url.txt");
      $this->validate($request, [
            'ip' => 'required|ip',
            'port' => 'required|numeric',
          
        ]);

        $clientIp = $request->get('ip');
        $clientPort = $request->get('port');

         try {
            $client = new Client(); 
            $request = $client->request('POST', $path.'clients/setConfiguration/'.$clientId, [
                'json' => [
               
                 'ip'  => $clientIp,
                'port' => $clientPort,
            
                ]
            ]);
           $response = $request->getBody()->getContents();
           $status = 'true';
            $message = 'Data found!';  
            
        }catch(ClientException $ce){
            $status = 'false';
            $message = $ce->getMessage();
           
            return view('clients.home');
            //In the event of a networking error (connection timeout, DNS errors, etc.)
        }catch(RequestException $re){
           $status = 'false';
           $message = $re->getMessage();
        
        }//If some error occurs
        catch(Exception $e){
           $this->status = 'false';
           $this->message = $e->getMessage();
            
          
        }       
           Session::flash('success', 'You Updated a client Port and IP!');
           return redirect()->route('clients.home', ['status'=>$status,'message'=>$message]);
    }



//Function for removing a client
public function deleteClient($clientId)
    {
       $path=file_get_contents("C:\Users\Sijan\Desktop\master6.7.2018\change_api_path\change_url.txt");
        $client = new Client();
        $apiRequest = $client->request('DELETE', $path.'clients/deleteClient/'.$clientId);
        return redirect()->route('clients.home')->with('Delete author successfully');
    }
 }






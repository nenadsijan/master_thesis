<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Activation;
use Validator;
use App\User;
use Mail;
use Session;
class RegistrationController extends Controller
{		


		//function for showing register page
      public function register(){

    	return view ('authentication.register');
	  }
    	

	  	//function for writing user in database
    	 public function postRegister(Request $request){	
             $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'email|required|unique:users',
                'password'  =>  'required|min:6|confirmed',
                'password_confirmation'  =>  'min:6',
           
            ]);
try{
    
    	     	$user=Sentinel::register($request -> all());
            $activation=Activation::create($user);
            $role=Sentinel::findRoleBySlug('viewer');
            $role->users()->attach($user);
            $this -> sendEmail($user, $activation ->code);
            Session::flash('success', 'Activation link was sent to your email !');
            return redirect('/');


      }          
  catch (ThrottlingException $exception){

            $delay= $exception -> getdelay();
            return redirect()->back()->with(['error' => 'Banned login! ' . $delay . 'seconds!']);

          } 
    	 }

         //function for creating activation mail which will be send to users email
          private function sendEmail($user, $code){
            Mail::send('emails.activation', [

                'user' => $user,
                'code' => $code
                 ], function($message) use ($user){

                 $message -> to ($user->email);   
                    $message -> subject("Hello " . $user ->first_name , "here you can activate your account.");

                 } );


        }


}

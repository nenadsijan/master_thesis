<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Reminder;
use Mail;
use Sentinel;
class PasswordForgotController extends Controller
{
    public function  Passwordforgot(){


    	return view('authentication.password_forgot');

    }

    //function for searching email of user and writing new one in database
    public function  postPasswordforgot(Request $request){

    	$user=User::whereEmail($request ->email)->first();
    	
    	if(count($user)==0) {
    		return redirect()->back()->with(['success' => 'Reset Code was sent to your email']); 
    	}
    	$reminder=Reminder::exists($user) ?: Reminder::create($user);	

    	$this -> sendEmail($user, $reminder ->code);
    	return redirect()->back()->with(['success' => 'Reset Code was sent to your email']); 
    	
    }


//function for collection infos from inputs and reset password
	public function  resetPassword($email, $resetCode){
       //taking email from database with calling on model function 
	   $user=User::byEmail($email);
      
       //in case if somene changes url(email inside of url) show blank page
       if(count($user)==0){
        abort(404);

       }
          //checking is user Restcode in url same as one from database
       if($reminder = Reminder::exists($user)){
        //checking if someone change reset code in url
        if($resetCode == $reminder->code)
            return view('authentication/password_reset');
        else
            return redirect('/');
        }else{

          return redirect('/');   


        }
	}

    //function for changing password

    public function  postResetPassword(Request $request, $email, $resetCode){

        //validation of inputs
       
        $this->validate($request, [
            'password' => 'confirmed|min:5|max:15',
            'password_confirmation' => 'required|min:5|max:15'
        ]);

        $user=User::byEmail($email);
       
       //in case if somene changes url(email inside of url) show blank page
       if(count($user)==0){
        abort(404);

       }
          //checking is user Restcode in url same as one from database
       if($reminder = Reminder::exists($user)){
        if($resetCode == $reminder->code){
            Reminder::complete($user, $resetCode, $request->password);
           return redirect('/login')->with('success', 'Please login with your new password!');
         }
        else{
            return redirect('/');
            }
 
        }else{

          return redirect('/');   


        }
    }





    //function for creating reset password mail which will be send to users email
    	 private function sendEmail($user, $code){
            Mail::send('emails.link_password_forgot', [

                'user' => $user,
                'code' => $code
                 ], function($message) use ($user){

                 $message -> to ($user->email);   
                    $message -> subject("Hello " . $user ->first_name , "here you can reset your password.");

                 } );


        }	


}

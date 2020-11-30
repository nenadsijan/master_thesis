<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\User;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Session;
use Validator;
class LoginController extends Controller
{
      public function login(){

      return view ('authentication.login');
    }

      //function for login
     public function postLogin(Request $request){
          $this->validate($request, [
                
                'email' => 'email|required',
                'password'  =>  'required',
              
           
            ]);


   
        try{
              
              $rememberMe=false;
                if(isset($request->remember_me))
                      $rememberMe=true;

              if(Sentinel::authenticate($request->all(), $rememberMe)){

                     $slug=Sentinel::getuser()->roles()->first()->slug;
                  if($slug=='admin')

                    return redirect('/home')->with(['success' => 'You logged in as admin !']);
                  elseif($slug=='viewer')

                          return redirect('/home')->with(['success' => 'You logged in as viewer !']);;
                  
                 } else{

                    return redirect()->back()->with(['error' => 'Wrong credentials!']);
                  }
                

                }     

              //this error is used if we have repetition of same info in input
          catch (ThrottlingException $exception){

            $delay= $exception -> getdelay();
            return redirect()->back()->with(['error' => 'Banned login! ' . $delay . 'seconds!']);

          }  
           //used for not activated error
           catch (NotActivatedException $exception){

            return redirect()->back()->with(['error' => 'Account is not activated']);
          } 
}


     public function logout(){
      

        Sentinel::logout();
        return redirect('/login');
      
    }




}


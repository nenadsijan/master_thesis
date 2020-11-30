<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Sentinel;
use Activation;
class ActivationController extends Controller
{
	//function for user activation
    public function activate ($email, $activationCode){
    		$user=User::whereEmail($email)->first();
    		

    	If(Activation::complete($user, $activationCode)){	
    	
    		return redirect('/login');

    	}else{
    		
    }
}
}
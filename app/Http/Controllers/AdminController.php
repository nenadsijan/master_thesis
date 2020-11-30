<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use App\User;
use App\Role;
use DB;
use Sentinel;
use Activation;
use Session;
use Validator;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{


	
	 //function for showing list of viewers

      public function viewersProfiles(){
      	
      	$users = DB::table('users')
        ->leftJoin('role_users', 'users.id', '=', 'role_users.user_id')
        ->select('users.*')
        ->where('role_id', '=', '2')
        ->orderBy('created_at', 'desc')
        ->paginate(10);      	

             
      	 return view('admins.viewersList', ['users' => $users, 'roles' => $roles]);
      	
      }

 //function for showing list of admins
      public function adminsProfiles(){
        
        $admins = DB::table('users')
        ->leftJoin('role_users', 'users.id', '=', 'role_users.user_id')
        ->select('users.*')
        ->where('role_id', '=', '1')
        ->orderBy('created_at', 'desc')
        ->paginate(10);       

        
       

              
         return view('admins.adminsList', ['admins' => $admins, 'roles' => $roles]);
        
      }


 //function for removing viewer profil
      public function postAdminDelete( $id)
    {
        $user = User::find($id);
        $user->delete();
                 return redirect()->route('viewers.profiles')->with('info', 'Post deleted ');

    }

   

 	 
 
   //function for redirecting to edit profile page 

   public function getAdminEdit(Request $request, $id)
    {

        $user = User::find($id);
        $roles = Role::get()->pluck('name', 'id');

        return view('admins.edit', ['user' => $user, 'userId' => $id, 'roles' => $roles, 'roles_id'=>$id]);
    }




   //function for editing viewers profile


  public function postAdminUpdate(Store $session, Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:5',
            'last_name' => 'required|min:5',
             'email' => 'required|email|max:255'
        ]);
        $user = User::find($request -> input('id'));
        $user -> first_name = $request -> input('first_name');
        $user -> last_name = $request -> input('last_name');
        $user -> email = $request -> input('email');
       
                if ($request->new_password == $request->new_password_confirmation ){
                     $user->password=bcrypt($request->new_password);
                 }else{
                   
                  return redirect()->back()->withErrors(['Your old password is incorrect']);
                 }
              
        $user->save();
if ($request->role) {
              $user->roles()->sync([$request->role]);
            }
 

return redirect()->route('viewers.profiles')->with('info', 'Success ');

    }



   //function for redirecting to create admin profile page


public function getAdminCreate()
    {
    
        return view('admins.createAdmin');
    }




  //function for writing admin profile in database
       public function postAdminCreate(Request $request){  

          $this->validate($request, [
            'first_name' => 'required|min:5',
            'last_name' => 'required|min:5',
            'email' => 'email|required|unique:users',
            'password'  =>  'required|min:6|confirmed',
            'password_confirmation'  =>  'min:6',
        ]);
            $user=Sentinel::register($request -> all());
            $activation = Activation::exists($user);
            if($activation){
                Activation::complete($user, $activation->code);
            }   
            else{
                $activation2 = Activation::create($user);
                Activation::complete($user, $activation2->code);
            }
            $role=Sentinel::findRoleBySlug('admin');
            $role->users()->attach($user);
             $user->save();
             Session::flash('success', 'Admin is created !');
              return redirect()->route('admins.profiles');
    }



//function for redirecting to create viewer profile page
public function getViewerCreate()
    {
    
        return view('admins.createViewer');
    }






  //function for writing viewer profile in database
       public function postViewerCreate(Request $request){  
          $this->validate($request, [
            'first_name' => 'required|min:5',
            'last_name' => 'required|min:5',
              'email' => 'email|required|unique:users',
              'password'  =>  'required|min:6|confirmed',
                'password_confirmation'  =>  'min:6',
        ]);

            $user=Sentinel::register($request -> all());
            $activation = Activation::exists($user);
            if($activation){
                Activation::complete($user, $activation->code);
            }   
            else{
                $activation2 = Activation::create($user);
                Activation::complete($user, $activation2->code);
            }
            $role=Sentinel::findRoleBySlug('viewer');
            $role->users()->attach($user);
             $user->save();
             Session::flash('success', 'Viewer is created !');
              return redirect()->route('viewers.profiles');
    }


  //function for showing Viewer profil 
   public function showViewerProfile(Request $request, $first_name)
    {
          $user=User::whereFirst_name($first_name)->first();


        return view('admins.viewerProfile', ['user' => $user]);
    }


 //function for showing Admin profil 
   public function showAdminProfile(Request $request,$id)
    {
        $admin = User::findOrFail($id);  

        return View('admins.adminProfile', ['admin' => $admin ]);
    }


}



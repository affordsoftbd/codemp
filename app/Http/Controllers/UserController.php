<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Post;
use Auth;
use DB;
use Session;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        
    }

    public function saveProfile(Request $request){
        try {
            DB::beginTransaction();
            
            if($request->email!=''){
                $emailCheck = User::where('email',$request->email)->first();
                if(!empty($emailCheck)){
                    if($request->old_email!=$request->email){
                        return ['status'=>401,'reason'=>'Duplicate email address'];
                    }
                }
            }
            $usernameCheck = User::where('username',$request->username)->first();
            if(!empty($usernameCheck)){
                if($request->old_username != $request->username){
                    return ['status'=>401,'reason'=>'Duplicate username'];
                }
            }
            
            $phoneCheck = UserDetail::where('phone',$request->phone)->first();
            if(!empty($phoneCheck)){
                if($request->old_phone != $request->phone){
                    return ['status'=>401,'reason'=>'Duplicate phone number'];
                }
            }
            
            $user = User::where('id',Session::get('user_id'))->first();         
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->username = $request->username;
            if(trim($request->password)!=''){
                $user->password = bcrypt($request->password);
            }
            $user->updated_at = date('Y-m-d h:i:s');
            $user->save();
            
            /*
            * Save user details
            */
            $userDetail = UserDetail::where('user_id',Session::get('user_id'))->first();  
            $userDetail->phone = $request->phone;
            $userDetail->nid = $request->nid;
            $userDetail->address = $request->address;
            $userDetail->save();

            /*
            * Update profile image
            */ 
            if($request->hasFile('profile_image')){
                $profile_image = $request->file('profile_image');

                /*Save original image*/
                $destinationPath = 'public/uploads/users/';
                $extension = $profile_image->getClientOriginalExtension();
                $file_name = rand(11111, 99999) . '.' . $extension;
                $file_path = "/".$destinationPath."/".$file_name;
                $profile_image->move($destinationPath, $file_name);
                /*Save original image*/

                $photo = UserDetail::where('user_id',Session::get('user_id'))->first();
                $photo->image_path = $file_path;
                $photo->save();
            }
            
            DB::commit();
            
            Session::put('email',$request->email);
            Session::put('first_name',$request->first_name);
            Session::put('last_name',$request->last_name);
    
            return ['status'=>200,'reason'=>'Successfully saved'];
        }
        catch (\Exception $e) {
            DB::rollback();
            return ['status'=>200,'reason'=>$e->getMessage()];
        }
    }

    public function updatePassword(Request $request){
        try {
            DB::beginTransaction();
            
            $result = Auth::attempt(['username' => Session::get('username'),
            'password' => $request->old_password
            ]);

            if(!$result){
                return ['status'=>401,'reason'=>'Old password is not valid'];
            }     
            
            $user = User::where('id',Session::get('user_id'))->first();  
            $user->password = bcrypt($request->password);
            $user->updated_at = date('Y-m-d h:i:s');
            $user->save();
            
            DB::commit();
            return ['status'=>200,'reason'=>'Password successfully updated'];
        }
        catch (\Exception $e) {
            DB::rollback();
            return ['status'=>200,'reason'=>$e->getMessage()];
        }
    }
}

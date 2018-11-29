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
            $user->role_id = $request->role_id;
            $user->updated_at = date('Y-m-d h:i:s');
            $user->save();
            
            /*
            * Save user details
            */
            $userDetail = UserDetail::where('user_id',Session::get('user_id'))->first();  
            $userDetail->phone = $request->phone;
            $userDetail->nid = $request->nid;
            $userDetail->address = $request->address;
            $userDetail->division_id = $request->division;
            $userDetail->district_id = $request->district;
            $userDetail->thana_id = $request->thana;
            $userDetail->zip_id = $request->zip;
            $userDetail->save();

            /*
            * Update profile image
            */ 
            /*if($request->hasFile('profile_image')){
                $profile_image = $request->file('profile_image');

                // Save original image
                $destinationPath = 'public/uploads/users/';
                $extension = $profile_image->getClientOriginalExtension();
                $file_name = rand(11111, 99999) . '.' . $extension;
                $file_path = "/".$destinationPath."/".$file_name;
                $profile_image->move($destinationPath, $file_name);

                $photo = UserDetail::where('user_id',Session::get('user_id'))->first();
                $photo->image_path = $file_path;
                $photo->save();
            }*/
            
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

    public function updateProfileImage(Request $request, $id){
        try {
            $validator = \Validator::make($request->all(), [
                'image'  => 'required|image|dimensions:min_width=100,min_height=200|max:500',
            ]);
            if ($validator->fails()) {
                Session::flash('error', array('এরর!'=>'দুঃখিত! ছবি আপডেট করা যায়নি! ছবির জন্য সর্বাধিক অনুমোদিত আকার 500 কেবি!'));
            }
            $imageUpload = $this->uploadImage($request->file('image'), 'users/', 640, 480);
            DB::table('user_details')->where('user_id', $id)->update(['image_path' => $imageUpload]);  
            Session::put('image_path', $imageUpload);  
            Session::flash('success', array('সফল!'=>'প্রোফাইল ছবি সফলভাবে আপডেট করা হয়েছে'));
        }
        catch (\Exception $e) {
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
                return ['status'=>401,'reason'=>'পুরানো পাসওয়ার্ড বৈধ নয়'];
            }     
            
            $user = User::where('id',Session::get('user_id'))->first();  
            $user->password = bcrypt($request->password);
            $user->updated_at = date('Y-m-d h:i:s');
            $user->save();
            
            DB::commit();
            return ['status'=>200,'reason'=>'পাসওয়ার্ড সফলভাবে আপডেট করা হয়েছে'];
        }
        catch (\Exception $e) {
            DB::rollback();
            return ['status'=>200,'reason'=>$e->getMessage()];
        }
    }
}

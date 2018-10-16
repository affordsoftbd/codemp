<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use Auth;
use DB;;
use Session;

class AuthController extends Controller
{
    public function login()
    {
        if(Auth::check()){
            return redirect('home');
        }
        return view ('auth.login');
    }

    public function retry()
    {
        if(Auth::check()){
            return redirect('home');
        }
        return view ('auth.retry');
    }

    public function recovery()
    {
        if(Auth::check()){
            return redirect('home');
        }
        return view ('auth.passwords.email');
    }

    public function reset()
    {
        if(Auth::check()){
            return redirect('home');
        }
        return view ('auth.passwords.reset');
    }

    public function politicianRegister(){
        if(Auth::check()){
            return redirect('home');
        }
        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['thanas'] = DB::table('thanas')->get();
        $data['zips'] = DB::table('zips')->get();
        $data['roles'] = DB::table('roles')->where('role_id','!=',1)->get();
        return view('auth.politician_register',$data);
    }

    public function publicRegister(){        
        if(Auth::check()){
            return redirect('home');
        }
        return view('auth.public_register');
    }

    public function savePublicUser(Request $request){
        try {
            DB::beginTransaction();
            
            if($request->email!=''){
                $emailCheck = User::where('email',$request->email)->first();
                if(!empty($emailCheck)){
                    return ['status'=>401,'reason'=>'Duplicate email address'];
                }
            }
            $usernameCheck = User::where('username',$request->username)->first();
            if(!empty($usernameCheck)){
                return ['status'=>401,'reason'=>'Duplicate username'];
            }
            
            $phoneCheck = UserDetail::where('phone',$request->phone)->first();
            if(!empty($phoneCheck)){
                return ['status'=>401,'reason'=>'Duplicate phone number'];
            }
            
            $user = NEW User();
            $user->parent_id = 0;          
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->role_id = $request->role_id;
            $user->status = 'Active';
            $user->created_at = date('Y-m-d h:i:s');
            $user->save();
            
            /*
            * Save user details
            */
            $userDetail = NEW UserDetail();
            $userDetail->user_id = $user->id;
            $userDetail->phone = $request->phone;
            $userDetail->address = $request->address;
            $userDetail->save();
            
            DB::commit();
            
            /*
            * Now auto login user
            */
            $result = Auth::attempt(['username' => trim($request->username),
                'password' => $request->password
            ]);
    
            if($result){
                $user = Auth::user();
                Session::put('role_id',$user->role_id);
                Session::put('user_id',$user->id);
                Session::put('email',$user->email);
                Session::put('first_name',$user->first_name);
                Session::put('last_name',$user->last_name);
            }
    
            return ['status'=>200,'reason'=>'Successfully saved'];
        }
        catch (\Exception $e) {
            DB::rollback();
            return ['status'=>200,'reason'=>$e->getMessage()];
        }
    }


    public function savePoliticianUser(Request $request){
        try {
            DB::beginTransaction();
            
            if($request->email!=''){
                $emailCheck = User::where('email',$request->email)->first();
                if(!empty($emailCheck)){
                    return ['status'=>401,'reason'=>'Duplicate email address'];
                }
            }
            $usernameCheck = User::where('username',$request->username)->first();
            if(!empty($usernameCheck)){
                return ['status'=>401,'reason'=>'Duplicate username'];
            }
            
            $phoneCheck = UserDetail::where('phone',$request->phone)->first();
            if(!empty($phoneCheck)){
                return ['status'=>401,'reason'=>'Duplicate phone number'];
            }
            
            $user = NEW User();
            if($request->role_id==2){
                $user->parent_id = 0;
            }
            else{
                $user->parent_id = $request->leader;
            }            
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->role_id = $request->role_id;
            $user->status = 'Pending';
            $user->created_at = date('Y-m-d h:i:s');
            $user->save();
            
            /*
            * Save user details
            */
            $userDetail = NEW UserDetail();
            $userDetail->user_id = $user->id;
            $userDetail->phone = $request->phone;
            $userDetail->nid = $request->nid;
            $userDetail->address = $request->address;
            $userDetail->division_id = $request->division;
            $userDetail->district_id = $request->district;
            $userDetail->thana_id = $request->thana;
            $userDetail->zip_id = $request->zip;
            $userDetail->save();
            
            DB::commit();
            
            /*
            * Now auto login user
            */
            $result = Auth::attempt(['username' => trim($request->username),
                'password' => $request->password
            ]);
    
            if($result){
                $user = Auth::user();
                Session::put('role_id',$user->role_id);
                Session::put('user_id',$user->id);
                Session::put('email',$user->email);
                Session::put('first_name',$user->first_name);
                Session::put('last_name',$user->last_name);
            }
    
            return ['status'=>200,'reason'=>'Successfully saved'];
        }
        catch (\Exception $e) {
            DB::rollback();
            return ['status'=>200,'reason'=>$e->getMessage()];
        }
    }
    
    public function postLogin(Request $request){
        $result = Auth::attempt(['username' => trim($request->username),
            'password' => $request->password
        ], $request->has('remember'));

        if($result){
            $user = Auth::user();
            Session::put('role_id',$user->role_id);
            Session::put('user_id',$user->id);
            Session::put('username',$user->username);
            Session::put('email',$user->email);
            Session::put('first_name',$user->first_name);
            Session::put('last_name',$user->last_name);
            return redirect('/home');
        }
        else{
            return redirect('login?res=err');
        }
    }

    public function logout(){
        Auth::logout();

        Session::forget('role_id');
        Session::forget('user_id');
        Session::forget('email');
        Session::forget('first_name');
        Session::forget('last_name');

        return redirect('login');
    }

    public function verifyEmail(Request $request){
        $user = User::where('user_id',$request->user_id)->first();
        if($request->mobile_code == $user->mobile_code){
            return ['status'=>200,'reason'=>'Valid code'];
        }
        else{
            return ['status'=>401,'reason'=>'Invalid code'];
        }
        
    }

    public function verifyMobileCode(Request $request){
        $user = User::where('user_id',$request->user_id)->first();
        if($request->mobile_code == $user->mobile_code){
            return ['status'=>200,'reason'=>'Valid code'];
        }
        else{
            return ['status'=>401,'reason'=>'Invalid code'];
        }
        
    }

    public function approveUser(Request $request){
        $user = User::where('user_id',$request->user_id)->first();
        $user->status = 'Active';
        $user->save();
        return ['status'=>200,'reason'=>'User activated successfully'];
    }
}

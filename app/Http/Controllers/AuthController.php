<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\SendMails;
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

    public function resetPassword(Request $request){
        try{
            DB::beginTransaction();
            $user = User::where('email',$request->email)->first();
            if(empty($user)){
                return ['status'=>401,'reason'=>'আমরা এই ইমেল ঠিকানা দিয়ে কোনো ব্যবহারকারী খুঁজে পাই নি'];
            }
            $password = $this->random_string();
            
            $user->password = bcrypt($password);
            $user->save();

            $emailData['email'] = $request->email;
            $emailData['subject'] = "Password recovery";
            $emailData['password'] =$password;
            $view = 'emails.password_recovery_email';
            SendMails::sendMail($emailData, $view);

            DB::commit();

            return ['status'=>200,'reason'=>'নতুন পাসওয়ার্ড তথ্য সহ একটি ইমেল আপনার ইমেল ঠিকানায় পাঠানো হয়েছে।'];
        }
        catch (\Exception $exception){
            DB::rollback();
            return ['status'=>401,'reason'=>$e->getMessage()];
        }
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


    public function saveUser(Request $request){
        try {
            DB::beginTransaction();
            
            if($request->verification_code==''){
                if($request->email!=''){
                    $emailCheck = User::where('email',$request->email)->first();
                    if(!empty($emailCheck)){
                        return ['status'=>401,'reason'=>'ডুপ্লিকেট ইমেইল ঠিকানা'];
                    }
                }
                $usernameCheck = User::where('username',$request->username)->first();
                if(!empty($usernameCheck)){
                    return ['status'=>401,'reason'=>'ডুপ্লিকেট ব্যবহারকারীর নাম'];
                }
                
                $phoneCheck = UserDetail::where('phone',$request->phone)->first();
                if(!empty($phoneCheck)){
                    //return ['status'=>401,'reason'=>'ডুপ্লিকেট ফোন নম্বর'];
                }


                //POST Method example
                $url = "http://66.45.237.70/api.php";
                $number="01749472736";
                $text="Amarneta Code- 5698";
                $data= array(
                'username'=>"01749472736",
                'password'=>"QH3A8EBR",
                'number'=>"$number",
                'message'=>"$text"
                );

                $ch = curl_init(); // Initialize cURL
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $smsresult = curl_exec($ch);
                $p = explode("|",$smsresult);
                $sendstatus = $p[0];


                return ['status'=>200,'reason'=>'Verification code sent','verification_status'=>$sendstatus,'code'=>'5698'];
            }
            else{       
                if($request->verification_code!=$request->system_code){
                    return ['status'=>401,'reason'=>'ভুল যাচাই কোড'];
                }

                $user = NEW User();
                $user->parent_id = 0;         
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->username = $request->username;
                $user->password = bcrypt($request->password);
                $user->party_id = $request->party_id;
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
                    Session::put('username',$user->username);
                    Session::put('email',$user->email);
                    Session::put('first_name',$user->first_name);
                    Session::put('last_name',$user->last_name);
                }
                $this->send_notification(array($user->id), 'অভিনন্দন, '.$user->first_name.'! আপনি সফলভাবে নিবন্ধিত হয়েছেন!');
                return ['status'=>200,'reason'=>'সফলভাবে সংরক্ষিত'];
            }
            
        }
        catch (\Exception $e) {
            DB::rollback();
            return ['status'=>401,'reason'=>$e->getMessage()];
        }
    }
    
    public function postLogin(Request $request){
        $auth = 0;
        $result = Auth::attempt(['username' => trim($request->username),
            'password' => $request->password
        ], $request->has('remember'));

        if($result){
            $auth = 1;
        }
        else{
            $result = Auth::attempt(['email' => trim($request->username),
            'password' => $request->password], $request->has('remember'));
            if($result){
                $auth = 1;
            }
        }

        if($auth==1){
            $user = Auth::user();
            $user_details = DB::table('user_details')->where('user_id', $user->id)->get();
            Session::put('role_id',$user->role_id);
            Session::put('user_id',$user->id);
            Session::put('username',$user->username);
            Session::put('email',$user->email);
            Session::put('first_name',$user->first_name);
            Session::put('last_name',$user->last_name);
            Session::put('image_path',$user_details->first()->image_path);
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
        Session::forget('username');
        Session::forget('email');
        Session::forget('first_name');
        Session::forget('last_name');

        return redirect('login');
    }

    public function verifyEmail(Request $request){
        $user = User::where('user_id',$request->user_id)->first();
        if($request->mobile_code == $user->mobile_code){
            return ['status'=>200,'reason'=>'বৈধ code'];
        }
        else{
            return ['status'=>401,'reason'=>'ভুল কোড'];
        }
        
    }

    public function verifyMobileCode(Request $request){
        $user = User::where('user_id',$request->user_id)->first();
        if($request->mobile_code == $user->mobile_code){
            return ['status'=>200,'reason'=>'বৈধ কোড'];
        }
        else{
            return ['status'=>401,'reason'=>'ভুল কোড'];
        }
        
    }

    public function approveUser(Request $request){
        $user = User::where('user_id',$request->user_id)->first();
        $user->status = 'Active';
        $user->save();
        return ['status'=>200,'reason'=>'ব্যবহারকারী সফলভাবে সক্রিয়!'];
    }

    private function random_string($l = 8) {
        return substr(md5(uniqid(mt_rand(), true)), 0, $l);
    }
}

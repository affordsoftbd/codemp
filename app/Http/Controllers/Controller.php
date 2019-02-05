<?php

namespace App\Http\Controllers;
use Log;
use Storage;
use App\Models\SMS;
use App\Models\User;
use App\Models\UserDetail;
use App\Notifications\UserNotifications;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function uploadImage($image, $path, $resizeX, $resizeY)
    {        
        $ext = explode('.', $image->getClientOriginalName()); 
        $filename = md5(uniqid())."." . $ext[count($ext) -1];
        $image_resize = Image::make($image->getRealPath());          
        $image_resize->resize($resizeX, $resizeY, function ($constraint) {
            $constraint->aspectRatio();                 
        });
        $image_resize->stream(); 
        Storage::disk('local')->put($path.$filename, $image_resize, 'public');
        return 'storage/'.$path.$filename;
    }

    protected function uploadVideo($video, $path)
    {         
        $file = Storage::disk('local')->put($path, $video, 'public');
        return 'storage/'.$file;
    }

    protected function get_followers($user_id=''){
        $followers = array();
        if(!empty($user)){
            $user = $this->user->find($user_id);
            foreach($user->followers as $follower){
                array_push($follower->id, $followers);
            }
        }
        return $followers;
    }

    protected function send_notification($recievers, $text='আপনি একটি নতুন বিজ্ঞপ্তি পেয়েছেন!', $link='javascript:void(0)', $icon='bell'){
        if(is_array($recievers) && count($recievers) > 0){
            foreach($recievers as $reciever){
                $user = User::findOrFail($reciever);
                $user->notify(new UserNotifications(['text' => $text, 'link' => $link, 'icon' => $icon]));
            }
        }
    }

    protected function save_sms_receivers($message, $sender_id, $receiver_id, $content_id, $content_type, $link){  
        $sms = new SMS();
        $check = $sms->where('sender_id', $sender_id)->where('receiver_id', $receiver_id)->where('content_id', $content_id)->where('content_type', $content_type)->first();
        if(!$check){ 
            $sms->message = $message;
            $sms->sender_id = $sender_id;
            $sms->receiver_id = $receiver_id;
            $sms->content_id = $content_id;
            $sms->content_type = $content_type;
            $sms->link = $link;
            $sms->save();
            $recievers = $sms->where('sender_id', $sender_id)->where('content_id', $content_id)->where('content_type', $content_type)->pluck('receiver_id');
            return $recievers;
        }
    }

    public function send_sms($sender_id, $content_id, $content_type){

    /*
        $user = User::find($receiver_id); 
        $userDetail = UserDetail::where('user_id', $receiver_id)->first();
    */

    /*
        $url = "http://66.45.237.70/api.php";
        $number="88017,88018,88019";
        $text="Hello Bangladesh";
        $data= array('username'=>"YourID", 'password'=>"YourPasswd", 'number'=>"$number", 'message'=>"$text")

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|",$smsresult);
        $sendstatus = $p[0];
    */

    /*
        1000 = Invalid user or Password
        1002 = empty Number
        1003 = Invalid message or empty message
        1004 = Number shuld be 13 Digit
        1005 = Invalid number
        1006 = insufficient Balance 
        1009 = Inactive Account
        1010 = Max number limit exceeded
        1101 = Success
    */

    }
}

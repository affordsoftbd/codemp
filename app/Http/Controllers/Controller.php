<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\SMS;
use App\Models\User;
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

    protected function send_sms($message, $sender_id, $reciever_id, $content_id, $content_type){
        $sms = new SMS();
        $sms->message = $message;
        $sms->sender_id = $sender_id;
        $sms->receiver_id = $reciever_id;
        $sms->content_id = $content_id;
        $sms->content_type = $content_type;
        $sms->save();
        return $sms->id;
    }
}

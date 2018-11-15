<?php

namespace App\Http\Controllers;

use Storage;
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
        // $image_resize->resize($resizeX, $resizeY);             
        $image_resize->resize($resizeX, $resizeY, function ($constraint) {
            $constraint->aspectRatio();                 
        });
        $image_resize->stream(); 
        Storage::disk('local')->put($path.$filename, $image_resize, 'public');
        return '/uploads/'.$path.$filename;
    }

    protected function uploadVideo($video, $path)
    {         
        $file = Storage::disk('local')->put($path, $video, 'public');
        return '/uploads/'.$file;
    }

    protected function send_notification($recievers, $text='আপনি একটি নতুন বিজ্ঞপ্তি পেয়েছেন!', $link='javascript:void(0)', $icon='bell'){
        if(is_array($recievers) && count($recievers) > 0){
            foreach($recievers as $reciever){
                $user = User::findOrFail($reciever);
                $user->notify(new UserNotifications(['text' => $text, 'link' => $link, 'icon' => $icon]));
            }
        }
    }
}

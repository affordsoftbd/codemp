<?php

namespace App;
use Illuminate\Support\Facades\Mail;
use App\Common;

/**
 * Class SendMails, this class is to send various types of mails
 *
 * @package App
 */
class SendMails
{
    const FROM_ADDRESS = Common::ADMIN_EMAIL;
    const FROM_NAME = Common::SITE_TITLE;

    public static function sendMail(array $data, $view)
    {
        //try{
            if(isset($data['email'])) {
                $to_email = $data['email'];
            }
            else{
                $to_email = SendMails::FROM_ADDRESS;
            }
            $from_email=SendMails::FROM_ADDRESS;
            $from_name=SendMails::FROM_NAME;
            if(isset($data['from_email'])){
                $from_email = $data['from_email'];
            }
            if(isset($data['from_name'])){
                $from_name = $data['from_name'];
            }
            if(isset($data['subject'])) {
                $subject = $data['subject'];
            }
            else{
                $subject = "Welcome To ".SendMails::FROM_NAME;
            }
            Mail::send($view, $data, function ($message) use ($to_email,$from_email,$from_name,$subject) {
                $message->from($from_email, $from_name);
                $message->to($to_email)->subject($subject);
            });
        /*}catch (\Exception $exception){
            echo $exception->getMessage();
        }*/
    }

    public static function sendErrorMail($message, $view=NULL, $controller, $method, $line_number=NULL, $file_path=NULL, $object=NULL,$type=NULL, $argument=NULL, $email=NULL)
    {
        $data = array(
            'exception_message' => $message,
            'method_name'    	=> $method,
            'line_number'      	=> $line_number,
            'file_path'			=> $file_path,
            'class' 		 	=> $controller,
            'object' 		 	=> $object,
            'type' 		 		=> $type,
            'argument' 		 	=> $argument,
            'email' 		 	=> $email,
            'client' 		 	=> Common::SITE_TITLE,
            'subject' 		 	=> 'Error Notification'
        );
        $view = 'emails.error_exception_email';
        $email = 'muhin.diu092@gmail.com';
        $email = array($email, "shahinkazi1@gmail.com");
        $subject = $data['subject'];
        Mail::send($view, $data, function ($message) use ($email, $subject) {
            $message->from(SendMails::FROM_ADDRESS, SendMails::FROM_NAME);

            $message->to($email)->subject($subject);
        });
    }

}
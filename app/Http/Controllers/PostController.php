<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostLike;
use Auth;
use DB;
use Session;

class PostController extends Controller
{

    public function getPostAjax(Request $request){
        try {
            $user = Auth::user();
            $leader_id= $user->parent_id;
            $post_creators = [$user->id,$leader_id];
            $lastPost = Post::orderBy('post_id','desc')->first();
            $last_id = $request->last_id;

            $posts = Post::select('posts.*','users.first_name','users.last_name','user_details.image_path')
            ->with('images')
            ->with('videos')
            ->with('comments')
            ->with('likes')
            ->join('users','users.id','=','posts.user_id')
            ->join('user_details','users.id','=','user_details.user_id')
            ->whereIn('posts.user_id',$post_creators)
            ->where('post_id','<=',$last_id)
            ->orderBy('post_id','desc')
            ->limit(5)
            ->get();

            return ['status'=>200,'reason'=>'','posts'=>$posts,'last_id'=>$last_id];
        }
        catch (\Exception $e) {
            return ['status'=>401, 'reason'=>$e->getMessage()];
        }
    }

    public function saveTextPost(Request $request){
        try {
            $post = NEW Post();
            $post->user_id = Session::get('user_id');
            $post->description = $request->post_text;
            $post->save();

            return ['status'=>200, 'reason'=>'Your post saved successfully'];
        }
        catch (\Exception $e) {
            return ['status'=>401, 'reason'=>$e->getMessage()];
        }
    }

    public function saveImagePost(Request $request){
        try {
            return $request->all();
            /*for ($i = 0; $i < count($_FILES['attachment']['name']); $i++) {
        $directory = 'all_student_files/'.$this->setFoldername().'/';
        $validextensions = array("pdf", "doc", "docx");  
        $ext = explode('.', basename($_FILES['attachment']['name'][$i]));
        $file_extension = end($ext); 
        $attachment_name = time()."_".md5(uniqid())."_".$this->getFileName()."- ".$i."." . $ext[count($ext) -1];  
        if (($_FILES["attachment"]["size"][$i] < 2000000) && in_array($file_extension, $validextensions)) {
          if (move_uploaded_file($_FILES['attachment']['tmp_name'][$i], $directory. $attachment_name)) {
            $message[] = array('message'=> "<p class='col-green'><i class='fa fa-check-circle'></i> ".$_FILES['attachment']['name'][$i]." has been uploaded successfully!</p>");
          } 
          else {
            $message[] = array('message'=> "<p class='col-red'><i class='fa fa-info-circle'></i> There was something wrong while uploading ".$_FILES['attachment']['name'][$i]."</p>");
          }
        } 
        else {
          $message[] = array('message'=> "<p class='col-warning'><i class='fa fa-question-circle'></i> Invalid file Size or Type Detected for attachment #".$_FILES['attachment']['name'][$i].". Try uploading only Word and PDF files under 500KB</p>");
        }
      }
      return $message;*/
        }
        catch (\Exception $e) {
            return ['status'=>401, 'reason'=>$e->getMessage()];
        }
    }

    public function postDetails(Request $request)
    {
        try {
            if(!Auth::check()){                
                return view('post');
            }
            $data['post'] = Post::select('posts.*','users.first_name','users.last_name','user_details.image_path')
                ->with('images')
                ->with('videos')
                ->with('comments')
                ->with('likes')
                ->join('users','users.id','=','posts.user_id')
                ->join('user_details','users.id','=','user_details.user_id')
                ->where('post_id',$request->id)
                ->first();
            $data['post_comments'] = PostComment::select('post_comments.*','users.first_name','users.last_name','user_details.image_path')
                ->join('users','users.id','=','post_comments.user_id')
                ->join('user_details','users.id','=','user_details.user_id')
                ->where('post_id',$request->id)
                ->get();
            return view('post_detail',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function imageDetails(Request $request)
    {
        try {
            if(!Auth::check()){
                return view('image');
            }
            $data['post'] = Post::select('posts.*','users.first_name','users.last_name','user_details.image_path')
                ->with('images')
                ->with('videos')
                ->with('comments')
                ->with('likes')
                ->join('users','users.id','=','posts.user_id')
                ->join('user_details','users.id','=','user_details.user_id')
                ->where('post_id',$request->id)
                ->first();
            $data['post_comments'] = PostComment::select('post_comments.*','users.first_name','users.last_name','user_details.image_path')
                ->join('users','users.id','=','post_comments.user_id')
                ->join('user_details','users.id','=','user_details.user_id')
                ->where('post_id',$request->id)
                ->get();
            return view('image_detail',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function videoDetails(Request $request)
    {
        try {
            if(!Auth::check()){
                return view('video');
            }
            $data['post'] = Post::select('posts.*','users.first_name','users.last_name','user_details.image_path')
                ->with('images')
                ->with('videos')
                ->with('comments')
                ->with('likes')
                ->join('users','users.id','=','posts.user_id')
                ->join('user_details','users.id','=','user_details.user_id')
                ->where('post_id',$request->id)
                ->first();
            $data['post_comments'] = PostComment::select('post_comments.*','users.first_name','users.last_name','user_details.image_path')
                ->join('users','users.id','=','post_comments.user_id')
                ->join('user_details','users.id','=','user_details.user_id')
                ->where('post_id',$request->id)
                ->get();
            return view('video_detail',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function saveComment(Request $request){
        $comment = NEW PostComment();
        $comment->parent_id = 0;
        $comment->comment = $request->comment_text;
        $comment->post_id = $request->post_id;
        $comment->user_id = Session::get('user_id');
        $comment->save();

        return ['status'=>200,'reason'=>'মন্তব্য সফলভাবে সংরক্ষিত হয়েছে'];
    }

    public function savePostLike(Request $request){
        $oldLike = PostLike::where('post_id',$request->post_id)->where('user_id',Session::get('user_id'))->first();
        if(!empty($oldLike)){
            return ['status'=>200,'reason'=>'Already liked','like'=>0];
        }
        $like = NEW PostLike();
        $like->post_id = $request->post_id;
        $like->user_id = Session::get('user_id');
        $like->save();

        return ['status'=>200,'reason'=>'New like saved'];
    }
}

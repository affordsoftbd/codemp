<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\PostComment;
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

        return ['status'=>200,'reason'=>'Comment saved successfully'];
    }
}

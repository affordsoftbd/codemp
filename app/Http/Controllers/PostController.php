<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
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
            $lastPost = Post::whereIn('posts.user_id',$post_creators)->orderBy('post_id','desc')->first();
            if(!empty($lastPost)){
                $last_id = $lastPost->post_id;
            }
            else{
                $last_id = 0;
            }

            $posts = Post::select('posts.*','users.first_name','users.last_name','user_details.image_path')
            ->with('comments')
            ->with('likes')
            ->join('users','users.id','=','posts.user_id')
            ->join('user_details','users.id','=','user_details.user_id')
            ->whereIn('posts.user_id',$post_creators)
            ->where('post_id','<=',$last_id)
            ->orderBy('post_id','desc')
            ->limit(5)
            ->get();

            return ['status'=>200,'reason'=>'','posts'=>$posts];
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
}

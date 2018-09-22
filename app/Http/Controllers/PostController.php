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
            $posts = Post::where('user_id',$leader_id)->limit(5)->get();

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

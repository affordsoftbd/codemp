<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Auth;
use DB;
use Session;

class CommonController extends Controller
{

    public function getPost(Request $request){
        try {
            $user = Auth::user();
            $leader_id= $user->parent_id;
            $data['posts'] = Post::where('user_id',$leader_id)->limit(5)->get();

            return view('home');
        }
        catch (\Exception $e) {
            return ['status'=>401, 'options'=>$e->getMessage()];
        }
    }

    public function saveTextPost(Request $request){
        try {
            $post = NEW Post();
            $post->user_id = Session::get('user_id');
            $post->text = $request->text;
            $post->save();

            return ['status'=>200, 'options'=>$options];
        }
        catch (\Exception $e) {
            return ['status'=>401, 'options'=>$e->getMessage()];
        }
    }
}

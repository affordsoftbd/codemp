<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if(Auth::check()){
            return redirect('home');
        }
        return view('auth.login');
    }

    public function home()
    {
        try {
            if(!Auth::check()){
                return redirect('login');
            }
            $user = Auth::user();
            $leader_id= $user->parent_id;
            $post_creators = [$user->id,$leader_id];
            $lastPost = Post::whereIn('posts.user_id',$post_creators)->orderBy('post_id','desc')->first();
            if(!empty($lastPost)){
                $data['last_id'] = $lastPost->post_id;
            }
            else{
                $data['last_id'] = 0;
            }
            return view('home',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function profilePosts(Request $request)
    {
        try {
            if(!Auth::check()){
                return redirect('login');
            }
            $data['user'] = User::where('username',$request->username)
                ->join('user_details','user_details.user_id','=','users.id')
                ->first();
            $data['followers'] = User::where('parent_id',$data['user']->id)->where('status','Active')->get();
            if(empty($data['user'])){
                return redirect('error_404');
            }
            return view('profile.posts',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function profileAlbums()
    {
        try {
            if(!Auth::check()){
                return redirect('login');
            }
            return view('profile.albums');
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function profileVideos()
    {
        try {
            if(!Auth::check()){
                return redirect('login');
            }
            return view('profile.videos');
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function editProfile(Request $request)
    {
        try {
            if(!Auth::check()){
                return redirect('login');
            }            
            $data['user'] = User::where('username',$request->username)
                ->join('user_details','user_details.user_id','=','users.id')
                ->first();
            return view('profile.edit',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}

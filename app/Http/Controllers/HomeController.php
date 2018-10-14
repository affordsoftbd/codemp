<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Auth;
use DB;
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
        return view ('auth.landing');
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

    public function news()
    {
        try {
            return view('news.index');
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function newsDetails($headline)
    {
        try {
            return view('news.details');
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

            $lastPost = Post::where('posts.user_id',$data['user']->id)->orderBy('post_id','desc')->first();
            if(!empty($lastPost)){
                $data['last_id'] = $lastPost->post_id;
            }
            else{
                $data['last_id'] = 0;
            }

            return view('profile.posts',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function profileAlbums(Request $request)
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

            $lastPost = Post::where('posts.user_id',$data['user']->id)->where('post_type','photo')->orderBy('post_id','desc')->first();
            if(!empty($lastPost)){
                $data['last_id'] = $lastPost->post_id;
            }
            else{
                $data['last_id'] = 0;
            }

            return view('profile.albums',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function profileVideos(Request $request)
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

            $lastPost = Post::where('posts.user_id',$data['user']->id)->where('post_type','video')->orderBy('post_id','desc')->first();
            if(!empty($lastPost)){
                $data['last_id'] = $lastPost->post_id;
            }
            else{
                $data['last_id'] = 0;
            }
            return view('profile.videos',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function politicians()
    {
        try {
            if(!Auth::check()){
                return redirect('login');
            }            
            return view('politicians');
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

    public function editPoloticanProfile(Request $request)
    {
        try {
            if(!Auth::check()){
                return redirect('login');
            }          

            $data['user'] = User::where('username',$request->username)
                ->join('user_details','user_details.user_id','=','users.id')
                ->first();
            $data['divisions'] = DB::table('divisions')->get();  
            $data['roles'] = DB::table('roles')->where('role_id','!=',1)->get();
            return view('profile.edit_politician',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function editProfilePassword(Request $request)
    {
        try {
            if(!Auth::check()){
                return redirect('login');
            }            
            return view('profile.edit_pass');
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}

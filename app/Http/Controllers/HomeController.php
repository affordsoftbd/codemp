<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Follower;
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
        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['thanas'] = DB::table('thanas')->get();
        $data['zips'] = DB::table('zips')->get();
        $data['parties'] = DB::table('parties')->get();
        $data['roles'] = DB::table('roles')->get();
        return view ('auth.landing',$data);
        // return view ('olds.login');
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
            $data['followers'] = Follower::where('leader_id',$data['user']->id)->get();
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
            $data['followers'] = Follower::where('leader_id',$data['user']->id)->get();
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
            $data['followers'] = Follower::where('leader_id',$data['user']->id)->get();
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


    public function publicProfile(Request $request)
    {
        try {
            if(!Auth::check()){
                return redirect('login');
            }
            $data['user'] = User::where('username',$request->user)
                ->join('user_details','user_details.user_id','=','users.id')
                ->first();
            $data['followers'] = Follower::where('leader_id',$data['user']->id)->get();
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

            return view('public_profile',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function politicians(Request $request)
    {
        try {
            if(!Auth::check()){
                return redirect('login');
            }        
            $data['divisions'] = DB::table('divisions')->get();    
            $data['leaders'] = User::with('followers')->select('users.*','user_details.*','divisions.division_name','districts.district_name','thanas.thana_name','zips.zip_code')
                ->where('role_id',1)
                ->where('status','Active')
                ->join('user_details','user_details.user_id','users.id')
                ->leftJoin('divisions','divisions.division_id','user_details.division_id')
                ->leftJoin('districts','districts.district_id','user_details.district_id')
                ->leftJoin('thanas','thanas.thana_id','user_details.thana_id')
                ->leftJoin('zips','zips.zip_id','user_details.zip_id')
                ->paginate(12);


            $data['leaders'] = User::query();
            $data['leaders'] = $data['leaders']->with('followers');
            $data['leaders'] = $data['leaders']->select('users.*','user_details.*','divisions.division_name','districts.district_name','thanas.thana_name','zips.zip_code');
            $data['leaders'] = $data['leaders']->join('user_details','user_details.user_id','users.id');
            $data['leaders'] = $data['leaders']->leftJoin('divisions','divisions.division_id','user_details.division_id');
            $data['leaders'] = $data['leaders']->leftJoin('districts','districts.district_id','user_details.district_id');
            $data['leaders'] = $data['leaders']->leftJoin('thanas','thanas.thana_id','user_details.thana_id');
            $data['leaders'] = $data['leaders']->leftJoin('zips','zips.zip_id','user_details.zip_id');
            $data['leaders'] = $data['leaders']->where('role_id',1);
            $data['leaders'] = $data['leaders']->where('status','Active');

            if($request->following=='true'){
                $data['leaders'] = $data['leaders']->join('followers','followers.leader_id','users.id');
                $data['leaders'] = $data['leaders']->where('followers.follower_user_id',Session::get('user_id'));
            }

            if($request->keyword){
                $data['leaders'] = $data['leaders']->where('users.first_name','LIKE','%'.$request->keyword.'%');
            }
            if($request->division){
                $data['leaders'] = $data['leaders']->where('user_details.division_id',$request->division);
            }
            if($request->district){
                $data['leaders'] = $data['leaders']->where('user_details.district_id',$request->district);
            }
            if($request->thana){
                $data['leaders'] = $data['leaders']->where('user_details.thana_id',$request->thana);
            }
            if($request->zip){
                $data['leaders'] = $data['leaders']->where('user_details.zip_id',$request->zip);
            }
            $data['leaders'] = $data['leaders']->paginate(12);

            return view('politicians',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function requests()
    {
        return view('requests');
    }

    public function followers()
    {
        return view('followers');
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
            $data['divisions'] = DB::table('divisions')->get();  
            $data['roles'] = DB::table('roles')->where('role_id','!=',1)->get();
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

    public function followLeader(Request $request)
    {
        try {
            $follower = NEW FOLLOWER();
            $follower->leader_id = $request->leader_id;
            $follower->follower_user_id = Session::get('user_id');
            $follower->save();
            return ['status'=>200,'reason'=>'Successfully followed'];
        }
        catch (\Exception $e) {
            //return $e->getMessage();
            return ['status'=>401,'reason'=>'Some error occured'];
        }
    }

    public function unFollowLeader(Request $request)
    {
        try {
            FOLLOWER::where('leader_id',$request->leader_id)->where('follower_user_id',Session::get('user_id'))->delete();
            
            return ['status'=>200,'reason'=>'Successfully unfollowed'];
        }
        catch (\Exception $e) {
            //return $e->getMessage();
            return ['status'=>401,'reason'=>'Some error occured'];
        }
    }
}

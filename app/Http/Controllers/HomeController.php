<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\MyLeader;
use App\Models\Follower;
use App\Models\News;
use App\Models\NewsComment;
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
            $my_leaders = MyLeader::select('leader_id')->where('worker_id',$user->id)->where('status','active')->pluck('leader_id')->toArray();
            $followings = Follower::select('leader_id')->where('follower_user_id',$user->id)->pluck('leader_id')->toArray();
            $post_creators = array_merge($my_leaders,$followings);
            array_push($post_creators,$user->id);
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

    public function news(Request $request)
    {
        try {
            $data['news'] = News::query();

            if($request->start_date){
                $data['news'] = $data['news']->where('created_at','>=',date('Y-m-d',strtotime($request->start_date)));
            }
            if($request->end_date){
                $data['news'] = $data['news']->where('created_at','<=',date('Y-m-d',strtotime($request->end_date)));
            }

            if($request->keyword){
                $data['news'] = $data['news']->where('description','LIKE','%'.$request->keyword.'%');
            }
            $data['news'] = $data['news']->paginate(10);
            return view('news.index',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function newsDetails($id)
    {
        try {
            $data['news'] = News::where('global_news_id',$id)->first();
            $data['news_comments'] = NewsComment::select('global_news_comments.comment','global_news_comments.created_at','users.first_name','users.last_name','user_details.image_path')
                ->where('news_id',$id)
                ->join('users','users.id','=','global_news_comments.user_id')
                ->join('user_details','user_details.user_id','=','users.id')
                ->get();
            return view('news.details',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function saveNewsComment(Request $request){
        $comment = NEW NewsComment();
        $comment->user_id = Session::get('user_id');
        $comment->news_id = $request->news_id;
        $comment->comment = $request->comment_text;
        $comment->save();
        return ['status'=>200,'reason'=>'Comment successfully saved'];
    }

    public function summeries()
    {
        try {
            $data['followers'] = User::with('followers')
                ->join('followers','followers.follower_user_id','users.id')
                ->where('status','Active')
                ->where('followers.leader_id',Session::get('user_id'))
                ->get();

            $data['new_applicants'] = User::where('users.status','Active')
                ->join('my_leaders','my_leaders.worker_id','users.id')
                ->where('my_leaders.status','pending')
                ->where('my_leaders.leader_id',Session::get('user_id'))
                ->get();

            $data['all_applicants'] = User::where('users.status','Active')
                ->join('my_leaders','my_leaders.worker_id','users.id')
                ->where('my_leaders.leader_id',Session::get('user_id'))
                ->get();
            return view('summeries',$data);
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
        $data['applicants'] = User::query();
        $data['applicants'] = $data['applicants']->select('users.*','user_details.*','divisions.division_name','districts.district_name','thanas.thana_name','zips.zip_code','my_leaders.my_leader_id','my_leaders.leader_id','my_leaders.worker_id');
        $data['applicants'] = $data['applicants']->join('user_details','user_details.user_id','users.id');
        $data['applicants'] = $data['applicants']->join('my_leaders','my_leaders.worker_id','users.id');
        $data['applicants'] = $data['applicants']->leftJoin('divisions','divisions.division_id','user_details.division_id');
        $data['applicants'] = $data['applicants']->leftJoin('districts','districts.district_id','user_details.district_id');
        $data['applicants'] = $data['applicants']->leftJoin('thanas','thanas.thana_id','user_details.thana_id');
        $data['applicants'] = $data['applicants']->leftJoin('zips','zips.zip_id','user_details.zip_id');
        $data['applicants'] = $data['applicants']->where('users.status','Active');
        $data['applicants'] = $data['applicants']->where('my_leaders.status','pending');
        $data['applicants'] = $data['applicants']->where('my_leaders.leader_id',Session::get('user_id'));
        //$data['followers'] = $data['followers']->where('followers.follower_user_id','users.id');

        $data['applicants'] = $data['applicants']->paginate(12);
        return view('requests',$data);
    }

    public function newRequestsAjax()
    {
        $data['applicants'] = User::query();
        $data['applicants'] = $data['applicants']->select('users.*','user_details.*','divisions.division_name','districts.district_name','thanas.thana_name','zips.zip_code','my_leaders.my_leader_id','my_leaders.leader_id','my_leaders.worker_id');
        $data['applicants'] = $data['applicants']->join('user_details','user_details.user_id','users.id');
        $data['applicants'] = $data['applicants']->join('my_leaders','my_leaders.worker_id','users.id');
        $data['applicants'] = $data['applicants']->leftJoin('divisions','divisions.division_id','user_details.division_id');
        $data['applicants'] = $data['applicants']->leftJoin('districts','districts.district_id','user_details.district_id');
        $data['applicants'] = $data['applicants']->leftJoin('thanas','thanas.thana_id','user_details.thana_id');
        $data['applicants'] = $data['applicants']->leftJoin('zips','zips.zip_id','user_details.zip_id');
        $data['applicants'] = $data['applicants']->where('users.status','Active');
        $data['applicants'] = $data['applicants']->where('my_leaders.status','pending');
        $data['applicants'] = $data['applicants']->where('my_leaders.leader_id',Session::get('user_id'));
        //$data['followers'] = $data['followers']->where('followers.follower_user_id','users.id');

        $data['applicants'] = $data['applicants']->get();
        return ['status'=>200,'new_request'=>count($data['applicants'])];
    }

    public function saveRequests(Request $request){
        $myLeader = NEW MyLeader();
        $myLeader->leader_id = $request->leader_id;
        $myLeader->worker_id = Session::get('user_id');
        $myLeader->status = 'pending';
        $myLeader->save();
        return ['status'=>200,'reason'=>'আবেদন সফলভাবে পাঠানো হয়েছে'];
    }

    public function cancelRequests(Request $request){
        $myLeader = MyLeader::where('leader_id',$request->leader_id)->where('worker_id',Session::get('user_id'))->delete();
        return ['status'=>200,'reason'=>'আবেদন সফলভাবে বাতিল করা হয়েছে'];
    }

    public function acceptRequests(Request $request){
        $myLeader = MyLeader::where('my_leader_id',$request->request_id)->first();
        $myLeader->status = 'active';
        $myLeader->save();
        return ['status'=>200,'reason'=>'সফলভাবে গৃহীত হয়েছে'];
    }

    public function rejectRequests(Request $request){
        MyLeader::where('my_leader_id',$request->request_id)->delete();
        return ['status'=>200,'reason'=>'সফলভাবে অপসারিত হয়েছে'];
    }

    public function followers(Request $request)
    {
        $data['divisions'] = DB::table('divisions')->get();   

        $data['followers'] = User::query();
        $data['followers'] = $data['followers']->with('followers');
        $data['followers'] = $data['followers']->select('users.*','user_details.*','divisions.division_name','districts.district_name','thanas.thana_name','zips.zip_code','followers.leader_id','followers.follower_user_id');
        $data['followers'] = $data['followers']->join('user_details','user_details.user_id','users.id');
        $data['followers'] = $data['followers']->join('followers','followers.follower_user_id','users.id');
        $data['followers'] = $data['followers']->leftJoin('divisions','divisions.division_id','user_details.division_id');
        $data['followers'] = $data['followers']->leftJoin('districts','districts.district_id','user_details.district_id');
        $data['followers'] = $data['followers']->leftJoin('thanas','thanas.thana_id','user_details.thana_id');
        $data['followers'] = $data['followers']->leftJoin('zips','zips.zip_id','user_details.zip_id');
        $data['followers'] = $data['followers']->where('status','Active');
        $data['followers'] = $data['followers']->where('followers.leader_id',Session::get('user_id'));
        //$data['followers'] = $data['followers']->where('followers.follower_user_id','users.id');

        if($request->keyword){
            $data['followers'] = $data['followers']->where('users.first_name','LIKE','%'.$request->keyword.'%');
        }
        if($request->division){
            $data['followers'] = $data['followers']->where('user_details.division_id',$request->division);
        }
        if($request->district){
            $data['followers'] = $data['followers']->where('user_details.district_id',$request->district);
        }
        if($request->thana){
            $data['followers'] = $data['followers']->where('user_details.thana_id',$request->thana);
        }
        if($request->zip){
            $data['followers'] = $data['followers']->where('user_details.zip_id',$request->zip);
        }
        $data['followers'] = $data['followers']->paginate(12);

        return view('followers',$data);
    }

    public function removeFollowers(Request $request){
        Follower::where('leader_id',Session::get('user_id'))->where('follower_user_id',$request->follower_id)->delete();
        return ['status'=>200,'reason'=>'সফলভাবে অপসারিত হয়েছে'];
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

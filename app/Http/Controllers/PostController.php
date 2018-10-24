<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\PostVideo;
use App\Models\PostComment;
use App\Models\PostLike;
use Auth;
use DB;
use Validator;
use Session;

class PostController extends Controller
{

    public function getPostAjax(Request $request){
        try {
            $user = Auth::user();
            $leader_id= $user->parent_id;
            $post_creators = [$user->id,$leader_id];
            $lastPost = Post::whereIn('posts.user_id',$post_creators)->orderBy('post_id','desc')->first();
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

    public function getUserPostAjax(Request $request){
        try {
            $user = Auth::user();
            $leader_id= $user->parent_id;
            $post_creators = [$user->id,$leader_id];
            $lastPost = Post::where('user_id',$request->id)->orderBy('post_id','desc')->first();
            $last_id = $request->last_id;

            $posts = Post::select('posts.*','users.first_name','users.last_name','user_details.image_path')
            ->with('images')
            ->with('videos')
            ->with('comments')
            ->with('likes')
            ->join('users','users.id','=','posts.user_id')
            ->join('user_details','users.id','=','user_details.user_id')
            ->where('posts.user_id',$request->id)
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
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'images.*' => 'required|file|mimes:jpg,jpeg,png,bmp|max:2000'
            ],[
                'images.*.required' => 'Please upload an image',
                'images.*.mimes' => 'Only jpg,jpeg,png,bmp images are allowed',
                'images.*.max' => 'Sorry! Maximum allowed size for an image is 2MB',
        ]);
        if ($validator->fails()) {
          return response()->json(['response'=>'error', 'message'=>implode(" || ",$validator->messages()->all())]);
        }
        try {
            $post = NEW Post();
            $post->user_id = Session::get('user_id');
            $post->description = $request->description;
            $post->post_type = 'photo';
            $post->save();
            $images = $request->file('images');
            if($request->hasFile('images'))
            {
                $messages = array();
                foreach ($images as $image) {
                    $imageUpload = $this->uploadImage($image, 'posts/images/', 960, 720);
                    $postImage = NEW PostImage();
                    $postImage->image_path = $imageUpload;
                    $postImage->post_id = $post->post_id;
                    $postImage->save();
                    $messages[] = "Image ".count($images)." uploaded as ".$postImage->image_path;
                }
                return json_encode(['response'=>'success', 'message'=>$messages]);
            }
        }
        catch (\Exception $e) {
            return ['status'=>401, 'reason'=>$e->getMessage()];
        }
    }

    public function saveVideoPost(Request $request){
        $validator = Validator::make($request->all(), [
            'video'  => 'mimes:mp4|max:10000',
            'description' => 'required|string'
        ]);
        if ($validator->fails()) {
          return response()->json(['response'=>'error', 'message'=>implode(" || ",$validator->messages()->all())]);
        }
        try {
            $post = NEW Post();
            $post->user_id = Session::get('user_id');
            $post->description = $request->description;
            $post->post_type = 'video';
            $post->save();
            $postVideo = NEW PostVideo();
            $postVideo->video_path = $this->uploadVideo($request->video, 'posts/videos/'); // $request->video->store('storage/uploads','public');
            $postVideo->post_id = $post->post_id;
            $postVideo->save();
            return json_encode(['response'=>'success', 'message'=>'Video shared successfully!']);
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
            $my_like = PostLike::where('post_id',$request->id)->where('user_id',Session::get('user_id'))->first();
            if(!empty($my_like)){
                $data['my_like'] = 1;
            }
            else{
                $data['my_like'] = 0;
            }
            return view('posts.post_detail',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function editPostDetails($id)
    {
        try {
            if(!Auth::check()){                
                return view('post');
            }
            $post = Post::findOrFail($id);
            return view('posts.post_edit', compact('post'));
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function updatePostDetails(Request $request, $id)
    {
        try {
            $input = $request->all();
            $post = Post::findOrFail($id);
            $post->update($input);
            if($post->post_type == 'photo'){
                return redirect()->route('image', $id)->with('success', array('সফল!'=>'অ্যালবাম বিস্তারিত আপডেট করা হয়েছে!'));
            }
            elseif($post->post_type == 'video'){
                return redirect()->route('video', $id)->with('success', array('সফল!'=>'ভিডিও বিবরণ আপডেট করা হয়েছে!'));
            }
            else{
                return redirect()->route('post', $id)->with('success', array('সফল!'=>'পোস্ট আপডেট করা হয়েছে!'));
            }
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
            $my_like = PostLike::where('post_id',$request->id)->where('user_id',Session::get('user_id'))->first();
            if(!empty($my_like)){
                $data['my_like'] = 1;
            }
            else{
                $data['my_like'] = 0;
            }

            return view('posts.image_details',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function addImage(Request $request)
    {
        try {
            $this->validate(request(),[
                'image'  => 'required|image|dimensions:min_width=100,min_height=200|max:2000',
            ]);
            $imageUpload = $this->uploadImage($request->file('image'), 'posts/images/', 960, 720);
            $postImage = NEW PostImage();
            $postImage->image_path = $imageUpload;
            $postImage->post_id = $request->post_id;
            $postImage->save();
            Session::flash('success', array('নতুন ছবি যোগ করা হয়েছে!'=>''));
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteImage($id)
    {
        try {
            $postImage = NEW PostImage();
            $deleteImage = $postImage->findOrFail($id);
            $deleteImage->delete();
            return redirect()->back()->with('success', array('সফল!'=>'ছবি অ্যালবাম থেকে মুছে ফেলা হয়েছে!'));
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
            $my_like = PostLike::where('post_id',$request->id)->where('user_id',Session::get('user_id'))->first();
            if(!empty($my_like)){
                $data['my_like'] = 1;
            }
            else{
                $data['my_like'] = 0;
            }
            
            return view('posts.video_detail',$data);
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
            PostLike::where('post_id',$request->post_id)->where('user_id',Session::get('user_id'))->delete();
            return ['status'=>200,'reason'=>'Already liked','like'=>-1];
        }
        $like = NEW PostLike();
        $like->post_id = $request->post_id;
        $like->user_id = Session::get('user_id');
        $like->save();

        return ['status'=>200,'reason'=>'New like saved','like'=>1];
    }

    public function deletePost($id)
    {
        try {
            $post = NEW Post();
            $deletePost = $post->findOrFail($id);
            $deletePost->delete();
            return redirect()->route('home')->with('success', array('সফল!'=>'পোস্টটি মুছে ফেলা হয়েছে!'));
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}

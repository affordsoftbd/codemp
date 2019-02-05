<?php

namespace App\Http\Controllers;
use DB; use Log;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MessageSubject;
use App\Models\Message;
use App\Models\MessageReceipent;
use App\Models\MessageViewer;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    protected $user;
    protected $message;
    protected $messageSubject;
    protected $messageReceipent;
    protected $messageView;

    public function __construct(Message $message, MessageSubject $messageSubject, MessageReceipent $messageReceipent, MessageViewer $messageView, User $user)
    {
        $this->middleware('check.auth');
        $this->middleware('message.participant')->only('show');
        $this->middleware('message.owner')->only('edit');
        $this->middleware('subject.author')->only('getMessageSubject', 'addReceipent', 'addFollowers');
        $this->message = $message;
        $this->messageSubject = $messageSubject;
        $this->messageReceipent = $messageReceipent;
        $this->messageView = $messageView;
        $this->user = $user;
    }


    private function saveViewer($message_id, $user_id){
        $view = $this->messageView;
        $view->message_id = $message_id;
        $view->viewer = $user_id;
        $view->save();
    }

    public function saveRecordedVideo(Request $request){
        $video_path = $this->uploadVideo($request->file, 'records');
        return json_encode($video_path);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = \Request::get('search');
        $user = $this->user->find(\Request::session()->get('user_id'));
        $messages = $user->participating()->withCount(['messages as latest_message' => function($query) {
                                                $query->select(DB::raw('max(messages.created_at)'));
                                            }])->search($search)->orderByDesc('latest_message')->paginate(15);
        return view('messages.index', compact('user', 'messages', 'search'));
    }

    public function administratedMessages()
    {
        $search = \Request::get('search');
        $user = $this->user->find(\Request::session()->get('user_id'));
        $messages = $user->authored()->withCount(['messages as latest_message' => function($query) {
                                                $query->select(DB::raw('max(messages.created_at)'));
                                            }])->search($search)->orderByDesc('latest_message')->paginate(15);
        return view('messages.index', compact('user', 'messages', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recipient = $this->user->find(\Request::get('recipient'));
        return view ('messages.create', compact('recipient'));
    }

    public function addMessageSubject(Request $request)
    {
        $rules = [
            'subject_text' => 'required|string|max:500',
            'message_text' => 'required|string|max:5000'
        ];

        $customMessages = [
            'required' => ':attribute ফিল্ড টি অত্যাবশ্যক ',
            'max' => ':max এর বেশী শব্দ হতে পারে না',
            'string' => 'ইনপুট শব্দ হতে হবে'
        ];

        $this->validate($request, $rules, $customMessages);

        $messageSubject = $this->messageSubject;
        $messageSubject->subject_text = $request->subject_text;
        $messageSubject->media_path = $request->media_path;
        $messageSubject->author = $request->session()->get('user_id');
        $messageSubject->save();
        $message = $this->message;
        $message->message_subject_id = $messageSubject->id;
        $message->message_text = $request->message_text;
        $message->user_id = $request->session()->get('user_id');
        $message->save();
        $messageReceipent = $this->messageReceipent;
        $messageReceipent->message_subject_id = $messageSubject->id;
        $messageReceipent->user_id = $request->session()->get('user_id');
        $messageReceipent->save();
        if(!empty($request->recipient)){
            $user = $this->user->findOrFail($request->recipient);
            $user->participating()->attach($messageSubject->id);
        }
        $this->saveViewer($message->id, $request->session()->get('user_id'));
        return redirect()->route('messages.show', $messageSubject->id)->with('success', array('সাফল্য'=>'বার্তা যোগ করা হয়েছে!'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $rules = [
            'message_text' => 'required|max:5000'
        ];

        $customMessages = [
            'required' => ':attribute ফিল্ড টি অত্যাবশ্যক ',
            'max' => ':max এর বেশী শব্দ হতে পারে না'
        ];

        $this->validate($request, $rules, $customMessages);

        $input = $request->all();
        $this->message->create($input);
        $this->saveViewer($this->message->orderBy('created_at', 'DESC')->first()->id, $request->session()->get('user_id'));
        return redirect()->route('messages.show', $request->message_subject_id)->with('success', array('সাফল্য'=>'বার্তা যোগ করা হয়েছে!'));
    }

    public function addReceipent($id, $receipent)
    {
        $user = $this->user->findOrFail($receipent);
        $user->participating()->attach($id);
        $conversation = $this->messageSubject->findOrFail($id);  
        $this->save_sms_receivers($conversation->subject_text, Auth::user()->id, $receipent, $id, 'messaging', route('messages.show', $id));
        return redirect()->route('messages.show', $id)->with('success', array('সাফল্য'=>'প্রাপক যোগ করা হয়েছে!'));
    }

    public function addFollowers($id)
    {
        $allReceipents = $this->getReceipents($id);
        $user = $this->user->find(\Request::session()->get('user_id'));
        foreach ($user->followers as $follower) {
            if(!in_array($follower->user->id, $allReceipents)){
                $follower->user->participating()->attach($id);
                $conversation = $this->messageSubject->findOrFail($id); 
                $this->save_sms_receivers($conversation->subject_text, Auth::user()->id, $follower->user->id, $id, 'messaging');
            }
        }
        return redirect()->route('messages.show', $id)->with('success', array('সাফল্য'=>'আপনার অনুসারীদের যোগ করা হয়েছে!'));
    }

    public function addWorkers($id)
    {
        $allReceipents = $this->getReceipents($id);

        $user = $this->user->find(\Request::session()->get('user_id'));
        $workers = $this->user->where('party_id', $user->party_id);
        foreach ($workers as $worker) {
            if(!in_array($worker->id, $allReceipents)){
                $worker->participating()->attach($id);
                $conversation = $this->messageSubject->findOrFail($id); 
                $this->save_sms_receivers($conversation->subject_text, Auth::user()->id, $worker->id, $id, 'messaging');
            }
        }
        return redirect()->route('messages.show', $id)->with('success', array('সাফল্য'=>'সমস্ত কর্মচারীদের যোগ করা হয়েছে!'));
    }

    public function addGroupMembers($id, $group_id)
    {
        $user = $this->user->find(\Request::session()->get('user_id'));
        $allReceipents = $this->getReceipents($id);
        foreach ($user->groups as $group) {
            if($group->group_id == $group_id){
                foreach ($group->members as $member) {
                    if(!in_array($member->user_id, $allReceipents)){
                        $member->user->participating()->attach($id);
                        $conversation = $this->messageSubject->findOrFail($id); 
                        $this->save_sms_receivers($conversation->subject_text, Auth::user()->id, $member->user_id, $id, 'messaging');
                    }
                }
                break;
            }
        }
        return redirect()->route('messages.show', $id)->with('success', array('সাফল্য'=>'আপনার অনুসারীদের যোগ করা হয়েছে!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = $this->user->find(\Request::session()->get('user_id'));
        $conversation = $this->messageSubject->findOrFail($id);
        $messages = $this->message->where('message_subject_id', '=', $id)->orderBy('created_at', 'desc')->paginate(15);
        if($messages->onFirstPage() && $messages->isNotEmpty() && !$messages->first()->viewers->contains('viewer', $request->session()->get('user_id'))){
            $this->saveViewer($messages->first()->id, $request->session()->get('user_id'));
        }
        return view('messages.show', compact('conversation', 'messages', 'user', 'groups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = $this->message->find($id);
        return json_encode($message->message_text);
    }

    public function getMessageSubject($id)
    {
        $user = $this->user->find(\Request::session()->get('user_id'));
        $subject = $this->messageSubject->findOrFail($id);
        return view('messages.edit', compact('subject', 'user'));
    }

    public function newMessages()
    {
        $unreadMessages = array();
        $user = $this->user->find(\Request::session()->get('user_id'));
        foreach($user->participating as $subject){
            $message = $this->message->where('message_subject_id','=', $subject->id)->orderBy('created_at', 'DESC')->first();
            if((isset($message) && count($message->viewers) == 0) || (isset($message) && count($message->viewers) > 0 && !$message->viewers->contains('viewer', $user->id))){
                $unreadMessages[] = array(
                    'user'=>$message->user->first_name.' '.$message->user->last_name, 
                    'image'=> file_exists($message->user->detail->image_path) ? asset($message->user->detail->image_path) : url('/').'/img/avatar.png', 
                    'subject_id'=>$message->message_subject->id, 
                    'message'=>strip_tags(substr($message->message_text,0,20))."...", 
                    'date'=>date('l d F Y, h:i A', strtotime($message->created_at))
                );
            }
        }

        if(count($unreadMessages) > 0){
            $unreadMessages = array_values(array_sort($unreadMessages, function ($value) {
                return $value['date'];
            }));            
        }

        return json_encode(array_reverse($unreadMessages));
    }

    private function getReceipents($id)
    {
        $allParticipants = array();
        $subject = $this->messageSubject->findOrFail($id);
        foreach($subject->receipents as $receipent){ 
            array_push($allParticipants, $receipent->id);
        }
        return $allParticipants;
    }

    public function getUserList(Request $request, $id)
    {

        $usersList = $this->user->whereNotIn('id', $this->getReceipents($id))
                            ->where(function ($query) use ($request) {
                                $query
                                    ->where('username', $request->user)
                                    ->orWhere('email', $request->user)
                                    ->orWhere('first_name', 'LIKE', '%' . $request->user . '%')
                                    ->orWhere('last_name', 'LIKE', '%' . $request->user . '%');
                            })
                            ->take(30)->get();
        if(count($usersList) > 0){
            $list = array();
            foreach($usersList as $user){
                $list[] = array('message_subject_id'=>$id, 'user_id'=>$user->id, 'name'=> $user->first_name.' '.$user->last_name, 'image'=> file_exists($user->detail->image_path) ? asset($user->detail->image_path) : 'http://via.placeholder.com/450');
            }
            return json_encode($list);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'message_text' => 'required|max:5000'
        ];

        $customMessages = [
            'required' => ':attribute ফিল্ড টি অত্যাবশ্যক ',
            'max' => ':max এর বেশী শব্দ হতে পারে না'
        ];
        $this->validate($request, $rules, $customMessages);
        $input = $request->all();
        $message = $this->message->findOrFail($id);
        $message->update($input);
        return json_encode($request->message_text);
    }

    public function updateMessageSubject(Request $request, $id)
    {
        $rules = [
            'subject_text' => 'required|max:500'
        ];

        $customMessages = [
            'required' => ':attribute ফিল্ড টি অত্যাবশ্যক ',
            'max' => ':max এর বেশী শব্দ হতে পারে না'
        ];
        $this->validate($request, $rules, $customMessages);
        $input = $request->all();
        $subject = $this->messageSubject->findOrFail($id);
        $subject->update($input);
        return redirect()->route('messages.show', $id)->with('success', array('সাফল্য'=>'বার্তা বিষয় হালনাগাদ করা হয়েছে!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeReceipent($id, $receipent)
    {
        $user = $this->user->findOrFail($receipent);
        $user->participating()->detach($id);
        if($user->id == Auth::user()->id){
            return redirect()->route('messages.index')->with('success', array('সাফল্য'=>'কথোপকথন অগ্রাহ্য করা হয়েছে!'));
        }
        else{
            return redirect()->route('messages.show', $id)->with('success', array('সাফল্য'=>'প্রাপক অপসারণ করা হয়েছে!')); 
        }
    }

    public function destroy($id)
    {
        $message = $this->message->findOrFail($id);
        $message->delete();
        return redirect()->route('messages.show', $message->message_subject->id)->with('success', array('সাফল্য'=>'বার্তা মুছে ফেলা হয়েছে!'));
    }

    public function deleteMessageSubject($id)
    {
        $messageSubject = $this->messageSubject->findOrFail($id);
        $messageSubject->delete();
        return redirect()->route('messages.index')->with('success', array('সাফল্য'=>'বার্তা মুছে ফেলা হয়েছে!'));
    }
}

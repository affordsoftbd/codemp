<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MessageSubject;
use App\Models\Message;
use App\Models\MessageReceipent;
use App\Models\MessageViewer;

class MessageController extends Controller
{
    protected $user;
    protected $message;
    protected $messageSubject;
    protected $messageReceipent;
    protected $messageView;

    public function __construct(Message $message, MessageSubject $messageSubject, MessageReceipent $messageReceipent, MessageViewer $messageView, User $user)
    {
        $this->middleware('auth');
        $this->message = $message;
        $this->messageSubject = $messageSubject;
        $this->messageReceipent = $messageReceipent;
        $this->messageView = $messageView;
        $this->user = $user;
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
        $subjects = $user->messageSubjects()->withCount(['messages as latest_message' => function($query) {
                                                $query->select(DB::raw('max(messages.created_at)'));
                                            }])->search($search)->orderByDesc('latest_message')->paginate(30);
        return view('messages.index', compact('user', 'subjects', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('messages.create');
    }

    public function addMessageSubject(Request $request)
    {
        $this->validate(request(),[
            'subject_text' => 'required|string|max:1000',
            'message_text' => 'required|string|max:1000'
        ]);
        $messageSubject = $this->messageSubject;
        $messageSubject->subject_text = $request->subject_text;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conversation = $this->messageSubject->findOrFail($id);
        $messages = $this->message->where('message_subject_id', '=', $id)->orderBy('created_at', 'desc')->paginate(15);
        /*if($messages->onFirstPage() && $messages->isNotEmpty() && !$messages->first()->viewers->contains('user_id', Auth::user()->id)){
            $this->saveViewer($messages->first()->id, Auth::user()->id);
        }*/ 
        return view('messages.show', compact('conversation', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

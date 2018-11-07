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


    private function saveViewer($message_id, $user_id){
        $view = $this->messageView;
        $view->message_id = $message_id;
        $view->viewer = $user_id;
        $view->save();
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
                                            }])->search($search)->orderByDesc('latest_message')->paginate(30);
        return view('messages.index', compact('user', 'messages', 'search'));
    }

    public function administratedMessages()
    {
        $search = \Request::get('search');
        $user = $this->user->find(\Request::session()->get('user_id'));
        $messages = $user->authored()->withCount(['messages as latest_message' => function($query) {
                                                $query->select(DB::raw('max(messages.created_at)'));
                                            }])->search($search)->orderByDesc('latest_message')->paginate(30);
        return view('messages.index', compact('user', 'messages', 'search'));
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
        $this->validate(request(),[
            'message_text' => 'required|max:50000'
        ]);
        $input = $request->all();
        $this->message->create($input);
        $this->saveViewer($this->message->orderBy('created_at', 'DESC')->first()->id, $request->session()->get('user_id'));
        return redirect()->route('messages.show', $request->message_subject_id)->with('success', array('সাফল্য'=>'বার্তা যোগ করা হয়েছে!'));
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
        return view('messages.show', compact('conversation', 'messages', 'user'));
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

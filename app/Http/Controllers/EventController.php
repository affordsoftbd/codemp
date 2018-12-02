<?php

namespace App\Http\Controllers;

use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\EventComment;
use Illuminate\Http\Request;

class EventController extends Controller
{
    
    protected $event;
    protected $comment;
    protected $user;

    public function __construct(Event $event, EventComment $comment, User $user)
    {
        /*$this->middleware('auth');
        $this->middleware('order.owner')->only('show', 'edit');*/
        /*for($i=0; $i<=8; $i++){
            $this->send_notification(array($user->id), 'নতুন বিজ্ঞপ্তি পাওয়া গেছে!!', route('messages.index'));
        }*/
        $this->event = $event;
        $this->comment = $comment;
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
        $events = $user->participating_events()->search($search)->orderByDesc('event_date')->paginate(15);
        return view('events.index', compact('search', 'user', 'events'));
    }

    public function organizedEvents()
    {
        $search = \Request::get('search');
        $user = $this->user->find(\Request::session()->get('user_id'));
        $events = $user->events()->search($search)->orderByDesc('event_date')->paginate(15);
        return view('events.index', compact('search', 'user', 'events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $input = $request->all();
        $input['event_date'] = Carbon::parse(str_replace('-', '', $input['event_date']))->format('Y-m-d H:i:s');
        $request->replace($input);
        $rules = [
            'title' => 'required|string|max:500',
            'details' => 'required|string|max:5000',
            'event_date' => 'required|date|after:'.Carbon::now()->addDays(1)->format('l d F Y')
        ];

        $customMessages = [
            'required' => ':attribute ফিল্ড টি অত্যাবশ্যক ',
            'max' => ':max এর বেশী শব্দ হতে পারে না',
            'string' => 'ইনপুট শব্দ হতে হবে',
            'date' => 'ইনপুট তারিখ হতে হবে',
            'after' => 'ইনপুট তারিখ হতে হবে '.Carbon::now()->addDays(1)->format('l d F Y').' এর পরে',
        ];
        $this->validate($request, $rules, $customMessages);
        $id = $this->event->create($input)->id;
        $user = $this->user->find(\Request::session()->get('user_id'));
        $user->participating_events()->attach($id);
        $this->send_notification($this->get_followers(\Request::session()->get('user_id')), $user->first_name.' '.$user->last_name.' একটি নতুন ইভেন্ট যোগ করেছেন!', route('events.show', $id));
        return redirect()->route('events.show', $id)->with('success', array('সাফল্য'=>'ইভেন্ট যোগ করা হয়েছে!'));
    }

    public function addComment(Request $request)
    {  
        $this->validate(request(),[
            'comment' => 'required|string|max:5000'
        ]);
        $input = $request->all();
        $id = $this->comment->create($input);
        $user = $this->user->find(\Request::session()->get('user_id'));
        $this->send_notification($this->event->find($request->event_id)->pluck('user_id')->toArray(), $user->first_name.' '.$user->last_name.' আপনার ইভেন্ট এ একটি মন্তব্য যোগ করেছেন!', route('events.show', $id));
        return redirect()->route('events.show', $request->event_id)->with('success', array('সাফল্য'=>'মন্তব্য যোগ করা হয়েছে!'));
    }

    public function addParticipant(Request $request)
    {  
        $user = $this->user->find($request->user_id);
        $user->participating_events()->attach($request->event_id);
        $this->send_notification(array(\Request::session()->get('user_id')), $user->first_name.' '.$user->last_name.' আপনার ইভেন্ট এ অংশগ্রহণ করেছেন!', route('events.show', $id));
        return redirect()->route('events.show', $request->event_id)->with('success', array('সাফল্য'=>'আপনাকে অংশগ্রহণকারী হিসাবে যোগ করা হয়েছে!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = $this->user->find(\Request::session()->get('user_id'));
        $event = $this->event->findOrFail($id);
        $checkIfParticipated = "no";
        foreach($event->participants as $participant){ 
            if($participant->id == $user->id){
                $checkIfParticipated = "yes";
            }
            break;
        }
        return view('events.show', compact('event', 'user', 'checkIfParticipated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = $this->event->findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function editComment($id)
    {
        $comment = $this->comment->findOrFail($id);
        return json_encode($comment->comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function updateImage(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'event_image'  => 'required|image|dimensions:min_width=100,min_height=200|max:5000',
        ]);
        if ($validator->fails()) {
            Session::flash('error', array('এরর!'=>'দুঃখিত! ছবি আপডেট করা যায়নি! ছবির জন্য সর্বাধিক অনুমোদিত আকার 5 এমবি!'));
        }
        $input = $request->all();
        $event = $this->event->findOrFail($id);
        $event_image = $this->uploadImage($request->file('event_image'), 'events/', 960, 720);
        $event->event_image = $event_image;
        $event->save();
        Session::flash('success', array('সাফল্য'=>'ইভেন্ট ছবি হালনাগাদ করা হয়েছে!'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $input['event_date'] = Carbon::parse(str_replace('-', '', $input['event_date']))->format('Y-m-d H:i:s');
        $request->replace($input);
        $rules = [
            'title' => 'required|string|max:500',
            'details' => 'required|string|max:5000',
            'event_date' => 'required|date|after:'.Carbon::now()->addDays(1)->format('l d F Y')
        ];

        $customMessages = [
            'required' => ':attribute ফিল্ড টি অত্যাবশ্যক ',
            'max' => ':max এর বেশী শব্দ হতে পারে না',
            'string' => 'ইনপুট শব্দ হতে হবে',
            'date' => 'ইনপুট তারিখ হতে হবে',
            'after' => 'ইনপুট তারিখ হতে হবে '.Carbon::now()->addDays(1)->format('l d F Y').' এর পরে',
        ];
        $this->validate($request, $rules, $customMessages);
        $event = $this->event->findOrFail($id);
        $event->update($input);
        $this->send_notification($event->participants->pluck('id')->toArray(), 'ইভেন্ট '.$event->title.' আপডেট করা হয়েছে!', route('events.show', $id));
        return redirect()->route('events.show', $id)->with('success', array('সাফল্য'=>'ইভেন্ট হালনাগাদ করা হয়েছে!'));
    }

    public function updateComment(Request $request, $id)
    {
         $this->validate(request(),[
            'comment' => 'required|string|max:1000'
        ]);
        $input = $request->all();
        $comment = $this->comment->findOrFail($id);
        $comment->update($input);
        return json_encode($request->comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = $this->event->findOrFail($id);
        $event->delete();
        return redirect()->route('events.index')->with('success', array('সাফল্য'=>'ইভেন্ট মুছে ফেলা হয়েছে!'));
    }

    public function deleteComment($id)
    {
        $comment = $this->comment->findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('success', array('সাফল্য'=>'মন্তব্য মুছে ফেলা হয়েছে!'));
    }

    public function removeParticipant($event, $user)
    {
        $user = $this->user->findOrFail($user);
        $user->participating_events()->detach($event);
        return redirect()->back()->with('success', array('সাফল্য'=>'আপনাকে এই ইভেন্ট থেকে মুছে ফেলা হয়েছে!'));
    }
}

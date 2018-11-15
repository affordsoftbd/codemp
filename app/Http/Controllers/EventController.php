<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\EventComment;
use Illuminate\Http\Request;

class EventController extends Controller
{
    
    protected $event;
    protected $user;

    public function __construct(Event $event, User $user)
    {
        /*$this->middleware('auth');
        $this->middleware('order.owner')->only('show', 'edit');*/
        $this->event = $event;
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
        return view('events.index', compact('search'));
    }

    public function organizedEvents()
    {
        $search = \Request::get('search');
        return view('events.index', compact('search'));
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
        if(isset($request->event_date)){
            $request->event_date = Carbon::parse(str_replace('-', '', $request->event_date))->format('Y-m-d H:i:s');
        }    
        $this->validate(request(),[
            'title' => 'required|string|max:500',
            'details' => 'required|string|max:5000',
            'event_date' => 'required|date|after:'.Carbon::now()->addDays(1)->format('l d F Y')
        ]);
        $input = $request->all();
        $this->event->create($input);
        return redirect()->route('events.index')->with('success', array('সাফল্য'=>'অর্ডার যোগ করা হয়েছে!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('events.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('events.edit');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;
use Session;

class GroupController extends Controller
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
        $data['applicants'] = User::select('users.*')
            ->join('my_leaders','my_leaders.worker_id','users.id')
            ->where('users.status','Active')
            ->where('my_leaders.status','active')
            ->where('my_leaders.leader_id',Session::get('user_id'))
            ->get();
        return view('groups.list',$data);
    }
}

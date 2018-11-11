<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupMember;
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
        $data['groups'] = Group::with('members')->where('created_by',Session::get('user_id'))->get();
        $data['applicants'] = User::select('users.*')
            ->join('my_leaders','my_leaders.worker_id','users.id')
            ->where('users.status','Active')
            ->where('my_leaders.status','active')
            ->where('my_leaders.leader_id',Session::get('user_id'))
            ->get();
        return view('groups.list',$data);
    }

    public function saveGroup(Request $request){
        $group = NEW Group();
        $group->group_name = $request->name();
        $group->created_by = Session::get('user_id');
        $group->save();

        $members = $request->member;
        foreach($members as $member){
            $groupMember = NEW GroupMember();
            $groupMember->group_id = $group->group_id;
            $groupMember->user_id = $member;
            $groupMember->member_role = 'general';
            $groupMember->save();
        }

        return ['status'=>200,'reason'=>'group created successfully'];
    }
}

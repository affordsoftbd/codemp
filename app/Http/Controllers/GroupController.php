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

    public function index(Request $request)
    {
        $data['groups'] = Group::Query();
        $data['groups'] = $data['groups']->with('members');
        $data['groups'] = $data['groups']->where('created_by',Session::get('user_id'));
        if($request->keyword !=''){
            $data['groups'] = $data['groups']->where('group_name','LIKE','%'.$request->keyword.'%');
        }
        $data['groups'] = $data['groups']->get();

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
        $group->group_name = $request->group_name;
        $group->created_by = Session::get('user_id');
        $group->save();

        $members = $request->members;
        if(!empty($members)){
            foreach($members as $member){
                $groupMember = NEW GroupMember();
                $groupMember->group_id = $group->group_id;
                $groupMember->user_id = $member;
                $groupMember->member_role = 'general';
                $groupMember->save();
            }
        }
        Session::flash('success', array('সফল!'=>'গ্রুপ সফলভাবে তৈরি হয়েছে!'));
        return ['status'=>200,'reason'=>'সবকিছু ঠিক আছে! পৃষ্ঠা পুনরায় লোড হচ্ছে...'];
    }

    public function editGroup(Request $request){
        $group = Group::where('group_id',$request->group_id)->first();
        $members = GroupMember::select('user_id')->where('group_id',$request->group_id)->pluck('user_id')->toArray();
        return ['status'=>200,'group'=>$group,'members'=>$members];
    }

    public function updateGroup(Request $request){
        $group = Group::where('group_id',$request->group_id)->first();
        $group->group_name = $request->group_name;
        $group->save();

        $members = $request->members;
        GroupMember::where('group_id',$request->group_id)->delete();
        if(!empty($members)){
            foreach($members as $member){
                $groupMember = NEW GroupMember();
                $groupMember->group_id = $group->group_id;
                $groupMember->user_id = $member;
                $groupMember->member_role = 'general';
                $groupMember->save();
            }
        }
        Session::flash('success', array('সফল!'=>'গ্রুপ সফলভাবে হালনাগাদ হয়েছে!'));
        return ['status'=>200,'reason'=>'সবকিছু ঠিক আছে! পৃষ্ঠা পুনরায় লোড হচ্ছে...'];
    }

    public function deleteGroup(Request $request){
        Group::where('group_id',$request->id)->delete();
        GroupMember::where('group_id',$request->id)->delete();
        return redirect('group')->with('success', array('সফল!'=>'গ্রুপ মুছে ফেলা হয়েছে!'));
    }
}

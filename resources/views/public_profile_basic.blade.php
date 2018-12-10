<div class="row">
    <div class="col-md-12">
		<h4 class="font-weight-bold green-text">
			{{ $user->first_name." ".$user->last_name}}
		</h4>
		<small class="red-text">
      @if(!empty($user->division_name))
        <strong>{{ $user->division_name}} > {{ $user->district_name}} > {{ $user->thana_name}} > {{ $user->zip_code}}</strong> অধীনে 
      @endIf
      <strong>@if($user->role_id==2)নেতা@elseসমর্থক@endif</strong> হিসেবে যোগদান করেছেন
    </small>
		<hr>
    </div>
    <div class="col-lg-4 col-md-12">
  		<!-- Card -->
  		<div class="card card-personal profile_card">

  			<!-- Card image-->	
        <img src="{{ file_exists($user->image_path) ? asset($user->image_path) : url('/').'/img/avatar.png' }}" class="card-img-top" alt="Card image cap">		
  			<!-- Card image-->

  			<!-- Card content -->
  			<div class="card-body">
  				<p class="card-meta">
  					<i class="fa fa-calendar-check-o prefix grey-text fa-sm pr-2"></i>
  					অংশগ্রহন {{ date('l d F Y',strtotime($user->joining_date)) }}
  				</p>
  				<p class="card-meta">
  					<i class="fa fa-envelope prefix grey-text fa-sm pr-2"></i>
  					{{ $user->email}}
  				</p>
  				<p class="card-meta">
  					<i class="fa fa-phone prefix grey-text fa-sm pr-2"></i>
  					{{ $user->phone}}
  				</p>
  				<p class="card-meta">
  					<i class="fa fa-address-card prefix grey-text fa-sm pr-2"></i>
  					{{ $user->address}}
  				</p>
  				<hr>
  				<a class="card-meta"><span><i class="fa fa-user-circle fa-sm pr-2"></i>{{ count($followers)}}জন অনুসারী</span></a>
  			</div>
  			<!-- Card content -->

  		</div>
    </div>
    <div class="col-lg-8 col-md-12">

    <!-- Card -->
        <?php 
          $follower = \App\Models\Follower::where('leader_id',$user->id)->where('follower_user_id',Session::get('user_id'))->first();
          $myLeader = \App\Models\MyLeader::where('leader_id',$user->id)->where('worker_id',Session::get('user_id'))->first();
        ?>

        @if(empty($follower))
          <a href="javascript:void(0)" class="btn btn-light-green btn-sm my-3" onclick="follow_leader({{ $user->id }})"><i class="fa fa-check fa-sm pr-2"></i>অনুসরণ</a>
        @else
          <a href="javascript:void(0)" class="btn btn-red btn-sm my-3" onclick="un_follow_leader({{ $user->id }})"><i class="fa fa-close fa-sm pr-2"></i>অনুসরণ বাতিল</a>              
        @endif
          <a href="{{ url('/messages/create/?recipient='.$user->id) }}" class="btn btn-dark-green btn-sm"><i class="fa fa-comments fa-sm pr-2"></i>চ্যাট</a>
    </div>
</div>
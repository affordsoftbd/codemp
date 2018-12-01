<div class="row">
    <div class="col-md-12">
		<h4 class="font-weight-bold green-text">
			{{ $user->first_name." ".$user->last_name}}
		</h4>
		<small class="red-text"><strong>{{ $user->division_name}} > {{ $user->district_name}} > {{ $user->thana_name}} > {{ $user->zip_code}}</strong> অধীনে <strong>নেতা</strong> হিসেবে যোগদান করেছেন</small>
		<hr>
    </div>
    <div class="col-lg-4 col-md-12">
  		<!-- Card -->
  		<div class="card card-personal">

  			<!-- Card image-->			
  			@if($user->image_path!='')
  	            <img class="card-img-top" src="{{ url('/').$user->image_path}}" alt="Card image cap">
  	        @else
  	            <img class="card-img-top"  src="{{ url('/').'/img/avatar.png'}}" alt="Card image cap">
  	        @endif
  			<!-- Card image-->

  			<!-- Card content -->
  			<div class="card-body">
  				<p class="card-meta">
  					<i class="fa fa-calendar-check-o prefix grey-text fa-sm pr-2"></i>
  					অংশগ্রহন {{ date('d F Y',strtotime($user->created_at))}}
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

<!-- Update Image -->
<div class="modal fade" id="updateimage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
        <!--Content-->
        <div class="modal-content image_modal">

            <!--Header-->
            <div class="modal-header">
                <img src="http://via.placeholder.com/200" alt="avatar" class="rounded-circle img-responsive preview_input">
            </div>
            <!--Body-->
            <div class="modal-body text-center mb-1">

                <h5 class="mt-1 mb-2">প্রোফাইল ছবি আপডেট করুন</h5>
                <p class="dark-grey-text">সর্বাধিক অনুমোদিত আকার: 500 কেবি</p>

                {!! Form::open(['class'=>'md-form upload_image', 'method' => 'put', 'route' => ['profile.update.image', Auth::user()->id], 'enctype' => 'multipart/form-data']) !!}

                    <div class="file-field">
                      <div class="btn btn-success btn-sm float-left">
                          <span>নির্বাচন</span>
                          {!! Form::file("image", ['class'=>'input_image']) !!}
                      </div>
                      <div class="file-path-wrapper">
                          {!! Form::text('', null, ['class'=>'file-path validate', 'placeholder'=>'আপনার ফাইল নির্বাচন করুন']) !!}
                      </div>
                    </div>
                    <div class="text-center mt-4">
                      {{ Form::button('চিত্র আপলোড <i class="fa fa-upload ml-1"></i>', ['type' => 'submit', 'class' => 'btn btn-red mt-1 btn-md'] ) }}
                    </div>

                {!! Form::close() !!}

            </div>

        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Update Image -->
<div class="row">
    <div class="col-lg-8 col-md-12">
		<h1>
			{{ $user->first_name." ".$user->last_name}}
		</h1>
		<small class="grey-text"><strong>সিলেট > মোগগ্রারা সদর > সোনারগাঁও উপজেলা</strong> অধীনে <strong>নেতা</strong> হিসেবে যোগদান করেছেন</small>
		<hr>
		<h4><i class="fa fa-share-alt fa-sm pr-2"></i>আপনি কি ভাবছেন?</h4><hr>

<div class="card border message_area border-light mb-5">
    <div class="card-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs md-tabs nav-justified green" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">
                    <i class="fa fa-edit fa-sm pr-2"></i>পোস্ট রচনা করুন
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel2" role="tab">
                    <i class="fa fa-file-image-o fa-sm pr-2"></i>অ্যালবাম / ফটো
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel3" role="tab">
                    <i class="fa fa-file-movie-o fa-sm pr-2"></i>লাইভ ভিডিও
                </a>
            </li>
        </ul>
         <!-- Tab panels -->
         <div class="tab-content">
            <div class="tab-pane fade in show active" id="panel1" role="tabpanel">

                <div class="alert alert-success" id="post_success" style="display:none"></div>
                <div class="alert alert-danger" id="post_danger" style="display:none"></div>
                <form id="text_post_form" class="login-form" method="post" action="">
                    {{ csrf_field() }}

                    <div class="md-form">
                        {!! Form::textarea('additional_details', null, array('class'=>'editor','name'=>'post_text','id'=>'post_text')) !!}
                    </div>
                    <div class="text-center my-4">
                        {!! Form::button('অবস্থা হালনাগাদ করুন', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm pull-right')) !!}
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
            <!--/.Panel 1-->
            <!--Panel 2-->
            <div class="tab-pane fade" id="panel2" role="tabpanel">
                <div id="image_error_message"></div>
                {!! Form::open(['method' => 'post', 'route' => ['image.save'], 'class'=>'md-form upload_image']) !!}
                    <div class="md-form">
                        {!! Form::textarea('description', null, array('class'=>'md-textarea form-control no-resize auto-growth', 'rows'=>'1', 'id'=>'image_description')) !!}
                        {!! Form::label('image_description', 'অ্যালবাম বিশদ') !!}
                    </div>

                    <div class="md-form">
                        <div class="file-field">
                            <div class="btn btn-danger btn-sm float-left">
                            <span>নির্বাচন</span>
                                {!! Form::file("images[]", ['class'=>'input_image', 'multiple'=>'true']) !!}
                            </div>
                            <div class="file-path-wrapper">
                                {!! Form::text('', null, ['class'=>'file-path validate', 'id'=>'selected_images_names', 'placeholder'=>'আপনার ফাইলগুলো নির্বাচন করুন']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        {{ Form::button('চিত্র আপলোড<i class="fa fa-upload fa-sm pl-2"></i>', ['type' => 'submit', 'class' => 'btn btn-danger mt-1 btn-md'] ) }}
                    </div>
                    <div class="clearfix"></div>
                    <div id="image_upload_feedback" class="my-5"></div>
                {!! Form::close() !!}
            </div>
            <!--/.Panel 2-->
            <!--Panel 3-->
            <div class="tab-pane fade" id="panel3" role="tabpanel">
                <div id="video_error_message"></div>
                {!! Form::open(['method' => 'post', 'route' => ['video.save'], 'class'=>'md-form share_video']) !!}
                    <div class="md-form">
                        <div class="file-field">
                            <div class="btn btn-danger btn-sm float-left">
                            <span>নির্বাচন</span>
                                {!! Form::file("video", ['class'=>'input_video']) !!}
                            </div>
                            <div class="file-path-wrapper">
                                {!! Form::text('', null, ['class'=>'file-path validate', 'id'=>'selected_video_name', 'placeholder'=>'আপনার ভিডিওটি নির্বাচন করুন']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="md-form">
                        {!! Form::textarea('description', null, array('class'=>'md-textarea form-control no-resize auto-growth', 'rows'=>'1', 'id'=>'video_description')) !!}
                        {!! Form::label('video_description', 'ভিডিও বিবরণ') !!}
                    </div>
                    <div class="text-center mt-4">
                        {{ Form::button('ভিডিও শেয়ার করুন<i class="fa fa-share fa-sm pl-2"></i>', ['type' => 'submit', 'class' => 'btn btn-danger mt-1 btn-md'] ) }}
                    </div>
                    <div class="clearfix"></div>
                    <div id="video_upload_feedback" class="my-5" align="center"></div>
                {!! Form::close() !!}
            </div>
         </div>
    </div>
</div>
    </div>
        <div class="col-lg-4 col-md-12">
		<!-- Card -->
		<div class="card card-personal">

			<!-- Card image-->			
			@if($user->image_path!='')
	            <img class="card-img-top" src="{{ url('/').'/'.$user->image_path}}" alt="Card image cap">
	        @else
	            <img class="card-img-top"  src="{{ url('/').'/img/avatar.png'}}" alt="Card image cap">
	        @endif
			<!-- Card image-->


		  	<!-- Button -->
		  	<a class="btn-floating btn-action btn-red ml-auto mr-4" data-toggle="modal" data-target="#updateimage" data-toggle="tooltip" data-placement="bottom" title="প্রোফাইল ছবি হালনাগাদ করুন"><i class="fa fa-edit"></i></a>

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
		<!-- Card -->
		@guest
            <div class="btn-group my-5" role="group" aria-label="Basic example">
              <a href="button" class="btn btn-light-green btn-sm"><i class="fa fa-check fa-sm pr-2"></i>অনুসরণ</a>
              <a href="button" class="btn btn-dark-green btn-sm"><i class="fa fa-comments fa-sm pr-2"></i>চ্যাট</a>
            </div>      
        @else 
    		<h5 class="red-text mt-4 font-weight-bold"><i class="fa fa-edit fa-sm pr-2" aria-hidden="true"></i>হালনাগাদ</h5><hr>
    	    <a type="button" href="{{ route('profile.edit', $user->username) }}" class="btn btn-dark-green btn-sm"><i class="fa fa-edit fa-sm pr-2" aria-hidden="true"></i>প্রোফাইল</a>
            <a type="button" href="{{ route('profile.edit.password', $user->username) }}" class="btn btn-dark-green btn-sm"><i class="fa fa-edit fa-sm pr-2" aria-hidden="true"></i>পাসওয়ার্ড</a>
    	    <a type="button" href="{{ route('profile.edit.politican', $user->username) }}" class="btn btn-dark-green btn-sm"><i class="fa fa-edit fa-sm pr-2" aria-hidden="true"></i>রাজনীতিবিদ্ তথ্য</a>
    		<a type="button" href="javascript:void(0)" class="btn btn-dark-green btn-sm"><i class="fa fa-bank fa-sm pr-2" aria-hidden="true"></i>অর্থাদি</a>
        @endguest
    </div>
</div>

<!-- Update Image -->
<div class="modal fade" id="updateimage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
        <!--Content-->
        <div class="modal-content profile_image_modal">

            <!--Header-->
            <div class="modal-header">
                <img src="http://via.placeholder.com/200" alt="avatar" class="rounded-circle img-responsive preview_profile_input">
            </div>
            <!--Body-->
            <div class="modal-body text-center mb-1">

                <h5 class="mt-1 mb-2">প্রোফাইল ছবি আপডেট করুন</h5>
                <p class="dark-grey-text">সর্বাধিক অনুমোদিত আকার: 500 কেবি</p>

                {!! Form::open(['class'=>'md-form upload_profile_image', 'method' => 'put', 'route' => ['profile.update.image', Auth::user()->id], 'enctype' => 'multipart/form-data']) !!}

                    <div class="file-field">
                      <div class="btn btn-success btn-sm float-left">
                          <span>নির্বাচন</span>
                          {!! Form::file("profile_image", ['class'=>'input_profile_image']) !!}
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
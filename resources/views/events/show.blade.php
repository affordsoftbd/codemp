@extends('layouts.master')

@section('title', "ইভেন্টস প্রদর্শন ||")

@section('content')

<div class="row">
	<div class="col-xl-1 col-lg-2 col-md-2 post_creator">
        <img src="{{ !empty($event->organizer->detail->image_path) ? $event->organizer->detail->image_path : 'http://via.placeholder.com/450' }}" class="img-fluid rounded-circle z-depth-1-half image-thumbnail my-3">		        
    </div>
    <div class="col-xl-6 col-lg-4 col-md-4">
        <h4 class="font-weight-bold green-text">{{ $event->organizer->first_name.' '.$event->organizer->last_name }}</h4>
        <small class="red-text">{{ $event->created_at->format('l d F Y, h:i A') }}</small>
    </div>
    <div class="col-xl-5 col-lg-6 col-md-6" align="right">
        @if($event->user_id == $user->id)
	        {!! Form::open(['route' => ['events.destroy', $event->id], 'method'=>'delete']) !!}
	            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-light-green btn-sm">
	                <i class="fa fa-edit"></i>
	            </a>
	            @if((strtotime($event->created_at) + 3600) > time())
	            	{!! Form::button('<i class="fa fa-trash"" aria-hidden="true"></i>', array('class' => 'btn btn-deep-orange btn-sm form_warning_sweet_alert', 'title'=>'আপনি কি নিশ্চিত?', 'text'=>'এই ইভেন্টটি আর উদ্ধার করা যাবে না!', 'confirmButtonText'=>'হ্যাঁ, ইভেন্টটি মুছে দিন!', 'type'=>'submit')) !!}
	            @endIf
	        {!! Form::close() !!}
	    @elseIf($event->user_id != $user->id)
	    	{!! Form::open(['method'=>'delete']) !!}
	            {!! Form::button('<i class="fa fa-exclamation-triangle fa-sm pr-2" aria-hidden="true"></i>ইভেন্ট অনুসরণ করুন', array('class' => 'btn btn-deep-orange btn-sm form_warning_sweet_alert', 'title'=>'আপনি কি নিশ্চিত?', 'text'=>'আপনি আর এই কথোপকথন দেখতে পারবেন না!', 'confirmButtonText'=>'হ্যাঁ, আমাকে সরান!', 'type'=>'submit')) !!}
	        {!! Form::close() !!}   
		@endIf
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12">
        <hr>
        <h3>{{ $event->title }}</h3>
		<h6 class="font-weight-bold mt-3"><i class="fa fa-calendar-check-o fa-sm pr-2"></i>{{ date('l d F Y, h:i A', strtotime($event->event_date)) }}</h6>
        <a href="{{ $event->event_image }}" target="_blank"> 
            <img class="img-fluid my-3" src="{{ !empty($event->event_image) ? url('/').$event->event_image : 'http://via.placeholder.com/1000x500?text=Event+Image' }}" alt="{{ $event->title }}">
        </a>
        @if($event->user_id == $user->id)
	        <button type="button" class="btn red btn-sm mb-5" data-toggle="modal" data-target="#updateimage">
	          <i class="fa fa-upload fa-sm pr-2"" aria-hidden="true"></i>একটি নতুন ইমেজ আপলোড করুন
	        </button>
	    @endIf
        {!! $event->details !!}
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12">
        <hr>
        <h5 class="grey-text font-weight-bold" id="total_comments">মোট মন্তব্য: {{ count($event->comments) }}</h5>
    </div>

    @foreach($event->comments as $comment)
	    <div class="col-xl-1 col-lg-2 col-md-2 my-3 post_creator">
	        <img src="{{ !empty($comment->user->detail->image_path) ? url('/').$comment->user->detail->image_path : 'http://via.placeholder.com/50' }}" class="rounded-circle z-depth-1-half image-thumbnail my-3">
	    </div>
	    <div class="col-xl-11 col-lg-10 col-md-10 my-3">
	        <div class="card border message_area border-light">
	            <div class="card-body">
	                <h6 class="font-weight-bold">{{ $comment->user->first_name." ".$comment->user->last_name}}</h6>
	                <small class="grey-text">{{ $comment->created_at->format('l d F Y, h:i A') }}</small>
	                <hr>
	                {!! $comment->comment !!}
	            </div>
	        </div>
	    </div>
    @endforeach
    
    <div class="col-xl-12 col-lg-12 col-md-12 mt-5 text-center">
        <h6 class="font-weight-bold red-text">আপনার মন্তব্য পোস্ট করুন</h6>
    </div>
    <div class="col-xl-1 col-lg-2 col-md-2">
        <img src="{{  !empty($user->detail->image_path) ? url('/').$user->detail->image_path : 'http://via.placeholder.com/50' }}" class="img-fluid rounded-circle z-depth-1 image-thumbnail my-3">
    </div>
    <div class="col-xl-11 col-lg-10 col-md-10">
        <div class="alert alert-success" id="comment_success" style="display:none"></div>
        <div class="alert alert-danger" id="comment_error" style="display:none"></div>
        <form id="comment_form" class="login-form" method="post" action="">
            <input type="hidden" name="_token" value="1erMKU6lQeayxoETWQqTP8cojlDPThBmh5iXY7Uu">  
            <input type="hidden" name="post_id" value="29">
            <div class="md-form">
                <textarea class="editor" name="comment_text" id="comment_text" cols="50" rows="10"></textarea>
            </div>
            <div class="text-center my-4">
                <button type="submit" class="btn btn-danger btn-sm">পোস্ট</button>
            </div>
        </form>
        <div class="clearfix"></div>
    </div>

</div>

<!-- Image Modal -->
<div class="modal fade" id="updateimage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ইমেজ আপলোড করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body image_modal">
				<div class="text-center">
					<img src="http://placehold.it/200" class="img-fluid z-depth-1 preview_input" alt="Responsive image">
					<p class="text-center mt-4">সর্বাধিক অনুমোদিত আকার:: 2 MB</p>
				</div>
                {!! Form::open(['class'=>'md-form upload_image', 'method' => 'put', 'route' => ['event.image.update', $event->id], 'enctype' => 'multipart/form-data']) !!}
					<div class="file-field">
					  <div class="btn btn-success btn-sm float-left">
					      <span>নির্বাচন</span>
					      {!! Form::file("event_image", ['class'=>'input_image']) !!}
					  </div>
					  <div class="file-path-wrapper">
					      {!! Form::text('', null, ['class'=>'file-path validate', 'placeholder'=>'আপনার চিত্র নির্বাচন করুন']) !!}
					  </div>
					</div>
					<div class="text-center mt-4">
					  {{ Form::button('আপলোড <i class="fa fa-upload ml-1"></i>', ['type' => 'submit', 'class' => 'btn btn-danger mt-1 btn-md'] ) }}
					</div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- Image Modal -->

@endsection
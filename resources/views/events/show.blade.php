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
            @if($checkIfParticipated == "yes")
                {!! Form::open(['route' => ['events.participant.remove', $event->id, $user->id], 'method'=>'delete']) !!}
                    {!! Form::button('<i class="fa fa-exclamation-triangle fa-sm pr-2" aria-hidden="true"></i>ইভেন্ট থেকে সরে যান', array('class' => 'btn btn-deep-orange btn-sm form_warning_sweet_alert', 'title'=>'আপনি কি নিশ্চিত?', 'text'=>'আপনি আর এই ইভেন্ট এর আপডেট পাবেন না!', 'confirmButtonText'=>'হ্যাঁ, আমাকে সরান!', 'type'=>'submit')) !!}
                {!! Form::close() !!}
            @else
                {!! Form::open(['route' => ['events.participant.add'], 'method'=>'post']) !!}
                    {!! Form::hidden('event_id', $event->id) !!}
                    {!! Form::hidden('user_id', $user->id) !!}
                    {!! Form::button('<i class="fa fa-check fa-sm pr-2" aria-hidden="true"></i>ইভেন্ট অনুসরণ করুন', array('class' => 'btn btn-green btn-sm', 'type'=>'submit')) !!}
                {!! Form::close() !!}
            @endIf
		@endIf
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12">
        <hr>
        <h3>{{ $event->title }}</h3>
		<h6 class="font-weight-bold mt-3"><i class="fa fa-calendar-check-o fa-sm pr-2"></i>{{ date('l d F Y, h:i A', strtotime($event->event_date)) }}</h6>
        <p class="grey-text font-weight-bold mt-3"><i class="fa fa-users fa-sm pr-2"></i>মোট অংশগ্রহণকারী: {{ count($event->participants) }}</p>
        
        <div id="aniimated-thumbnials" align="center">
            <a href="{{ $event->event_image }}">
                <img class="img-fluid mb-3" src="{{ !empty($event->event_image) ? url('/').$event->event_image : 'http://via.placeholder.com/1000x500?text=Event+Image' }}" alt="{{ $event->title }}">
            </a>
            @if($event->user_id == $user->id)
            <button type="button" class="btn green btn-sm mb-4 center-block" data-toggle="modal" data-target="#updateimage">
              <i class="fa fa-upload fa-sm pr-2"" aria-hidden="true"></i>একটি নতুন ইমেজ আপলোড করুন
            </button>
            @endIf
        </div>
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
	                <div class="event_comment_area" data-url-edit="{{ route('events.comment.edit', $comment->id) }}" data-url-update="{{ route('events.comment.update', $comment->id) }}">
                        {!! $comment->comment !!}
                    </div>
                    @if($comment->user_id == $user->id && (strtotime($comment->created_at) + 3600) > time())
                        <div class="clearfix"></div>
                        <div class="event_options">
                            {!! Form::open(['method' => 'delete', 'route' => ['events.comment.delete', $comment->id]]) !!}
                                <div class="btn-group mb-3 mx-3 pull-right" role="group" aria-label="Basic example">
                                  <button type="button" class="btn btn-light-green btn-sm btn-rounded edit_comment_button"><i class="fa fa-edit"" aria-hidden="true"></i></button>
                                  {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('class' => 'btn btn-deep-orange btn-sm btn-rounded form_warning_sweet_alert', 'title'=>'আপনি কি নিশ্চিত?', 'text'=>'আপনার মন্তব্য হারিয়ে যাবে!', 'confirmButtonText'=>'হ্যাঁ, মন্তব্য মুছে দিন!', 'type'=>'submit')) !!}
                                </div>
                            {!! Form::close() !!} 
                        </div>
                    @endIf
	            </div>
	        </div>
	    </div>
    @endforeach
    
    <div class="col-xl-12 col-lg-12 col-md-12 mt-5 text-center add_comment">
        <h6 class="font-weight-bold red-text">আপনার মন্তব্য যোগ করুন</h6>
    </div>
    <div class="col-xl-1 col-lg-2 col-md-2 add_comment">
        <img src="{{  !empty($user->detail->image_path) ? url('/').$user->detail->image_path : 'http://via.placeholder.com/50' }}" class="img-fluid rounded-circle z-depth-1 image-thumbnail my-3">
    </div>
    <div class="col-xl-11 col-lg-10 col-md-10 add_comment">
        {!! Form::open(['method' => 'post', 'route' => ['events.comment.add'], 'class'=>'md-form', 'name' => 'check_edit']) !!}
            
            {!! Form::hidden('event_id', $event->id) !!}
            {!! Form::hidden('user_id', $user->id) !!}

            <div class="md-form">
        		{!! Form::textarea('comment', null, array('class'=>'editor')) !!}
		    </div>
		    @if ($errors->has('comment'))
		        <p class="red-text">{{ $errors->first('comment') }}</p>
		    @endif
            <div class="text-center my-4">
            	{!! Form::button('<i class="fa fa-plus pr-2"></i>পোস্ট', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
            </div>
		{!! Form::close() !!}
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
					      {!! Form::file("event_image", ['class'=>'input_image', 'accept'=>'image/*']) !!}
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

@section('extra-script')

<script type="text/javascript">

$(document).ready(function(){

    $(document).on('click', '.edit_comment_button', function(){
        var url = $(this).closest('div.card-body').find('.event_comment_area').data("url-edit");
        var div = $(this).closest('div.card-body').find('.event_comment_area');
        var html = '';
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
          }
        });
        $.ajax({
          url: url,
          type: 'GET',
          dataType: 'JSON',
          beforeSend: function(){
            div.html("<center><h1><i class='fa fa-spinner fa-spin my-5'></i></h1></center>");
          },
          success:function(response){
            div.hide().html('<textarea class="editor" name="comment">'+response+'</textarea><button class="btn btn-sm btn-danger my-3 save_comment"><i class="fa fa-check pr-2"></i>হালনাগাদ</button>').fadeIn('slow');
            setTinyMce();
            $(".event_options").hide();
            $(".add_comment").hide();
          }
        });
    });

    $(document).on('click', '.save_comment', function(){
        var url = $(this).closest('div.card-body').find('.event_comment_area').data("url-update");
        var div = $(this).closest('div.card-body').find('.event_comment_area');
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
          }
        });
        $.ajax({
          url: url,
          type: 'PUT',
          data: {
            'comment': tinyMCE.activeEditor.getContent()
          },
          dataType: 'JSON',
          beforeSend: function(){
            div.html("<center><h1><i class='fa fa-spinner fa-spin my-5'></i></h1></center>");
          },
          success:function(response){
            div.html(response);
            $(".event_options").show();
            $(".add_comment").show();
            showNotification("সাফল্য!", "মন্তব্য হালনাগাদ করা হয়েছে!", "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp'); 
          },
          error: function(response){
            div.hide().html('<textarea class="editor" name="comment">'+tinyMCE.activeEditor.getContent()+'</textarea><button class="btn btn-sm btn-danger save_comment"><i class="fa fa-check pr-2"></i>হালনাগাদ</button>').fadeIn('slow');
            setTinyMce();
            showNotification("আপডেট করার সময় ত্রুটি!", "আপনার মন্তব্য আপডেট করা যাবে না! আপনার মন্তব্য খালি না তা নিশ্চিত করুন!", "#", "danger", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp'); 
          }
        });
    });

});

</script>

@endsection
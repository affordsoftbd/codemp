@extends('layouts.master')

@section('title', "নতুন বার্তা ||")

@section('extra-css')
<style type="text/css">
.jquery_dropdown_result {
  position: absolute;
  z-index: 1050;
  max-height: 50vh; 
  overflow: auto;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.1);
}
</style>
@endsection

@section('content')

<!-- Grid row -->
<div class="row">

    <!-- Messages -->
    <div class="col-lg-8 mb-4">
		<div class="row">
		    <div class="col-xl-1 col-lg-2 col-md-2 post_creator">
		        <img src="{{ !empty($conversation->subjectAuthor->detail->image_path) ? $conversation->subjectAuthor->detail->image_path : 'http://via.placeholder.com/450' }}" class="img-fluid rounded-circle z-depth-1-half image-thumbnail my-3">		        
		    </div>
		    <div class="col-xl-6 col-lg-4 col-md-4">
		        <h4>{{ $conversation->subject_text }}</h4>
				<small class="red-text">{{ $conversation->created_at->format('l d F Y, h:i A') }}</small>
		    </div>
		    <div class="col-xl-5 col-lg-6 col-md-6" align="right">
                <a class="btn btn-green btn-sm" href="{{ route('messages.show', $conversation->id) }}">
                	<i class="fa fa-refresh fa-sm pr-2"" aria-hidden="true"></i>বার্তা রিফ্রেশ করুন
                </a>
		        @if($conversation->author == $user->id && (strtotime($conversation->created_at) + 3600) > time())
			        {!! Form::open(['route' => ['messages.subject.delete', $conversation->id], 'method'=>'delete']) !!}
			            <a href="{{ route('messages.subject.edit', $conversation->id) }}" class="btn btn-light-green btn-sm">
			                <i class="fa fa-edit"></i>
			            </a>
			            {!! Form::button('<i class="fa fa-trash"" aria-hidden="true"></i>', array('class' => 'btn btn-deep-orange btn-sm form_warning_sweet_alert', 'title'=>'আপনি কি নিশ্চিত?', 'text'=>'এই পোস্টটি আর উদ্ধার করা যাবে না!', 'confirmButtonText'=>'হ্যাঁ, পোস্টটি মুছে দিন!', 'type'=>'submit')) !!}
			        {!! Form::close() !!}
			    @elseIf($conversation->author != $user->id)
			    	{!! Form::open(['method'=>'delete']) !!}
			            {!! Form::button('<i class="fa fa-exclamation-triangle fa-sm pr-2" aria-hidden="true"></i>কথোপকথন অগ্রাহ্য করুন', array('class' => 'btn btn-deep-orange btn-sm form_warning_sweet_alert', 'title'=>'আপনি কি নিশ্চিত?', 'text'=>'আপনি আর এই কথোপকথন দেখতে পারবেন না!', 'confirmButtonText'=>'হ্যাঁ, আমাকে সরান!', 'type'=>'submit')) !!}
			        {!! Form::close() !!}   
        		@endIf
		    </div>
		</div>
        <hr>
        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination pg-blue justify-content-end">
				<ul class="pagination pg-blue">
				  {{ $messages->links() }}                 
				</ul>
            </ul>
        </nav>
        @foreach($messages->reverse() as $message)
			<!-- Card -->
			<div class="card news-card {{ $message->user->id == $user->id ? 'border-success'  : 'border-danger' }} mb-5">
				<!-- Heading-->
				<div class="card-body">
				  <div class="content">
				    <div class="right-side-meta">{{ $message->created_at }}</div>
				    <img src="{{ !empty($message->user->detail->image_path) ? $message->user->detail->image_path : 'http://via.placeholder.com/450' }}" class="rounded-circle avatar-img z-depth-1-half">{{ $message->user->first_name }}
				  </div>
				</div>
				<!-- Card content -->
				<div class="card-body">
				  <!-- Social meta-->
				  <div class="social-meta">
				    <div class="message-div" data-message-id="{{ $message->id }}" data-url-edit="{{ route('messages.edit', $message->id) }}" data-url-update="{{ route('messages.update', $message->id) }}">
				    	{!! $message->message_text !!}
					</div>
					@if($message->user->id == $user->id && (strtotime($message->created_at) + 3600) > time())
				    <div class="clearfix"></div>
				    <div class="message_options">
						{!! Form::open(['method' => 'delete', 'route' => ['messages.destroy', $message->id]]) !!}
							<div class="btn-group mb-3 mx-3 pull-right" role="group" aria-label="Basic example">
							  <button type="button" class="btn btn-light-green btn-sm btn-rounded edit_message_button"><i class="fa fa-edit"" aria-hidden="true"></i></button>
							  {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('class' => 'btn btn-deep-orange btn-sm btn-rounded form_warning_sweet_alert', 'title'=>'আপনি কি নিশ্চিত?', 'text'=>'আপনার বার্তা হারিয়ে যাবে!', 'confirmButtonText'=>'হ্যাঁ, বার্তা মুছে দিন!', 'type'=>'submit')) !!}
							</div>
						{!! Form::close() !!} 
	                </div>
	                @endIf
				  </div>
				</div>
				<!-- Card content -->
			</div>
			<!-- Card -->
        @endforeach
        @if($messages->onFirstPage() && $messages->isNotEmpty() && $messages->first()->viewers->isNotEmpty())
			<div class="col-lg-12">
				<small class="pull-right mb-3">
				  <a data-toggle="modal" data-target="#viewers_modal">
				    &#10004; Viewed by
				    @foreach($messages->first()->viewers as $viewer)
				      {{ $viewer->user->first_name }}, 
				      @if($loop->iteration == 2) @php break; @endphp @endif
				    @endforeach 
				    {{ count($messages->first()->viewers) > 2 ? 'and '.(count($messages->first()->viewers) - 2).' others' : '' }}
				  </a>
				</small>
			</div>
        @endif
        @if($messages->isEmpty() || $messages->onFirstPage() && $messages->isNotEmpty() && $messages->first()->user->id != $user->id)
	        <div class="add_message">
		        {!! Form::open(['method' => 'post', 'route' => ['messages.store']]) !!}
			        {!! Form::hidden('user_id', $user->id) !!}
			        {!! Form::hidden('message_subject_id', $conversation->id) !!}
			        <p class="font-weight-bold my-3">বার্তা যুক্ত করুন</p>
			        @if ($errors->has('message_text'))
			          <p class="red-text">{{ $errors->first('message_text') }}</p>
			        @endIf
			        <!-- Material Editor -->
			        <div class="md-form">
			          {!! Form::textarea('message_text', null, array('class'=>'editor')) !!}
			        </div>
			        <div class="text-center my-4">
			        	{!! Form::button('<i class="fa fa-plus pr-2"></i>যোগ করুন', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
			        </div>
			    {!! Form::close() !!} 
		    </div> 
        @endIf
    </div>

    <!-- Participants -->
    <div class="col-lg-4 mb-4">
        <h5>অংশগ্রাহীরা</h5>
        <small class="red-text">মোট {{ count($conversation->receipents) }}</small>
        <hr>
        <div class="md-form">
            <i class="fa fa-plus prefix grey-text"></i>
            <input type="text" class="form-control" id="add_participant" data-url="{{ route('messages.user.list', $conversation->id) }}">
            <label for="add_participant">আরো প্রাপক যোগ করুন</label>
        </div>
        <div class="list-group jquery_dropdown_result" data-base = "{{ url('/') }}"></div>
        <a class="btn btn-sm btn-dark-green my-3" href="{{ route('messages.add.followers', $conversation->id) }}"><i class="fa fa-check pr-2"></i>আপনার সমস্ত অনুসরণকারীদের যোগ করুন</a>
        @foreach($conversation->receipents as $receipent)
	        @if($conversation->author == $user->id && $receipent->id != $conversation->author)
		        <div class="row mt-3">
		        	<div class="col-8">
				        <div class="chip mt-2">
				          <img src="{{ !empty($receipent->detail->image_path) ? $receipent->detail->image_path : 'http://via.placeholder.com/450' }}" alt="{{ $receipent->first_name.' '.$receipent->last_name }}"> {{ $receipent->first_name.' '.$receipent->last_name }}
				        </div>
		        	</div>
		        	<div class="col-4">
			        	{!! Form::open(['route' => ['messages.receipent.remove', $conversation->id, $receipent->id], 'method'=>'delete']) !!}
				            {!! Form::button('<i class="fa fa-trash fa-sm" aria-hidden="true"></i>', array('class' => 'btn btn-sm btn-danger form_warning_sweet_alert', 'title'=>'আপনি কি নিশ্চিত?', 'text'=>'এই প্রাপক মুছে ফেলা হবে!', 'confirmButtonText'=>'হ্যাঁ, আমি নিশ্চিত!', 'type'=>'submit')) !!}
				        {!! Form::close() !!}  
		        	</div>
		        </div>
		    @else
		        <div class="chip mt-3">
		        	<img src="{{ !empty($receipent->detail->image_path) ? $receipent->detail->image_path : 'http://via.placeholder.com/450' }}" alt="{{ $receipent->first_name.' '.$receipent->last_name }}"> {{ $receipent->first_name.' '.$receipent->last_name }}
		        </div>
        	@endIf
        @endforeach
    </div>

</div>

@if($messages->isNotEmpty())
    <!-- Viewers Modal -->
    <div class="modal fade" id="viewers_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title w-100" id="viewDetailsTitle">Message viewed by...</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <ul class="list-group">
                <ul class="list-group list-group-flush">
                @foreach($messages->first()->viewers as $viewer)
					<li class="list-group-item">
						<div class="chip">
						  <img src="{{ !empty($viewer->user->detail->image_path) ? url('/').$viewer->user->detail->image_path : 'http://via.placeholder.com/450' }}" alt="{{ $viewer->user->first_name.' '.$viewer->user->last_name }}"> 
						  {{ $viewer->user->first_name.' '.$viewer->user->last_name }}
						</div>
						<small class="grey-text pull-right">{{ $viewer->created_at->format('l d F Y, h:i A') }}</small>
					</li>
                @endforeach
                </ul>
            </ul>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Viewers Modal -->
@endif 

@endsection

@section('extra-script')

<script type="text/javascript">

$(document).ready(function(){

	$('#add_participant').keyup(function() {
	    var url = $(this).data("url");
	    var user = $(this).val();
	    var base = $('.jquery_dropdown_result').data("base");
	    if (user.length >= 2 ) {
	      $.ajaxSetup({
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
	        }
	      });
	      $.ajax({
	        url: url,
	        type: 'POST',
	        data: {'user': user},
	        dataType: 'JSON',
	        success:function(response){
	          $(".jquery_dropdown_result").empty();
	          for( var i = 0; i<response.length; i++){
	            $("<a class='list-group-item' href='"+base+"/messages/subject/"+response[i]['message_subject_id']+"/receipent/"+response[i]['user_id']+"/add'><div class='chip'><img src='"+response[i]['image']+"'>"+response[i]['name']+"</div></a>").hide().appendTo('.jquery_dropdown_result').show('normal');
	          }
	        }
	      });
	    }
	    else{
	      $(".jquery_dropdown_result").empty();
	    }
	});

  	$(document).on('click', '.edit_message_button', function(){
		var url = $(this).closest('div.social-meta').find('.message-div').data("url-edit");
		var div = $(this).closest('div.social-meta').find('.message-div');
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
		    div.hide().html('<textarea class="editor" name="message_text">'+response+'</textarea><button class="btn btn-sm btn-danger my-3 save_message"><i class="fa fa-check pr-2"></i>হালনাগাদ</button>').fadeIn('slow');
		    setTinyMce();
		    $(".message_options").hide();
		    $(".add_message").hide();
	      }
	    });
  	});

  	$(document).on('click', '.save_message', function(){
		var url = $(this).closest('div.social-meta').find('.message-div').data("url-update");
		var div = $(this).closest('div.social-meta').find('.message-div');
	    $.ajaxSetup({
	      headers: {
	        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
	      }
	    });
	    $.ajax({
	      url: url,
	      type: 'PUT',
	      data: {
	        'message_text': tinyMCE.activeEditor.getContent()
	      },
	      dataType: 'JSON',
	      beforeSend: function(){
	      	div.html("<center><h1><i class='fa fa-spinner fa-spin my-5'></i></h1></center>");
	      },
	      success:function(response){
		    div.html(response);
		    $(".message_options").show();
		    $(".add_message").show();
    		showNotification("সাফল্য!", "বার্তা হালনাগাদ করা হয়েছে!", "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp'); 
	      },
	      error: function(response){
	      	div.hide().html('<textarea class="editor" name="message_text">'+tinyMCE.activeEditor.getContent()+'</textarea><button class="btn btn-sm btn-danger save_message"><i class="fa fa-check pr-2"></i>হালনাগাদ</button>').fadeIn('slow');
		    setTinyMce();
    		showNotification("আপডেট করার সময় ত্রুটি!", "আপনার বার্তা আপডেট করা যাবে না! আপনার বার্তা খালি না তা নিশ্চিত করুন!", "#", "danger", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp'); 
	      }
	    });
  	});

});

</script>

@endsection


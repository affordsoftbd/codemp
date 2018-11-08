@extends('layouts.master')

@section('title', "নতুন বার্তা ||")

@section('content')

<!-- Grid row -->
<div class="row">

    <!-- Messages -->
    <div class="col-lg-9 mb-4">
		<div class="row">
		    <div class="col-xl-1 col-lg-2 col-md-2 post_creator">
		        <img src="{{ file_exists($conversation->subjectAuthor->detail->image_path) ? url('/').$conversation->subjectAuthor->detail->image_path : 'http://via.placeholder.com/450' }}" class="img-fluid rounded-circle z-depth-1-half">		        
		    </div>
		    <div class="col-xl-6 col-lg-4 col-md-4">
		        <h4>{{ $conversation->subject_text }}</h4>
				<small class="red-text">{{ $conversation->created_at->format('l d F Y, h:i A') }}</small>
		    </div>
		    <div class="col-xl-5 col-lg-6 col-md-6" align="right">
		        {!! Form::open(['route' => ['messages.destroy', $conversation->id], 'method'=>'delete']) !!}
		            <a href="#" class="btn btn-light-green btn-sm">
		                <i class="fa fa-edit"></i>
		            </a>
		            {!! Form::button('<i class="fa fa-trash"" aria-hidden="true"></i>', array('class' => 'btn btn-deep-orange btn-sm form_warning_sweet_alert', 'title'=>'আপনি কি নিশ্চিত?', 'text'=>'এই পোস্টটি আর উদ্ধার করা যাবে না!', 'confirmButtonText'=>'হ্যাঁ, পোস্টটি মুছে দিন!', 'type'=>'submit')) !!}
		        {!! Form::close() !!}
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
				    <div class="right-side-meta">{{ $message->created_at->format('l d F Y, h:i A') }}</div>
				    <img src="{{ file_exists($message->user->avatar) ? url('/').$message->user->avatar : 'http://via.placeholder.com/450' }}" class="rounded-circle avatar-img z-depth-1-half">{{ $message->user->first_name }}
				  </div>
				</div>
				<!-- Card content -->
				<div class="card-body" data-message-id="{{ $message->id }}">
				  <!-- Social meta-->
				  <div class="social-meta">
				    {!! $message->message_text !!}
				    <hr>
				    @if($message->user->id == $user->id && (strtotime($message->created_at) + 3600) > time())
                      {!! Form::open(['method' => 'delete', 'route' => ['messages.destroy', $message->id]]) !!}
                        <div class="btn-group mb-3 mx-3 pull-right" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-light-green btn-sm btn-rounded edit_message_button" data-toggle="modal" data-target="#edit_message_modal" data-message-id="{{ $message->id }}"><i class="fa fa-edit"" aria-hidden="true"></i></button>
                          {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('class' => 'btn btn-deep-orange btn-sm btn-rounded form_warning_sweet_alert', 'title'=>'আপনি কি নিশ্চিত?', 'text'=>'আপনার বার্তা হারিয়ে যাবে!', 'confirmButtonText'=>'হ্যাঁ, বার্তা মুছে দিন!', 'type'=>'submit')) !!}
                        </div>
                      {!! Form::close() !!} 
                    @endif
				  </div>
				</div>
				<!-- Card content -->
			</div>
			<!-- Card -->
        @endforeach
        @if($messages->isEmpty() || $messages->onFirstPage() && $messages->isNotEmpty() && $messages->first()->user->id != $user->id)
	        {!! Form::open(['method' => 'post', 'route' => ['messages.store']]) !!}
		        {!! Form::hidden('user_id', $user->id) !!}
		        {!! Form::hidden('message_subject_id', $conversation->id) !!}
		        <p class="font-weight-bold my-3">বার্তা যুক্ত করুন</p>
		        @if ($errors->has('message_text'))
		          <p class="red-text">{{ $errors->first('message_text') }}</p>
		        @endif
		        <!-- Material Editor -->
		        <div class="md-form">
		          {!! Form::textarea('message_text', null, array('class'=>'editor')) !!}
		        </div>
		        <div class="text-center my-4">
		        	{!! Form::button('<i class="fa fa-plus pr-2"></i>যোগ করুন', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
		        </div>
		    {!! Form::close() !!}  
        @endif



    </div>

    <!-- Participants -->
    <div class="col-lg-3 mb-4">
        <h5>অংশগ্রাহীরা</h5><hr>
    </div>

    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#centralModalSm">
	  Launch demo modal
	</button>
	<div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-lg" role="document">
	      	<div class="modal-content">
		        <div class="modal-header">
		          <h4 class="modal-title w-100" id="myModalLabel">Modal title</h4>
		          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		          </button>
		        </div>
		        <div class="modal-body">
		          ...
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
		          <button type="button" class="btn btn-primary btn-sm">Save changes</button>
		        </div>
	  		</div>
		</div>
	</div> -->

</div>

@endsection

@section('extra-script')

<div>
If no background color is set on the Element, or its background color is set to 'transparent', the default end value will be white.
</div>
<button class='btn'>Edit</button>
<div>Element shortcut method for tweening the background color. Immediately transitions an Element's background color to a specified highlight color then back to its set background color.</div>
<button class='btn'>Edit</button>
<div>Element shortcut method which immediately transitions any single CSS property of an Element from one value to another.</div>
<button class='btn'>Edit</button>

<button class='remove'>Remove</button>

<script type="text/javascript">

function divClicked() {
    var divHtml = $(this).prev('div').html();
    var editableText = $("<textarea class='editor' />");
    editableText.val(divHtml);
    $(this).prev('div').replaceWith(editableText);
    setTinyMce();
    editableText.focus();
    editableText.blur(editableTextBlurred);
}

function editableTextBlurred() {
    var html = $(this).val();
    var viewableText = $("<div>");
    viewableText.html(html);
    tinymce.remove('.editor');
    $(this).replaceWith(viewableText);
    viewableText.click(divClicked);
}

$(document).ready(function(){

  $(".btn").click(divClicked);

  $(".remove").click(function(){
    tinymce.remove(".editor");
  });

});

</script>

@endsection


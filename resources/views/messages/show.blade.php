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
<div id='parent'>
    <textarea>txt1</textarea>
    <textarea>txt2</textarea>
    <textarea>txt3</textarea>
</div>
<button onClick="addBox()">add textarea</button>
<input type='button' value='Toggle Editor' id='but_toggle'>

<div id="TheContainer">
    <div class="MyClass">My Class</div>
    <div class="SomeClass">Not My Class</div>
    <div class="SomeOtherClass">Not My Class</div>
    <div class="SomeClass">Not My Class</div>
    <div class="MyClass">My Class</div>
    <div class="SomeOtherClass">Not My Class</div>
    <div class="SomeClass">Not My Class</div>
    <div class="MyClass">My Class</div>
</div>

<div>
  <textarea id='editor' style='width: 99%; height: 200px;'></textarea>
</div>

<script type="text/javascript">
addBox = function(){
    var textBox = document.createElement("textarea");
    document.getElementById("parent").appendChild(textBox);
}
$(document).ready(function(){

    $('#TheContainer').on('click', '.MyClass', function () {
        alert( $(this).index('.MyClass') );
    });

  // Add TinyMCE
  addTinyMCE();

  // Toggle Editor
  $('#but_toggle').click(function(){

   // Check TinyMCE initialized or not
   if(tinyMCE.get('editor')){

     // Remove instance by id
     tinymce.remove('#editor');
   }else{

     // Add TinyMCE
     addTinyMCE();
   }
 
  });
});

// Add TinyMCE
function addTinyMCE(){
  // Initialize
  tinymce.init({
    selector: '#editor',
    themes: 'modern',
    height: 200
  });
}

</script>>

@endsection


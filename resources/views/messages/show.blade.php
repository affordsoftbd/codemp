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
			<div class="card news-card mb-5">
				<!-- Heading-->
				<div class="card-body">
				  <div class="content">
				    <div class="right-side-meta">{{ $message->created_at->format('l d F Y, h:i A') }}</div>
				    <img src="{{ file_exists($message->user->avatar) ? url('/').$message->user->avatar : 'http://via.placeholder.com/450' }}" class="rounded-circle avatar-img z-depth-1-half">{{ $message->user->first_name }}
				  </div>
				</div>
				<!-- Card content -->
				<div class="card-body">
				  <!-- Social meta-->
				  <div class="social-meta">
				    {!! $message->message_text !!}
				    <hr>
                      {!! Form::open(['method' => 'delete', 'route' => ['messages.destroy', $message->id]]) !!}
                        <div class="btn-group mb-3 mx-3 pull-right" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-light-green btn-sm btn-rounded edit_message_button" data-toggle="modal" data-target="#edit_message_modal" data-message-id="{{ $message->id }}"><i class="fa fa-edit"" aria-hidden="true"></i></button>
                          {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('class' => 'btn btn-deep-orange btn-sm btn-rounded form_warning_sweet_alert', 'title'=>'Are you sure?', 'text'=>'Your message will disappear!', 'confirmButtonText'=>'Yes, delete message!', 'type'=>'submit')) !!}
                        </div>
                      {!! Form::close() !!} 
				    @if($message->user->id == $user->id && (strtotime($message->created_at) + 3600) > time())
                      {!! Form::open(['method' => 'delete', 'route' => ['messages.destroy', $message->id]]) !!}
                        <div class="btn-group mb-3 mx-3" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-indigo btn-sm btn-rounded edit_message_button" data-toggle="modal" data-target="#edit_message_modal" data-message-id="{{ $message->id }}"><i class="fa fa-edit"" aria-hidden="true"></i></button>
                          {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('class' => 'btn btn-unique btn-sm btn-rounded form_warning_sweet_alert', 'title'=>'Are you sure?', 'text'=>'Your message will disappear!', 'confirmButtonText'=>'Yes, delete message!', 'type'=>'submit')) !!}
                        </div>
                      {!! Form::close() !!} 
                    @endif
				  </div>
				</div>
				<!-- Card content -->
			</div>
			<!-- Card -->
        @endforeach
    </div>

    <!-- Participants -->
    <div class="col-lg-3 mb-4">
        <h5>অংশগ্রাহীরা</h5><hr>
    </div>

</div>


@endsection



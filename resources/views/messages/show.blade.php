@extends('layouts.master')

@section('title', "নতুন বার্তা ||")

@section('content')

<!-- Grid row -->
<div class="row">

    <!-- Messages -->
    <div class="col-lg-9 mb-4">
        <h4>{{ $conversation->subject_text }}</h4><hr>
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
				    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(17)-mini.jpg" class="rounded-circle avatar-img z-depth-1-half">{{ $message->user->first_name }}
				  </div>
				</div>
				<!-- Card content -->
				<div class="card-body">
				  <!-- Social meta-->
				  <div class="social-meta">
				    {!! $message->message_text !!}
				    <hr>
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



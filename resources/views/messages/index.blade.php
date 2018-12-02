@extends('layouts.master')

@section('title', "বার্তা ||")

@section('content')

@if(Request::url() === url('/').'/messages')
<a href="{{ route('messages.administrated') }}" class="btn btn-dark-green btn-sm pull-right">
  <i class="fa fa-exclamation-circle fa-sm pr-2"></i>শুধুমাত্র আপনার অ্যাডমিনিস্ট্রেটকৃত বার্তাসমূহ প্রদর্শন করুন
</a>
@else
<a href="{{ route('messages.index') }}" class="btn btn-dark-green btn-sm pull-right">
  <i class="fa fa-exclamation-circle fa-sm pr-2"></i>সকল  বার্তাসমূহ প্রদর্শন করুন
</a>
@endif


<h4 class="font-weight-bold green-text">{{ (Request::url() === url('/').'/messages') ? '' : 'অ্যাডমিনিস্ট্রেটকৃত' }} বার্তা {{ empty($search) ? 'এর তালিকা' : 'অনুসন্ধান' }} </h4>
<small class="red-text">{{ empty($search) ? 'আপনার অংশগ্রহনকৃত' : 'আপনার অনুসন্ধানের উপর ভিত্তি করে' }} বার্তা তালিকা</small>
<hr>

@if(empty($search))
<a href="{{ route('messages.create') }}" class="btn btn-outline-danger btn-rounded waves-effect"><i class="fa fa-plus pr-2"></i>নতুন বার্তা যোগ করুন</a>
@else
  <a class="btn btn-sm btn-dark-green" href="{{ route('messages.index') }}"><i class="fa fa-refresh fa-sm pr-2"" aria-hidden="true"></i> রিফ্রেশ তালিকা</a>
@endif

@if(Request::url() === url('/').'/messages')
{!! Form::open(['url' => '/messages/', 'method'=>'get']) !!}
@else
{!! Form::open(['url' => '/messages/administrated/', 'method'=>'get']) !!}
@endif
	<div class="row mb-5">
	  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
	    <!-- Material input email -->
	    <div class="md-form">
	        {!! Form::text('search', $search, ['class'=>'form-control', 'id'=>'search']) !!}
	        {!! Form::label('search', 'বার্তা অনুসন্ধান') !!}
	    </div>
	  </div>
	  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	    <div class="text-center mt-4">
	      {!! Form::button('<i class="fa fa-search"></i>', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
	    </div>
	  </div>
	</div>
{!! Form::close() !!}

@foreach($messages as $message)
	<a href="{{ route('messages.show', $message->id) }}" target="_blank">
	  <div class="row mb-5">
	    <div class="col-md-1">
	     <img src="{{ file_exists($message->messages->last()->user->detail->image_path) ? asset($message->messages->last()->user->detail->image_path) : 'http://via.placeholder.com/450' }}" class="img-fluid rounded-circle z-depth-0 image-thumbnail my-3">
	    </div>
	    <div class="col-md-11">
	      <div class="card">
	        <div class="card-body {{ $message->messages->last()->viewers->contains('viewer', $user->id) ? 'green'  : 'red' }} white-text">
	          <strong>{{ $message->subject_text }}</strong>
	          <small class="pull-right">{{ $message->author == $user->id ? 'এডমিনিস্ট্রেটর'  : '' }}</small>
	          <br>
	          {{ substr(strip_tags($message->messages->last()->message_text), 0, 50) }}...
	        </div>
	      </div> 
	    </div>
	  </div>
	</a>
@endforeach

<!-- Pagination -->
<nav aria-label="Page navigation example" class="table-responsive">
  <ul class="pagination pg-blue justify-content-end">
    <ul class="pagination pg-blue">
        {{ $messages->links() }}                 
    </ul>
  </ul>
</nav>

@endsection



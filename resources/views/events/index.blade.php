@extends('layouts.master')

@section('title', "ইভেন্টস ||")

@section('content')

@if(Request::url() === url('/').'/events')
<a href="{{ route('events.organized') }}" class="btn btn-dark-green btn-sm pull-right">
  <i class="fa fa-exclamation-circle fa-sm pr-2"></i>শুধুমাত্র আপনার সংগঠিত ইভেন্টসসমূহ প্রদর্শন করুন
</a>
@else
<a href="{{ route('events.index') }}" class="btn btn-dark-green btn-sm pull-right">
  <i class="fa fa-exclamation-circle fa-sm pr-2"></i>সকল  ইভেন্টসসমূহ প্রদর্শন করুন
</a>
@endif

<h4 class="font-weight-bold green-text">{{ (Request::url() === url('/').'/events') ? '' : 'সংগঠিত' }} ইভেন্টস {{ empty($search) ? 'এর তালিকা' : 'অনুসন্ধান' }} </h4>
<small class="red-text">{{ empty($search) ? 'আপনার অংশগ্রহনকৃত' : 'আপনার অনুসন্ধানের উপর ভিত্তি করে' }} ইভেন্টস তালিকা</small>
<hr>

@if(empty($search))
	<a href="{{ route('events.create') }}" class="btn btn-outline-danger btn-rounded waves-effect"><i class="fa fa-plus pr-2"></i>নতুন ইভেন্ট যোগ করুন</a>
@else
  	<a class="btn btn-sm btn-dark-green" href="{{ route('events.index') }}"><i class="fa fa-refresh fa-sm pr-2"" aria-hidden="true"></i> রিফ্রেশ তালিকা</a>
@endif

@if(Request::url() === url('/').'/events')
	{!! Form::open(['url' => '/events/', 'method'=>'get']) !!}
@else
	{!! Form::open(['url' => '/events/organized/', 'method'=>'get']) !!}
@endif
	<div class="row mb-5">
	  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
	    <!-- Material input email -->
	    <div class="md-form">
	        {!! Form::text('search', $search, ['class'=>'form-control', 'id'=>'search']) !!}
	        {!! Form::label('search', 'ইভেন্ট অনুসন্ধান') !!}
	    </div>
	  </div>
	  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	    <div class="text-center mt-4">
	      {!! Form::button('<i class="fa fa-search"></i>', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
	    </div>
	  </div>
	</div>
{!! Form::close() !!}


@foreach($events as $event)

<!-- Small news -->
<div class="single-news my-4">
	<div class="row">
		<div class="col-md-3">
			<div class="view overlay rounded z-depth-1 mb-4">
				<img class="img-fluid" src="{{ file_exists(url('/').$event->event_image) ? url('/').$event->event_image : 'http://via.placeholder.com/200x120' }}" alt="Sample image">
				<a href="{{ route('events.show', $event->id) }}">
					<div class="mask rgba-white-slight"></div>
				</a>
			</div>
		</div>
		<div class="col-md-9">
			<a href="{{ route('events.show', $event->id) }}" class="font-weight-bold dark-grey-text">{{ $event->title }}</a>
			<div class="d-flex justify-content-between">
			  <div class="col-11 text-truncate pl-0 mb-3">
			  	<p class="red-text small">মোট অংশগ্রহণকারী: {{ count($event->participants) }}</p>
			    <a href="{{ route('events.show', $event->id) }}" class="dark-grey-text">{{ date('l d F Y, h:i A', strtotime($event->created_at)) }}</a>
			  </div>
			  <a href="{{ route('events.show', $event->id) }}"><i class="fa fa-angle-double-right"></i></a>
			</div>
		</div>
	</div>
	<hr>
</div>
<!-- Small news -->

@endforeach

<!-- Pagination -->
<nav aria-label="Page navigation example" class="table-responsive">
  <ul class="pagination pg-blue justify-content-end">
    <ul class="pagination pg-blue">
        {{ $events->links() }}                 
    </ul>
  </ul>
</nav>

@endsection



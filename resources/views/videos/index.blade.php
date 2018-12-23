@extends('layouts.master')

@section('title', "ভিডিও ||")

@section('content')

<div class="row">
	<div class="col-lg-6 col-sm-12">
		<h4 class="font-weight-bold green-text">{{ (Request::url() === url('/').'/videos') ? '' : 'নির্মিত' }} ভিডিও {{ empty($search) ? 'এর তালিকা' : 'অনুসন্ধান' }} </h4>
		<small class="red-text">{{ empty($search) ? 'আপনার সম্পর্কিত' : 'আপনার অনুসন্ধানের উপর ভিত্তি করে' }} ভিডিও তালিকা</small>
	</div>
	<div class="col-lg-6 col-sm-12 header-option">
		@if(Request::url() === url('/').'/videos')
			<a href="{{ route('events.organized') }}" class="btn btn-dark-green btn-sm pull-right">
			  <i class="fa fa-exclamation-circle fa-sm pr-2"></i>শুধুমাত্র আপনার নির্মিত ভিডিও প্রদর্শন করুন
			</a>
		@else
			<a href="{{ route('videos.index') }}" class="btn btn-dark-green btn-sm pull-right">
			  <i class="fa fa-exclamation-circle fa-sm pr-2"></i>সকল  ভিডিও প্রদর্শন করুন
			</a>
		@endif
	</div>
</div>
<hr>

@if(empty($search))
	<a href="{{ route('videos.create') }}" class="btn btn-outline-danger btn-rounded waves-effect"><i class="fa fa-plus pr-2"></i>নতুন ভিডিও যোগ করুন</a>
@else
  	<a class="btn btn-sm btn-dark-green" href="{{ route('videos.index') }}"><i class="fa fa-refresh fa-sm pr-2"" aria-hidden="true"></i>রিফ্রেশ তালিকা</a>
@endif

@if(Request::url() === url('/').'/videos')
	{!! Form::open(['url' => '/videos/', 'method'=>'get']) !!}
@else
	{!! Form::open(['url' => '/videos/created/', 'method'=>'get']) !!}
@endif
	<div class="row mb-5">
	  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
	    <!-- Material input email -->
	    <div class="md-form">
	        {!! Form::text('search', $search, ['class'=>'form-control', 'id'=>'search']) !!}
	        {!! Form::label('search', 'ভিডিও অনুসন্ধান') !!}
	    </div>
	  </div>
	  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	    <div class="text-center mt-4">
	      {!! Form::button('<i class="fa fa-search"></i>', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
	    </div>
	  </div>
	</div>
{!! Form::close() !!}


@endsection



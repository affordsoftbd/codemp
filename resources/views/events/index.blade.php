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

@if(Request::url() === url('/').'/evemts')
{!! Form::open(['url' => '/events/', 'method'=>'get']) !!}
@else
{!! Form::open(['url' => '/events/administrated/', 'method'=>'get']) !!}
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

@endsection



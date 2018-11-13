@extends('layouts.master')

@section('title', "নতুন ইভেন্টস ||")

@section('content')

<h4 class="red-text">একটি নতুন ইভেন্ট তৈরি করুন</h4>
<hr>

{!! Form::open(['method' => 'post', 'route' => ['events.store'], 'class'=>'md-form']) !!}
    <div class="md-form">
        {!! Form::text('title', null, array('class'=>'md-textarea form-control no-resize auto-growth', 'rows'=>'1', 'id'=>'title')) !!}
        {!! Form::label('title', 'ইভেন্ট শিরনাম') !!}
    </div>
    @if ($errors->has('title'))
        <p class="red-text">{{ $errors->first('title') }}</p>
    @endif
    <h6 class="font-weight-bold my-3">বিস্তারিত</h6>
    <div class="md-form">
        {!! Form::textarea('details', null, array('class'=>'editor')) !!}
    </div>
    @if ($errors->has('details'))
        <p class="red-text">{{ $errors->first('details') }}</p>
    @endif
    <div class="text-center my-4">
        {!! Form::button('<i class="fa fa-plus pr-2"></i>যোগ করুন', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
    </div>
{!! Form::close() !!}


<a class="btn btn-success waves-effect btn-sm" href="{{ route('events.index') }}"><i class="fa fa-arrow-circle-left fa-sm pr-2" aria-hidden="true"></i>প্রত্যাবর্তন</a>


@endsection
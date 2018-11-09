@extends('layouts.master')

@section('title', "বার্তা হালনাগাদ ||")

@section('content')

<h4 class="red-text">একটি নতুন বার্তা তৈরি করুন</h4>
<hr>

{!! Form::open(['method' => 'put', 'route' => ['messages.subject.add'], 'class'=>'md-form login-form']) !!}
    <div class="md-form">
        {!! Form::textarea('subject_text', null, array('class'=>'md-textarea form-control no-resize auto-growth', 'rows'=>'1', 'id'=>'subject_text')) !!}
        {!! Form::label('subject_text', 'বার্তা বিষয়') !!}
    </div>
    @if ($errors->has('subject_text'))
        <p class="red-text">{{ $errors->first('subject_text') }}</p>
    @endif
    <div class="text-center my-4">
        {!! Form::button('<i class="fa fa-plus pr-2"></i>হালনাগাদ', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
    </div>
{!! Form::close() !!}


<a class="btn btn-success waves-effect btn-sm" href="{{ route('messages.index') }}"><i class="fa fa-arrow-circle-left fa-sm pr-2" aria-hidden="true"></i>প্রত্যাবর্তন</a>


@endsection



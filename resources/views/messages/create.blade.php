@extends('layouts.master')

@section('title', "নতুন বার্তা ||")

@section('content')

<h4 class="red-text">{{ !empty($recipient)? $recipient->first_name.' '.$recipient->last_name.' কে বার্তা পাঠান' : 'একটি নতুন বার্তা তৈরি করুন' }}</h4>
<hr>

{!! Form::open(['method' => 'post', 'route' => ['messages.subject.add'], 'class'=>'md-form login-form', 'name' => 'check_edit']) !!}
    @if(!empty($recipient))
        {!! Form::hidden('recipient', $recipient->id) !!}
    @endIf
    <div class="md-form">
        {!! Form::textarea('subject_text', null, array('class'=>'md-textarea form-control no-resize auto-growth', 'rows'=>'1', 'id'=>'subject_text')) !!}
        {!! Form::label('subject_text', 'বার্তা বিষয়') !!}
    </div>
    @if ($errors->has('subject_text'))
        <p class="red-text">{{ $errors->first('subject_text') }}</p>
    @endif
    <h6 class="font-weight-bold my-3">বার্তা</h6>
    <div class="md-form">
        {!! Form::textarea('message_text', null, array('class'=>'editor')) !!}
    </div>
    @if ($errors->has('message_text'))
        <p class="red-text">{{ $errors->first('message_text') }}</p>
    @endif
    <div class="text-center my-4">
        {!! Form::button('<i class="fa fa-plus pr-2"></i>যোগ করুন', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
    </div>
{!! Form::close() !!}


<a class="btn btn-success waves-effect btn-sm" href="{{ route('messages.index') }}"><i class="fa fa-arrow-circle-left fa-sm pr-2" aria-hidden="true"></i>প্রত্যাবর্তন</a>


@endsection



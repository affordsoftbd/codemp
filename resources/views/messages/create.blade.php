@extends('layouts.master')

@section('title', "নতুন বার্তা ||")

@section('content')

<h4>নতুন বার্তা তৈরি করুন</h4><hr>

{!! Form::open(['method' => 'post', 'route' => ['message.subject.add'], 'class'=>'md-form login-form']) !!}
    <!-- <div align="right">
        <div class="form-check form-check-inline">
          <input type="radio" class="form-check-input" id="materialInline1" name="inlineMaterialRadiosExample" checked>
          <label class="form-check-label" for="materialInline1">সর্বজনীন</label>
        </div>

        <div class="form-check form-check-inline">
          <input type="radio" class="form-check-input red" id="materialInline2" name="inlineMaterialRadiosExample">
          <label class="form-check-label" for="materialInline2">অনুসারীগণ</label>
        </div>

        <div class="form-check form-check-inline">
          <input type="radio" class="form-check-input red" id="materialInline3" name="inlineMaterialRadiosExample">
          <label class="form-check-label" for="materialInline3">নির্দিষ্ট প্রাপক</label>
        </div>
    </div> -->
    <div class="md-form">
        {!! Form::textarea('subject_text', null, array('class'=>'md-textarea form-control no-resize auto-growth', 'rows'=>'1', 'id'=>'subject_text')) !!}
        {!! Form::label('subject_text', 'বার্তা বিষয়') !!}
    </div>
    @if ($errors->has('subject_text'))
        <p class="red-text">{{ $errors->first('subject_text') }}</p>
    @endif
    <div class="md-form">
        {!! Form::textarea('message_text', null, array('class'=>'editor')) !!}
    </div>
    @if ($errors->has('message_text'))
        <p class="red-text">{{ $errors->first('message_text') }}</p>
    @endif
    <div class="text-center my-4">
        {!! Form::button('<i class="fa fa-send pr-2"></i>পাঠান', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
    </div>
{!! Form::close() !!}


@endsection



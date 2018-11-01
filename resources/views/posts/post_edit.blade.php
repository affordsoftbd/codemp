@extends('layouts.master')

@section('title', "পোস্ট সম্পাদনা ||")

@section('content')

<h4 class="red-text">পোস্ট আপডেট করুন</h4>
<small class="grey-text"><b>সর্বশেষ সংষ্করণ:</b> {{ (empty($post->updated_at))? 'এখনো আপডেট করা হয় নি!' : $post->updated_at }}</small>
<hr>

{!! Form::open(['method' => 'put', 'route' => ['post.update', $post->post_id], 'class'=>'md-form login-form']) !!}
    <div class="md-form">
        {!! Form::textarea('description', $post->description, array('class'=>'editor')) !!}
    </div>
    <div class="text-center my-4">
        {!! Form::button('হালনাগাদ', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
    </div>
{!! Form::close() !!}

@if($post->post_type == 'photo')
    <a class="btn btn-success waves-effect btn-sm" href="{{ route('image', $post->post_id) }}"><i class="fa fa-arrow-circle-left fa-sm pr-2" aria-hidden="true"></i>প্রত্যাবর্তন</a>
@elseIf($post->post_type == 'video')
    <a class="btn btn-success waves-effect btn-sm" href="{{ route('video', $post->post_id) }}"><i class="fa fa-arrow-circle-left fa-sm pr-2" aria-hidden="true"></i>প্রত্যাবর্তন</a>
@else
    <a class="btn btn-success waves-effect btn-sm" href="{{ route('post', $post->post_id) }}"><i class="fa fa-arrow-circle-left fa-sm pr-2" aria-hidden="true"></i>প্রত্যাবর্তন</a>
@endIf

@endsection



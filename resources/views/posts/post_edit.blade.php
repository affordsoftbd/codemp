@extends('layouts.master')

@section('title', "পোস্ট বিস্তারিত ||")

@section('content')


<h6 class="font-weight-bold">{{ $post->first_name." ".$post->last_name}}</h6>
<small class="grey-text">{{ $post->created_at}}</small>

<hr>

{!! Form::open(['method' => 'post', 'id' => 'text_post_form', 'class'=>'md-form login-form']) !!}

{!! Form::textarea('additional_details', $post->description, array('class'=>'editor','name'=>'comment_text','id'=>'comment_text')) !!}

{!! Form::close() !!}

@endsection



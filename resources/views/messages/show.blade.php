@extends('layouts.master')

@section('title', "নতুন বার্তা ||")

@section('content')

<h4>{{ $conversation->subject_text }}</h4><hr>

{{ print_r($conversation) }}


@endsection



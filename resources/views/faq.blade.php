@extends('auth.layout')

@section('title', "প্রায়শই জিজ্ঞাসিত প্রশ্নাবলী  || ")

@section('content')      

	<nav class="navbar navbar-expand-lg navbar-dark green">

	    <div class="container container-fluid">

            <a class="navbar-brand" href="{{ route('welcome') }}">
                {{ Html::image('img/amarneta.png', 'Amar Neta Logo', array('width' => '146', 'height' => '40')) }}
            </a>

	    </div>

	</nav>

	<!-- faq -->
    <div class="container">

    </div>

@endsection
@extends('auth.layout')

@section('title', "আমাদের সম্পর্কে  || ")

@section('content')      

	<nav class="navbar navbar-expand-lg navbar-dark green">

	    <div class="container container-fluid">

            <a class="navbar-brand" href="{{ route('welcome') }}">
                {{ Html::image('img/amarneta.png', 'Amar Neta Logo', array('width' => '146', 'height' => '40')) }}
            </a>

	    </div>

	</nav>

	<!-- about us -->
    <div class="container">

    </div>

@endsection
@extends('auth.layout')

@section('title', "শর্তাবলী  || ")

@section('content')      

	<nav class="navbar navbar-expand-lg navbar-dark green">

	    <div class="container container-fluid">

            <a class="navbar-brand" href="{{ route('welcome') }}">
                {{ Html::image('img/amarneta.png', 'Amar Neta Logo', array('width' => '146', 'height' => '40')) }}
            </a>

	    </div>

	</nav>


    <!-- terms and conditions -->
    <div class="container my-5">
        <h4 class="red-text">শর্তাবলী</h4><hr>
    </div>

@endsection
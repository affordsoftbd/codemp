@extends('layouts.master')

@section('title', "নতুন বার্তা ||")

@section('content')

<!-- Grid row -->
<div class="row">

    <!-- Messages -->
    <div class="col-lg-9 mb-4">
        <h4>{{ $conversation->subject_text }}</h4><hr>
        {{ print_r($conversation) }}
		<!-- Card -->
			<div class="card news-card">

			<!-- Heading-->
			<div class="card-body">
			  <div class="content">
			    <div class="right-side-meta">14 h</div>
			    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(17)-mini.jpg" class="rounded-circle avatar-img z-depth-1-half">Kate
			  </div>
			</div>
			<!-- Card content -->
			<div class="card-body">
			  <!-- Social meta-->
			  <div class="social-meta">
			    <p>Another great adventure! </p>
			    <hr>
			    <span><i class="fa fa-heart-o"></i>25 likes</span>
			    <p><i class="fa fa-comment"></i>13 comments</p>
			  </div>
			</div>
			<!-- Card content -->

			</div>
		<!-- Card -->
    </div>

    <!-- Participants -->
    <div class="col-lg-3 mb-4">
        <h5>অংশগ্রাহীরা</h5><hr>
    </div>

</div>


@endsection



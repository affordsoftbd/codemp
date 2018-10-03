@extends('layouts.master')

@section('title', "পরিলেখ || পোস্ট ||")

@section('content')

@include('profile.profile')
<!-- Nav tabs -->
 <ul class="nav nav-tabs md-tabs nav-justified red my-5" role="tablist">
     <li class="nav-item">
         <a class="nav-link active" data-toggle="tab" href="javascript:void(0)" role="tab"><i class="fa fa-edit fa-sm pr-2"></i> পোস্ট সমূহ</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('profile.albums', 'amar_neta') }}" role="tab"><i class="fa fa-file-image-o fa-sm pr-2"></i> অ্যালবাম সমূহ</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('profile.videos', 'amar_neta') }}" role="tab"><i class="fa fa-file-movie-o fa-sm pr-2"></i> ভিডিও সমূহ</a>
     </li>
 </ul>
 <!-- Tab panels -->
 <div class="tab-content">

	<div class="card mb-4">
		<div class="card-body">
			<div class="row">
				<div class="col-xl-1 col-lg-2 col-md-2 post_creator">
				<img src="http://localhost:8000null" class="rounded-circle z-depth-1-half"></div>
				<div class="col-xl-11 col-lg-10 col-md-10">
					<h6 class="font-weight-bold">Mohiuddin Muhin</h6>
					<small class="grey-text">2018-09-29 20:31:58</small>
				</div>
			</div>
			<hr>asdasd
		</div>
		<div class="rounded-bottom green text-center pt-3">
			<ul class="list-unstyled list-inline font-small">
				<li class="list-inline-item pr-2">
				</li>
				<li class="list-inline-item">
					<a href="http://localhost:8000/post/75" class="white-text">
							<i class="fa fa-comments-o pr-1"></i><span id="p_comment_75">0</span>
						</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="card mb-4">
		<div class="card-body">
			<div class="row">
				<div class="col-xl-1 col-lg-2 col-md-2 post_creator">
				<img src="http://localhost:8000null" class="rounded-circle z-depth-1-half"></div>
				<div class="col-xl-11 col-lg-10 col-md-10">
					<h6 class="font-weight-bold">Mohiuddin Muhin</h6>
					<small class="grey-text">2018-09-29 20:31:58</small>
				</div>
			</div>
			<hr>asdasd
		</div>
		<div class="rounded-bottom green text-center pt-3">
			<ul class="list-unstyled list-inline font-small">
				<li class="list-inline-item pr-2">
				</li>
				<li class="list-inline-item">
					<a href="http://localhost:8000/post/75" class="white-text">
							<i class="fa fa-comments-o pr-1"></i><span id="p_comment_75">0</span>
						</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="card mb-4">
		<div class="card-body">
			<div class="row">
				<div class="col-xl-1 col-lg-2 col-md-2 post_creator">
				<img src="http://localhost:8000null" class="rounded-circle z-depth-1-half"></div>
				<div class="col-xl-11 col-lg-10 col-md-10">
					<h6 class="font-weight-bold">Mohiuddin Muhin</h6>
					<small class="grey-text">2018-09-29 20:31:58</small>
				</div>
			</div>
			<hr>asdasd
		</div>
		<div class="rounded-bottom green text-center pt-3">
			<ul class="list-unstyled list-inline font-small">
				<li class="list-inline-item pr-2">
				</li>
				<li class="list-inline-item">
					<a href="http://localhost:8000/post/75" class="white-text">
							<i class="fa fa-comments-o pr-1"></i><span id="p_comment_75">0</span>
						</a>
				</li>
			</ul>
		</div>
	</div>
	<!--Pagination-->
	<nav aria-label="pagination example">
	    <ul class="pagination pg-blue">

	        <!--Arrow left-->
	        <li class="page-item disabled">
	            <a class="page-link" href="#" aria-label="Previous">
	                <span aria-hidden="true">&laquo;</span>
	                <span class="sr-only">Previous</span>
	            </a>
	        </li>

	        <li class="page-item active">
	            <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
	        </li>
	        <li class="page-item"><a class="page-link" href="#">2</a></li>
	        <li class="page-item"><a class="page-link" href="#">3</a></li>
	        <li class="page-item"><a class="page-link" href="#">4</a></li>
	        <li class="page-item"><a class="page-link" href="#">5</a></li>

	        <li class="page-item">
	            <a class="page-link" href="#" aria-label="Next">
	                <span aria-hidden="true">&raquo;</span>
	                <span class="sr-only">Next</span>
	            </a>
	        </li>
	    </ul>
	</nav>
 </div>
@endsection



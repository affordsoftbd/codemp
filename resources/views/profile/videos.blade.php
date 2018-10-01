@extends('layouts.master')

@section('title', "পরিলেখ ||")

@section('content')

<div class="row">
    <div class="col-xl-8 col-lg-6 col-md-6">
		<h1>
			Clara Denis
		</h1>
		<small class="grey-text">সিলেট > মোগগ্রারা সদর > সোনারগাঁও উপজেলা অধীনে নেতা হিসেবে যোগদান করেছেন</small>
		<hr>
		<p class="red-text font-weight-bold">
			<i class="fa fa-envelope prefix grey-text fa-sm pr-2"></i>
			clara@gmail.com
		</p>
		<p class="red-text font-weight-bold">
			<i class="fa fa-phone prefix grey-text fa-sm pr-2"></i>
			015523556465
		</p>
		<p class="red-text font-weight-bold">
			<i class="fa fa-address-card prefix grey-text fa-sm pr-2"></i>
			399/1, West Bengal
		</p>
		<div class="btn-group my-4" role="group" aria-label="Basic example">
		    <button type="button" class="btn btn-light-green btn-sm"><i class="fa fa-edit fa-sm pr-2" aria-hidden="true"></i>হালনাগাদ</button>
		    <button type="button" class="btn btn-dark-green btn-sm"><i class="fa fa-bank fa-sm pr-2" aria-hidden="true"></i>অর্থাদি</button>
		</div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6">
		<!-- Card -->
		<div class="card card-personal">

			<!-- Card image-->
			<img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(29).jpg" alt="Card image cap">
			<!-- Card image-->

			<!-- Card content -->
			<div class="card-body">
			  <p class="card-meta">Joined in 2013</p>
			  <hr>
			  <a class="card-meta"><span><i class="fa fa-user"></i>22 Followers</span></a>
			</div>
			<!-- Card content -->

		</div>
		<!-- Card -->
    </div>
</div>
<!-- Nav tabs -->
 <ul class="nav nav-tabs md-tabs nav-justified red my-5" role="tablist">
     <li class="nav-item">
         <a class="nav-link" href="{{ route('profile', 'amar_neta') }}" role="tab"><i class="fa fa-edit fa-sm pr-2"></i> পোস্ট সমূহ</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('profile.albums', 'amar_neta') }}" role="tab"><i class="fa fa-file-image-o fa-sm pr-2"></i> অ্যালবাম সমূহ</a>
     </li>
     <li class="nav-item">
         <a class="nav-link active" data-toggle="tab" href="javascript:void(0)" role="tab"><i class="fa fa-file-movie-o fa-sm pr-2"></i> ভিডিও সমূহ</a>
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
					<a class="btn-floating btn-action ml-auto mr-4 red pull-right" onclick="show_comment_box(75)">
						<i class="fa fa-chevron-right pl-1"></i>
					</a>
				</div>
			</div>
			<hr>
			asdasd
			<!-- Card image -->
		    <div class="view overlay my-3" align="center">
		        <div class="embed-responsive embed-responsive-16by9">
		            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/v64KOxKVLVg" allowfullscreen></iframe>
		        </div> 
		    </div>
		</div>
		<div class="rounded-bottom green text-center pt-3">
			<ul class="list-unstyled list-inline font-small">
				<li class="list-inline-item pr-2">
					<a href="javascript:void(0)" class="white-text" onclick="save_post_like(75)">
						<i class="fa fa-thumbs-o-up pr-1"></i>
						<span id="p_like_75">0</span></a>
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
					<a class="btn-floating btn-action ml-auto mr-4 red pull-right" onclick="show_comment_box(75)">
						<i class="fa fa-chevron-right pl-1"></i>
					</a>
				</div>
			</div>
			<hr>
			asdasd
			<!-- Card image -->
		    <div class="view overlay my-3" align="center">
		        <div class="embed-responsive embed-responsive-16by9">
		            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/v64KOxKVLVg" allowfullscreen></iframe>
		        </div> 
		    </div>
		</div>
		<div class="rounded-bottom green text-center pt-3">
			<ul class="list-unstyled list-inline font-small">
				<li class="list-inline-item pr-2">
					<a href="javascript:void(0)" class="white-text" onclick="save_post_like(75)">
						<i class="fa fa-thumbs-o-up pr-1"></i>
						<span id="p_like_75">0</span></a>
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
					<a class="btn-floating btn-action ml-auto mr-4 red pull-right" onclick="show_comment_box(75)">
						<i class="fa fa-chevron-right pl-1"></i>
					</a>
				</div>
			</div>
			<hr>
			asdasd
			<!-- Card image -->
		    <div class="view overlay my-3" align="center">
		        <div class="embed-responsive embed-responsive-16by9">
		            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/v64KOxKVLVg" allowfullscreen></iframe>
		        </div> 
		    </div>
		</div>
		<div class="rounded-bottom green text-center pt-3">
			<ul class="list-unstyled list-inline font-small">
				<li class="list-inline-item pr-2">
					<a href="javascript:void(0)" class="white-text" onclick="save_post_like(75)">
						<i class="fa fa-thumbs-o-up pr-1"></i>
						<span id="p_like_75">0</span></a>
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



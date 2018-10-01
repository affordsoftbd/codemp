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
	<div class="row mb-5">
		<div class="col-md-6">
			<!-- Card -->
			<div class="card">

			  <!-- Card image -->
			  <div class="view overlay">
			    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/food.jpg" alt="Card image cap">
			    <a>
			      <div class="mask rgba-white-slight"></div>
			    </a>
			  </div>

			  <!-- Button -->
			  <a class="btn-floating btn-action ml-auto mr-4 mdb-color lighten-3"><i class="fa fa-chevron-right pl-1"></i></a>

			  <!-- Card content -->
			  <div class="card-body">

			    <!-- Title -->
			    <h4 class="card-title">Card title</h4>
			    <hr>
			    <!-- Text -->
			    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

			  </div>

			  <!-- Card footer -->
			  <div class="rounded-bottom mdb-color lighten-3 text-center pt-3">
			    <ul class="list-unstyled list-inline font-small">
			      <li class="list-inline-item pr-2 white-text"><i class="fa fa-clock-o pr-1"></i>05/10/2015</li>
			      <li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-comments-o pr-1"></i>12</a></li>
			      <li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-facebook pr-1"> </i>21</a></li>
			      <li class="list-inline-item"><a href="#" class="white-text"><i class="fa fa-twitter pr-1"> </i>5</a></li>
			    </ul>
			  </div>

			</div>
			<!-- Card -->
		</div>
		<div class="col-md-6">
			<!-- Card -->
			<div class="card">

			  <!-- Card image -->
			  <div class="view overlay">
			    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/food.jpg" alt="Card image cap">
			    <a>
			      <div class="mask rgba-white-slight"></div>
			    </a>
			  </div>

			  <!-- Button -->
			  <a class="btn-floating btn-action ml-auto mr-4 mdb-color lighten-3"><i class="fa fa-chevron-right pl-1"></i></a>

			  <!-- Card content -->
			  <div class="card-body">

			    <!-- Title -->
			    <h4 class="card-title">Card title</h4>
			    <hr>
			    <!-- Text -->
			    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

			  </div>

			  <!-- Card footer -->
			  <div class="rounded-bottom mdb-color lighten-3 text-center pt-3">
			    <ul class="list-unstyled list-inline font-small">
			      <li class="list-inline-item pr-2 white-text"><i class="fa fa-clock-o pr-1"></i>05/10/2015</li>
			      <li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-comments-o pr-1"></i>12</a></li>
			      <li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-facebook pr-1"> </i>21</a></li>
			      <li class="list-inline-item"><a href="#" class="white-text"><i class="fa fa-twitter pr-1"> </i>5</a></li>
			    </ul>
			  </div>

			</div>
			<!-- Card -->
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



@extends('layouts.master')

@section('title', "আবেদন ||")

@section('content')

<h4>আবেদনকারীদের তালিকা</h4>
<p class="red-text">মোট আবেদন: 25টি</p>
<hr>

<div class="row my-5">
  <div class="col-lg-4 mb-4">
    <!-- Card -->
      <div class="card card-personal">

        <!-- Card image-->
        <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(29).jpg" alt="Card image cap">
        <!-- Card image-->

        <!-- Card content -->
        <div class="card-body">
          <!-- Title-->
          <a><h4 class="card-title title-one">Clara</h4></a>
          <p class="card-meta">অংশগ্রহন 2013</p>
          <!-- Text -->
          <p class="card-text"><strong>সিলেট > মোগগ্রারা সদর > সোনারগাঁও উপজেলা</strong> অধীনে <strong>নেতা</strong> হিসেবে যোগদান করেছেন</p>
          <hr>
          <div class="btn-group mt-3" role="group" aria-label="Basic example">
              <a href="button" class="btn btn-orange btn-sm" data-toggle="tooltip" data-placement="right" title="অনুমোদন"><i class="fa fa-thumbs-up"></i></a>
              <a href="button" class="btn btn-light-green btn-sm" data-toggle="tooltip" data-placement="right" title="চ্যাট"><i class="fa fa-comments"></i></a>
              <a href="{{ route('profile', Session::get('username')) }}" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="পরিলেখ"><i class="fa fa-user"></i></a>
          </div>
        </div>
        <!-- Card content -->

      </div>
      <!-- Card -->
  </div>
  <div class="col-lg-4 mb-4">
    <!-- Card -->
      <div class="card card-personal">

        <!-- Card image-->
        <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(29).jpg" alt="Card image cap">
        <!-- Card image-->

        <!-- Card content -->
        <div class="card-body">
          <!-- Title-->
          <a><h4 class="card-title title-one">Clara</h4></a>
          <p class="card-meta">অংশগ্রহন 2013</p>
          <!-- Text -->
          <p class="card-text"><strong>সিলেট > মোগগ্রারা সদর > সোনারগাঁও উপজেলা</strong> অধীনে <strong>নেতা</strong> হিসেবে যোগদান করেছেন</p>
          <hr>
          <div class="btn-group mt-3" role="group" aria-label="Basic example">
              <a href="button" class="btn btn-orange btn-sm" data-toggle="tooltip" data-placement="right" title="অনুমোদন"><i class="fa fa-thumbs-up"></i></a>
              <a href="button" class="btn btn-light-green btn-sm" data-toggle="tooltip" data-placement="right" title="চ্যাট"><i class="fa fa-comments"></i></a>
              <a href="{{ route('profile', Session::get('username')) }}" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="পরিলেখ"><i class="fa fa-user"></i></a>
          </div>
        </div>
        <!-- Card content -->

      </div>
      <!-- Card -->
  </div>
  <div class="col-lg-4 mb-4">
    <!-- Card -->
      <div class="card card-personal">

        <!-- Card image-->
        <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(29).jpg" alt="Card image cap">
        <!-- Card image-->

        <!-- Card content -->
        <div class="card-body">
          <!-- Title-->
          <a><h4 class="card-title title-one">Clara</h4></a>
          <p class="card-meta">অংশগ্রহন 2013</p>
          <!-- Text -->
          <p class="card-text"><strong>সিলেট > মোগগ্রারা সদর > সোনারগাঁও উপজেলা</strong> অধীনে <strong>নেতা</strong> হিসেবে যোগদান করেছেন</p>
          <hr>
          <div class="btn-group mt-3" role="group" aria-label="Basic example">
              <a href="button" class="btn btn-orange btn-sm" data-toggle="tooltip" data-placement="right" title="অনুমোদন"><i class="fa fa-thumbs-up"></i></a>
              <a href="button" class="btn btn-light-green btn-sm" data-toggle="tooltip" data-placement="right" title="চ্যাট"><i class="fa fa-comments"></i></a>
              <a href="{{ route('profile', Session::get('username')) }}" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="পরিলেখ"><i class="fa fa-user"></i></a>
          </div>
        </div>
        <!-- Card content -->

      </div>
      <!-- Card -->
  </div>
</div>

<!--Pagination-->
    <nav aria-label="pagination example my-5">
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


@endsection
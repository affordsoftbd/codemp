@extends('layouts.master')

@section('title', "আবেদন ||")

@section('content')

<!-- Grid row -->
<div class="row">

  <!-- Politicans -->
  <div class="col-lg-8 mb-4">

    <div class="row">
      <div class="col-lg-6 mb-4">
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
              <a class="card-meta"><span><i class="fa fa-user"></i>22 জন অনুসারী</span></a>
              <div class="btn-group mt-3" role="group" aria-label="Basic example">
                  <a href="button" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="অনুসরণ"><i class="fa fa-check"></i></a>
                  <a href="button" class="btn btn-light-green btn-sm" data-toggle="tooltip" data-placement="right" title="চ্যাট"><i class="fa fa-comments"></i></a>
                  <a href="{{ route('profile', Session::get('username')) }}" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="পরিলেখ"><i class="fa fa-user"></i></a>
              </div>
            </div>
            <!-- Card content -->

          </div>
          <!-- Card -->
      </div>
      <div class="col-lg-6 mb-4">
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
              <a class="card-meta"><span><i class="fa fa-user"></i>22 জন অনুসারী</span></a>
              <div class="btn-group mt-3" role="group" aria-label="Basic example">
                  <a href="button" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="অনুসরণ"><i class="fa fa-check"></i></a>
                  <a href="button" class="btn btn-light-green btn-sm" data-toggle="tooltip" data-placement="right" title="চ্যাট"><i class="fa fa-comments"></i></a>
                  <a href="{{ route('profile', Session::get('username')) }}" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="পরিলেখ"><i class="fa fa-user"></i></a>
              </div>
            </div>
            <!-- Card content -->

          </div>
          <!-- Card -->
      </div>
      <div class="col-lg-6 mb-4">
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
              <a class="card-meta"><span><i class="fa fa-user"></i>22 জন অনুসারী</span></a>
              <div class="btn-group mt-3" role="group" aria-label="Basic example">
                  <a href="button" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="অনুসরণ"><i class="fa fa-check"></i></a>
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

  <!-- Search and sort-->
  <div class="col-lg-4 mb-4">
    <!-- Search form -->
    <form>
      <div class="row">
        <div class="col-sm-10">
          <div class="md-form">
            <input class="form-control" id="keyword" name="keyword" type="text">
            <label for="keyword">আপনার নেতাকে অনুসন্ধান করুন</label>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </div>
    </form>
    <form id="user_form" method="post" action="">
        {{ csrf_field() }}
            <div class="md-form">
                <!-- Choose Division -->
                <select class="mdb-select" name="division" id="division">
                    <option value="" disabled selected>বিভাগ</option>
                    <option value="">Option 1</option>
                    <option value="">Option 2</option>
                    <option value="">Option 2</option>
                </select>
            </div>
            <div class="md-form">
                <!-- Choose District -->
                <select class="mdb-select" name="district" id="district" searchable="এখানে অনুসন্ধান করুন">
                    <option value="" disabled selected>জেলা</option>
                    <option value="">Option 1</option>
                    <option value="">Option 2</option>
                    <option value="">Option 2</option>
                </select>
            </div>
            <div class="md-form">
                <!-- Choose Thana -->
                <select class="mdb-select" name="thana" id="thana" searchable="এখানে অনুসন্ধান করুন">
                    <option value="" disabled selected>থানা</option>
                    <option value="">Option 1</option>
                    <option value="">Option 2</option>
                    <option value="">Option 2</option>
                </select>
            </div>
            <div class="md-form">
                <!-- Choose Zip -->
                <select class="mdb-select" name="zip" id="zip" searchable="এখানে অনুসন্ধান করুন">
                    <option value="" disabled selected>জিপ</option>
                    <option value="">Option 1</option>
                    <option value="">Option 2</option>
                    <option value="">Option 2</option>
                </select>
            </div>

        <!-- Sign up button -->
        <div class="text-center my-4">
            <button class="btn btn-danger waves-effect text-center" type="submit">সাজান</button>
        </div>
    </form>

  </div>

</div>

@endsection

@section('extra-script')
    <script>
        $(document).ready(function() {
           $('#division').material_select();
           $('#district').material_select();
           $('#thana').material_select();
           $('#zip').material_select();
        });
     </script>
@endsection
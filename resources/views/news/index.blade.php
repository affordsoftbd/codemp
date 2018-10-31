@extends('layouts.master')

@section('title', "খবর ||")

@section('content')

<h4>খবর এর তালিকা</h4><hr>

<!-- Grid row -->
  <div class="row">

    <!-- News -->
    <div class="col-lg-9 mb-4">
      <div class="row">

        <!-- Headline -->
        <div class="col-lg-6 mb-4" align="center">

        <!-- Featured image -->
        <div class="view overlay rounded z-depth-2 mb-4">
        <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/81.jpg" alt="Sample image">
        <a>
          <div class="mask rgba-white-slight"></div>
        </a>
        </div>

        <!-- Category -->
        <a href="#!" class="red-text"><h6 class="font-weight-bold mb-3"><i class="fa fa-tag pr-2"></i>Adventure</h6></a>
        <!-- Post title -->
        <h4 class="font-weight-bold mb-3"><strong>Title of the news</strong></h4>
        <!-- Post data -->
        <p>15/07/2018</p>
        <!-- Excerpt -->
        <p class="dark-grey-text">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus voluptas.</p>
        <!-- Read more button -->
        <a href="{{ route('news.details', 'nam-libero-tempore') }}" class="btn btn-danger btn-rounded btn-md">আরো পড়ুন</a>

        </div>
        <!-- Headline -->

        <!-- Headline -->
        <div class="col-lg-6 mb-4" align="center">

        <!-- Featured image -->
        <div class="view overlay rounded z-depth-2 mb-4">
        <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/81.jpg" alt="Sample image">
        <a>
          <div class="mask rgba-white-slight"></div>
        </a>
        </div>

        <!-- Category -->
        <a href="#!" class="red-text"><h6 class="font-weight-bold mb-3"><i class="fa fa-tag pr-2"></i>Adventure</h6></a>
        <!-- Post title -->
        <h4 class="font-weight-bold mb-3"><strong>Title of the news</strong></h4>
        <!-- Post data -->
        <p>15/07/2018</p>
        <!-- Excerpt -->
        <p class="dark-grey-text">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus voluptas.</p>
        <!-- Read more button -->
        <a href="{{ route('news.details', 'nam-libero-tempore') }}" class="btn btn-danger btn-rounded btn-md">আরো পড়ুন</a>

        </div>
        <!-- Headline -->

        <!-- Headline -->
        <div class="col-lg-6 mb-4" align="center">

        <!-- Featured image -->
        <div class="view overlay rounded z-depth-2 mb-4">
        <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/81.jpg" alt="Sample image">
        <a>
          <div class="mask rgba-white-slight"></div>
        </a>
        </div>

        <!-- Category -->
        <a href="#!" class="red-text"><h6 class="font-weight-bold mb-3"><i class="fa fa-tag pr-2"></i>Adventure</h6></a>
        <!-- Post title -->
        <h4 class="font-weight-bold mb-3"><strong>Title of the news</strong></h4>
        <!-- Post data -->
        <p>15/07/2018</p>
        <!-- Excerpt -->
        <p class="dark-grey-text">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus voluptas.</p>
        <!-- Read more button -->
        <a href="{{ route('news.details', 'nam-libero-tempore') }}" class="btn btn-danger btn-rounded btn-md">আরো পড়ুন</a>

        </div>
        <!-- Headline -->

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

    <!-- Navigate -->
    <div class="col-lg-3 mb-4">
      @include('news.sort')
    </div>

  </div>

@endsection



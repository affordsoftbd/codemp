@extends('layouts.master')

@section('title', "খবর ||")

@section('content')

<h4 class="font-weight-bold green-text">খবর এর তালিকা</h4>
<small class="red-text">{{ empty($search) ? 'সকল' : 'আপনার অনুসন্ধানের উপর ভিত্তি করে' }} খবর</small>
<hr>

<!-- Grid row -->
  <div class="row">

    <!-- News -->
    <div class="col-lg-9 mb-4">
      <div class="row">

        @foreach($news as $nws)
        <!-- Headline -->
        <div class="col-lg-6 mb-4" align="center">

          <!-- Featured image -->
          <div class="view overlay rounded z-depth-2 mb-4">
          <img class="img-fluid" src="{{ file_exists($nws->image_path) ? asset($nws->image_path) : 'http://via.placeholder.com/400x300?text=News+Image' }}" alt="{{ $nws->title }}">
          <a>
            <div class="mask rgba-white-slight"></div>
          </a>
          </div>

          <!-- Category -->
          <!--a href="#!" class="red-text"><h6 class="font-weight-bold mb-3"><i class="fa fa-tag pr-2"></i>Adventure</h6></a-->
          <!-- Post title -->
          <h4 class="font-weight-bold mb-3"><strong>{{ $nws->title }}</strong></h4>
          <!-- Post data -->
          <p><i class="fa fa-clock-o pr-2"></i>{{ $nws->created_at->format('l d F Y, h:i A') }}</p>
          <!-- Excerpt -->
          <p class="dark-grey-text"><?php echo substr($nws->description, 0, 250) ?></p>
          <!-- Read more button -->
          <a href="{{ route('news.details', $nws->global_news_id) }}" class="btn btn-danger btn-rounded btn-md">আরো পড়ুন</a>

        </div>
        <!-- Headline -->
        @endforeach

      </div>

      <!--Pagination-->
      <nav aria-label="pagination example">
          <ul class="pagination pg-blue">

              <!--Arrow left-->
              {{ $news->render()}}
          </ul>
      </nav>

    </div>

    <!-- Navigate -->
    <div class="col-lg-3 mb-4">
      @include('news.sort')
    </div>

  </div>

@endsection



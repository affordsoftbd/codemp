@extends('layouts.master')

@section('title', "খবর ||")

@section('content')

<!-- Grid row -->
  <div class="row">

    <!-- News -->
    <div class="col-lg-9 mb-4">

        <!-- Card -->
        <div class="card card-cascade wider reverse">

          <!-- Card image -->
          <div class="view view-cascade overlay">
            <img class="card-img-top" src="{{ url('/').'/'.$news->image_path}}" alt="Sample image">
            <a href="#!">
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>

          <!-- Card content -->
          <div class="card-body card-body-cascade text-center">

            <!-- Title -->
            <h2 class="font-weight-bold"><a>{{ $news->title }}</a></h2>
            <a href="#!" class="red-text"><h6 class="font-weight-bold mb-3"><i class="fa fa-tag pr-2"></i>Adventure</h6></a>
            <!-- Data -->
            <p>{{ date('d/m/Y',strtotime($news->created_at)) }}</p>

          </div>
          <!-- Card content -->

        </div>
        <!-- Card -->

        <!-- Excerpt -->
        <div class="mt-5">

          {{ $news->description }}

        </div>

        <h4 class="font-weight-bold mt-5">মন্তব্য</h4><hr>

        <!-- Card -->
        <div class="card news-card mb-4">
          <!-- Heading-->
          <div class="card-body">
            <div class="content">
              <div class="right-side-meta">14 h</div>
              <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(17)-mini.jpg" class="rounded-circle profile-image-thumbnile avatar-img z-depth-1-half"><strong>Kate</strong>
            </div>
          </div>
          <hr>
          <!-- Card content -->
          <div class="card-body">
            <!-- Social meta-->
            <div class="social-meta">
              <p>Another great adventure! </p>
            </div>
          </div>
        </div>
        <!-- Card -->

        <form id="comment_form" class="login-form" method="post" action="">
            <div class="md-form">
                {!! Form::textarea('additional_details', null, array('class'=>'editor','name'=>'comment_text','id'=>'comment_text')) !!}
            </div>
            <div class="text-center my-4">
                {!! Form::button('পোস্ট', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
            </div>
        </form>

    </div>

    <!-- Navigate -->
    <div class="col-lg-3 mb-4">
      @include('news.sort')
    </div>

  </div>

@endsection



@extends('layouts.master')

@section('title', "ফিড || ")

@section('content')

<h4>আপনি কি ভাবছেন?</h4><hr>

<div class="card border message_area border-light">
    <div class="card-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs md-tabs nav-justified green" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">
                    <i class="fa fa-edit fa-sm pr-2"></i>পোস্ট রচনা করুন
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel2" role="tab">
                    <i class="fa fa-file-image-o fa-sm pr-2"></i>অ্যালবাম / ফটো
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel3" role="tab">
                    <i class="fa fa-file-movie-o fa-sm pr-2"></i>লাইভ ভিডিও
                </a>
            </li>
        </ul>
         <!-- Tab panels -->
         <div class="tab-content">
            <div class="tab-pane fade in show active" id="panel1" role="tabpanel">
                {!! Form::open() !!}    
                    <div class="md-form">
                        {!! Form::textarea('additional_details', null, array('class'=>'editor')) !!}
                    </div>
                    <div class="text-center my-4">
                        {!! Form::button('অবস্থা হালনাগাদ করুন', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm pull-right')) !!}
                    </div>
                {!! Form::close() !!}
                <div class="clearfix"></div>
            </div>
            <!--/.Panel 1-->
            <!--Panel 2-->
            <div class="tab-pane fade" id="panel2" role="tabpanel">
                {!! Form::open(['class'=>'md-form upload_image']) !!}
                    <div class="file-field">
                        <div class="btn btn-danger btn-sm float-left">
                        <span>নির্বাচন</span>
                            {!! Form::file("image", ['class'=>'input_image', 'multiple'=>'true']) !!}
                        </div>
                        <div class="file-path-wrapper">
                            {!! Form::text('', null, ['class'=>'file-path validate', 'placeholder'=>'আপনার ফাইলটি চয়ন করুন']) !!}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="preview_input"></div>
                    <div class="text-center mt-4">
                        {{ Form::button('চিত্র আপলোড <i class="fa fa-upload ml-1"></i>', ['type' => 'submit', 'class' => 'btn btn-danger mt-1 btn-md'] ) }}
                    </div>
                {!! Form::close() !!}
            </div>
            <!--/.Panel 2-->
            <!--Panel 3-->
            <div class="tab-pane fade" id="panel3" role="tabpanel">
                <hr>
                <button type="button" class="btn btn-danger btn-lg btn-block"><i class="fa fa-video-camera fa-sm pr-2"></i>ভিডিওটি শুরু করতে এখানে ক্লিক করুন</button>
            </div>
         </div>
    </div>
</div>

<!-- text Card -->
<div class="card my-4">
    <!-- Card content -->
    <div class="card-body">
        <div class="row">
            <div class="col-xl-1 col-lg-2 col-md-2">
                <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg" class="rounded-circle z-depth-1-half">
            </div>
            <div class="col-xl-11 col-lg-10 col-md-10">
                <h6 class="font-weight-bold">Gracie Monahan</h6>
                <small class="grey-text">Monday 20 August 2018, 09:50 AM</small>
            </div>
        </div>
        <hr>
        Doloremque doloremque fuga nostrum harum. Omnis totam id alias dolorum qui. Recusandae assumenda adipisci ut enim rerum aut repudiandae. Nihil quia temporibus quam sapiente ut. Accusamus tenetur labore fuga incidunt. Recusandae porro ipsam cumque ut consequatur. Non et sed et quisquam ipsa et praesentium. Odit aut culpa earum consequatur sit quis. Consequatur est error mollitia ex aliquid. Quia tempore quae qui adipisci quidem laboriosam voluptates.
    </div>

  <!-- Card footer -->
  <div class="rounded-bottom green text-center pt-3">
    <ul class="list-unstyled list-inline font-small">
      <li class="list-inline-item pr-2 white-text"><i class="fa fa-clock-o pr-1"></i>05/10/2015</li>
      <li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-comments-o pr-1"></i>12</a></li>
      <li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-facebook pr-1"> </i>21</a></li>
      <li class="list-inline-item"><a href="#" class="white-text"><i class="fa fa-twitter pr-1"> </i>5</a></li>
    </ul>
  </div>
</div>
<!-- #ends# text Card -->

<!-- slider Card -->
<div class="card my-4">

    <!-- Card image -->
    <div class="view overlay mt-4" align="center">
    
        <div class="lightgallery">
            <p><span id="counter0">1</span> of 05</p>
            <ul class="lightSlider">
                <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-8.jpg" data-src="http://sachinchoolur.github.io/lightslider/img/cS-8.jpg" data-sub-html="Focused client-server ability 10">
                    <img src="http://sachinchoolur.github.io/lightslider/img/cS-8.jpg" />
                </li>
                <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-9.jpg" data-src="http://sachinchoolur.github.io/lightslider/img/cS-9.jpg" data-sub-html="Focused client-server ability 14">
                    <img src="http://sachinchoolur.github.io/lightslider/img/cS-9.jpg" />
                </li>
                <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-10.jpg" data-src="http://sachinchoolur.github.io/lightslider/img/cS-10.jpg" data-sub-html="Focused client-server ability 15">
                    <img src="http://sachinchoolur.github.io/lightslider/img/cS-10.jpg" />
                </li>
                <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-11.jpg" data-src="http://sachinchoolur.github.io/lightslider/img/cS-11.jpg" data-sub-html="Focused client-server ability 10">
                    <img src="http://sachinchoolur.github.io/lightslider/img/cS-12.jpg" />
                </li>
                <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-13.jpg" data-src="http://sachinchoolur.github.io/lightslider/img/cS-13.jpg" data-sub-html="Focused client-server ability 10">
                    <img src="http://sachinchoolur.github.io/lightslider/img/cS-13.jpg" />
                </li>
            </ul>
        </div> 
    </div>

  <!-- Button -->
  <a class="btn-floating btn-action ml-auto mr-4 red"><i class="fa fa-chevron-right pl-1"></i></a>

    <!-- Card content -->
    <div class="card-body">
        <div class="row">
            <div class="col-xl-1 col-lg-2 col-md-2">
                <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg" class="rounded-circle z-depth-1-half">
            </div>
            <div class="col-xl-11 col-lg-10 col-md-10">
                <h6 class="font-weight-bold">Gracie Monahan</h6>
                <small class="grey-text">Monday 20 August 2018, 09:50 AM</small>
            </div>
        </div>
        <hr>
        Doloremque doloremque fuga nostrum harum. Omnis totam id alias dolorum qui. Recusandae assumenda adipisci ut enim rerum aut repudiandae. Nihil quia temporibus quam sapiente ut. Accusamus tenetur labore fuga incidunt. Recusandae porro ipsam cumque ut consequatur. Non et sed et quisquam ipsa et praesentium. Odit aut culpa earum consequatur sit quis. Consequatur est error mollitia ex aliquid. Quia tempore quae qui adipisci quidem laboriosam voluptates.
    </div>

  <!-- Card footer -->
  <div class="rounded-bottom green text-center pt-3">
    <ul class="list-unstyled list-inline font-small">
      <li class="list-inline-item pr-2 white-text"><i class="fa fa-clock-o pr-1"></i>05/10/2015</li>
      <li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-comments-o pr-1"></i>12</a></li>
      <li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-facebook pr-1"> </i>21</a></li>
      <li class="list-inline-item"><a href="#" class="white-text"><i class="fa fa-twitter pr-1"> </i>5</a></li>
    </ul>
  </div>

</div>
<!-- #ends# slider Card -->

<!-- slider Card -->
<div class="card my-4">

    <!-- Card image -->
    <div class="view overlay mt-4" align="center">
        <div class="lightgallery">
            <p><span id="counter1">1</span> of 04</p>
            <ul class="lightSlider">
                <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-1.jpg" data-src="http://sachinchoolur.github.io/lightslider/img/cS-1.jpg" data-sub-html="Focused client-server ability 10">
                    <img src="http://sachinchoolur.github.io/lightslider/img/cS-1.jpg" />
                </li>
                <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-1.jpg" data-src="http://sachinchoolur.github.io/lightslider/img/cS-2.jpg" data-sub-html="Focused client-server ability 10">
                    <img src="http://sachinchoolur.github.io/lightslider/img/cS-2.jpg" />
                </li>
                <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-3.jpg" data-src="http://sachinchoolur.github.io/lightslider/img/cS-3.jpg" data-sub-html="Focused client-server ability 10">
                    <img src="http://sachinchoolur.github.io/lightslider/img/cS-3.jpg" />
                </li>
                <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-4.jpg" data-src="http://sachinchoolur.github.io/lightslider/img/cS-4.jpg" data-sub-html="Focused client-server ability 10">
                    <img src="http://sachinchoolur.github.io/lightslider/img/cS-4.jpg" />
                </li>
            </ul>
        </div> 
    </div>

  <!-- Button -->
  <a class="btn-floating btn-action ml-auto mr-4 red"><i class="fa fa-chevron-right pl-1"></i></a>

    <!-- Card content -->
    <div class="card-body">
        <div class="row">
            <div class="col-xl-1 col-lg-2 col-md-2">
                <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg" class="rounded-circle z-depth-1-half">
            </div>
            <div class="col-xl-11 col-lg-10 col-md-10">
                <h6 class="font-weight-bold">Gracie Monahan</h6>
                <small class="grey-text">Monday 20 August 2018, 09:50 AM</small>
            </div>
        </div>
        <hr>
        Doloremque doloremque fuga nostrum harum. Omnis totam id alias dolorum qui. Recusandae assumenda adipisci ut enim rerum aut repudiandae. Nihil quia temporibus quam sapiente ut. Accusamus tenetur labore fuga incidunt. Recusandae porro ipsam cumque ut consequatur. Non et sed et quisquam ipsa et praesentium. Odit aut culpa earum consequatur sit quis. Consequatur est error mollitia ex aliquid. Quia tempore quae qui adipisci quidem laboriosam voluptates.
    </div>

  <!-- Card footer -->
  <div class="rounded-bottom green text-center pt-3">
    <ul class="list-unstyled list-inline font-small">
      <li class="list-inline-item pr-2 white-text"><i class="fa fa-clock-o pr-1"></i>05/10/2015</li>
      <li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-comments-o pr-1"></i>12</a></li>
      <li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-facebook pr-1"> </i>21</a></li>
      <li class="list-inline-item"><a href="#" class="white-text"><i class="fa fa-twitter pr-1"> </i>5</a></li>
    </ul>
  </div>

</div>
<!-- #ends# slider Card -->


<div class="card">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        You are logged in!
    </div>
</div>
<div class="card my-3">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        You are logged in!
    </div>
</div>
<div class="card my-3">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        You are logged in!
    </div>
</div>
<div class="card my-3">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        You are logged in!
    </div>
</div>
<div class="card my-3">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        You are logged in!
    </div>
</div>
@endsection



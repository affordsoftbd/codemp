@extends('layouts.master')

@section('title', "ফিড || ")

@section('content')

<h4>What's on your mind?</h4><hr>

<!-- Nav tabs -->
 <ul class="nav nav-tabs md-tabs nav-justified green" role="tablist">
     <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">
            <i class="fa fa-edit fa-sm pr-2"></i>Compose Post
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panel2" role="tab">
            <i class="fa fa-file-image-o fa-sm pr-2"></i>Album/Photos
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panel3" role="tab">
            <i class="fa fa-file-movie-o fa-sm pr-2"></i>Live Video
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
                {!! Form::button('Update Status', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm pull-right')) !!}
            </div>
        {!! Form::close() !!}
        <div class="clearfix"></div>
    </div>
    <!--/.Panel 1-->
    <!--Panel 2-->
    <div class="tab-pane fade" id="panel2" role="tabpanel">
        <div class="text-center">
            <img src="http://placehold.it/200" class="img-fluid z-depth-1 preview_input" alt="Responsive image">
            <p class="text-center mt-4">Maximum Allowed Size: 500 KB</p>
        </div>
        {!! Form::open(['class'=>'md-form upload_image']) !!}
          <div class="file-field">
              <div class="btn btn-primary btn-sm float-left">
                  <span>Select</span>
                  {!! Form::file("image", ['class'=>'input_image']) !!}
              </div>
              <div class="file-path-wrapper">
                  {!! Form::text('', null, ['class'=>'file-path validate', 'placeholder'=>'Choose your file']) !!}
              </div>
          </div>
          <div class="text-center mt-4">
              {{ Form::button('Upload Image <i class="fa fa-upload ml-1"></i>', ['type' => 'submit', 'class' => 'btn btn-danger mt-1 btn-md'] ) }}
          </div>
        {!! Form::close() !!}
    </div>
    <!--/.Panel 2-->
    <!--Panel 3-->
    <div class="tab-pane fade" id="panel3" role="tabpanel">
        <hr>
        <button type="button" class="btn btn-danger btn-lg btn-block"><i class="fa fa-video-camera fa-sm pr-2"></i>Click here to start video</button>
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



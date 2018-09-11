@extends('layouts.master')

@section('title', "ফিড || ")

@section('content')

<h4>What's on your mind?</h4><hr>

<!-- Nav tabs -->
<ul class="nav nav-tabs md-tabs nav-justified">
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
<div class="tab-content card">
    <!--Panel 1-->
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
        <br>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta doloribus
            reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora, placeat ratione
            porro voluptate odit minima.</p>
    </div>
    <!--/.Panel 3-->
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



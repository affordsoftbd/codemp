<!DOCTYPE html>
<html lang="en">

  <!-- Header -->
  <head>
    @include('layouts.partials.meta')

    <!-- Favicon-->
    <link rel="icon" href="https://cdn.appstorm.net/mac.appstorm.net/files/2012/07/icon4.png"/"/>

    <title>@yield('title') আমার নেতা || আপনার নেতাদের সাথে সংযোগ স্থাপন করুন</title>

    <!-- Font Awesome -->
    {{ Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}

    <!-- Google Icons -->
    {{ Html::style('https://fonts.googleapis.com/icon?family=Material+Icons') }}

    <!-- Bootstrap core CSS -->
    {{ Html::style('css/bootstrap.min.css') }}
    
    @yield('extra-css')

    @include('layouts.partials.styles')

  </head>
  <!-- #ENDS# Header -->

  <body>
    
  	@include('layouts.partials.loader')
  	@include('layouts.partials.navigation')

    <div class="container home-container my-5">
        <div class="row justify-content-center">
            <div class="col-md-3 mb-3">
              @include('layouts.partials.sidemenu')
            </div>
            <div class="col-md-9">
              <!-- Content -->
              @yield('content')
              <!-- #ENDS# Content -->
            </div>
        </div>
    </div>



<!-- alert message START -->
<div class="modal fade alert" role="dialog" id="alert-modal" style="z-index: 99999">
    <div class="modal-dialog" style="width: 350px">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body text-center">
                <div id="alert-error-msg">
                    <div>
                        <i class="material-icons">error_outline</i>
                    </div>
                    <p class="text-danger"></p>
                </div>
                <div id="alert-success-msg">
                    <div>
                        <i class="material-icons">check</i>
                    </div>
                    <p class="text-success"></p>
                </div>
                <button class="btn btn-primary" data-dismiss="modal" id="alert-ok">ok</button>
            </div>
        </div>
    </div>
</div>
<!-- alert message End -->



<!-- warning message START -->
<div class="modal fade alert" role="dialog" id="warning-modal" style="z-index: 99999">
    <div class="modal-dialog" style="width: 350px">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body text-center">
                <div id="alert-error-msg">
                    <div>
                        <i class="material-icons">error_outline</i>
                    </div>
                    <p class="text-danger">
                        Are you sure you want to do this?
                    </p>
                </div>
                <button class="btn btn-primary" id="warning_ok">Yes</button>
                <button class="btn btn-danger" data-dismiss="modal" id="alert-ok">No</button>
            </div>
        </div>
    </div>
</div>

<!-- alert message End -->

  	@include('layouts.partials.alerts')
    @include('layouts.partials.scrolltotop')

    <!-- Javascript -->

    <!-- Bootstrap core JavaScript -->
    {{Html::script('js/jquery.min.js')}}
    {{Html::script('js/jquery.form.js')}}

    <!-- Bootstrap tooltips -->
    {{Html::script('js/popper.min.js')}}

    <!-- Bootstrap core JavaScript -->
    {{Html::script('js/bootstrap.min.js')}}

    @include('layouts.partials.scripts')

    @yield('extra-script')

    <script>      

      function show_success_message($message){

          $('#alert-modal').modal('show');

          $('#alert-error-msg').hide();

          $('#alert-success-msg').show();

          $('#alert-success-msg p').html($message);

      }

      function show_error_message(message){

          $('#alert-modal').modal('show');

          $('#alert-error-msg').show();

          $('#alert-success-msg').hide();

          $('#alert-error-msg p').html(message);

      }
    </script>

  </body>

</html>

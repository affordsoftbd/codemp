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

  </body>

</html>

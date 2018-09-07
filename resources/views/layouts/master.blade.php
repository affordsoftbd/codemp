<!DOCTYPE html>
<html lang="en">

  <!-- Header -->
  <head>
    @include('layouts.partials.meta')

    <!-- Favicon-->
    <link rel="icon" href="{!! asset('favicon.png') !!}"/>

    <title>@yield('title') Amar Neta || Connect with your workers</title>

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
      
    <!-- Content -->
    @yield('content')
    <!-- #ENDS# Content -->

  	@include('layouts.partials.alerts')
    @include('layouts.partials.scrolltotop')
  	@include('layouts.partials.footer')

    <!-- Javascript -->

    <!-- Bootstrap core JavaScript -->
    {{Html::script('js/jquery.min.js')}}
    {{Html::script('js/jquery.form.js')}}

    <!-- Bootstrap tooltips -->
    {{Html::script('js/popper.min.js')}}

    <!-- Bootstrap core JavaScript -->
    {{Html::script('js/bootstrap.min.js')}}

    @yield('extra-script')

    @include('layouts.partials.scripts')

  </body>

</html>

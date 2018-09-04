<!DOCTYPE html>
<html lang="en">

  <!-- Header -->
  <head>
    @include('layouts.partials.meta')

    <!-- Favicon-->
    <link rel="icon" href="{!! asset('favicon.png') !!}"/>

    <title>@yield('title') Amar Neta || Connect with your workers</title>

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
    @include('layouts.partials.scripts')

  </body>

</html>

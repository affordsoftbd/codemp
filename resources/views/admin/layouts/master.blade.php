<!DOCTYPE html>
<html lang="en">

  <!-- Header -->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon-->
    <link rel="icon" href="{{{ asset('favicon.png') }}}"/"/>

    <title>@yield('title') আমার নেতা || আপনার নেতাদের সাথে সংযোগ স্থাপন করুন</title>

    <!-- Font Awesome -->
    {{ Html::style('https://use.fontawesome.com/releases/v5.6.3/css/all.css') }}

    <!-- Bootstrap core CSS -->
    {{ Html::style('css/bootstrap.min.css') }}

    <!-- Animation Css -->
    {{ Html::style('plugins/animate-css/animate.css') }}

    <!-- Sweetalert Css -->
    {{ Html::style('plugins/sweetalert/sweetalert.css') }}

    <!-- Bootstrap Spinner Css -->
    {{ Html::style('plugins/jquery-spinner/css/bootstrap-spinner.css') }}

    <!-- Jqurey Datatable Css -->
    {{ Html::style('plugins/material-addons/css/datatables.min.css') }}

    <!-- Material Design Bootstrap -->
    {{ Html::style('css/material.min.css') }}
    
    @yield('extra-css')

  </head>
  <!-- #ENDS# Header -->

  <body class="fixed-sn white-skin">
    
    @include('admin.layouts.loader')
    
    <!--Double navigation-->
    <header>
        @include('admin.layouts.topbar')
        @include('admin.layouts.navigation')
    </header>
    <!--/.Double navigation-->


    
    <!--Main layout-->
    <main>

        <!-- Content -->
            @yield('content')
        <!-- #ENDS# Content -->
        
    </main>
    <!--/Main layout-->

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

    <!-- Autosize Plugin Js -->
    {{Html::script('plugins/autosize/autosize.js')}}

    <!-- Jquery Spinner Plugin Js -->
    {{Html::script('plugins/jquery-spinner/js/jquery.spinner.js')}}

    <!-- Jqurey Datatable Js -->
    {{Html::script('plugins/material-addons/js/datatables.min.js') }}

    <!-- TinyMCE -->
    {{Html::script('plugins/tinymce/tinymce.min.js')}}

    <!-- MDB core JavaScript -->
    {{Html::script('js/material.min.js')}}

    <!-- Custom JavaScript -->
    {{Html::script('js/script.js')}}

    @yield('extra-script')


    <script>

         // SideNav Initialization
        $(".button-collapse").sideNav();
        
        new WOW().init();
    
    </script>

  </body>

</html>

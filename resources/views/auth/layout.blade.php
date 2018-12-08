<!DOCTYPE html>
<html lang="en">

  <!-- Header -->
  <head>
    @include('layouts.partials.meta')

    <!-- Favicon-->
    <link rel="icon" href="https://cdn.appstorm.net/mac.appstorm.net/files/2012/07/icon4.png"/>

    <title>@yield('title') আমার নেতা || আপনার নেতাদের সাথে সংযোগ স্থাপন করুন</title>

    <!-- Font Awesome -->
    {{ Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}

    <!-- Google Icons -->
    {{ Html::style('https://fonts.googleapis.com/icon?family=Material+Icons') }}

    <!-- Bootstrap core CSS -->
    {{ Html::style('css/bootstrap.min.css') }}

    <!-- Material Design Bootstrap -->
    {{ Html::style('css/material.min.css') }}

    <!-- Custom styles for this template -->
    {{ Html::style('css/style.css') }}

  	@yield('extra-style')

  </head>
  <!-- #ENDS# Header -->

  <body>
    
    @include('layouts.partials.loader')
      
    <!-- Content -->
    @yield('content')
    <!-- #ENDS# Content -->

    <!-- Footer -->
    <footer class="page-footer font-small pt-4 mt-4 green">
        <!--Footer Links-->
        <div class="container container-fluid text-center text-md-left">
            <div class="row">

                <!--First column-->
                <div class="col-md-6">
                    <h5 class="font-weight-bold"><span class="red-text"><i class="fa fa-certificate fa-sm pr-2" aria-hidden="true"></i></span>আমারনেতা</h5>
                    <p>আপনার নেতাদের সাথে সংযোগ স্থাপন করুন</p>
                </div>
                <!--/.First column-->

                <!--Second column-->
                <div class="col-md-3">
                    <h5 class="text-uppercase">About Us</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">News</a>
                        </li>
                        <li>
                            <a href="#!">How to</a>
                        </li>
                        <li>
                            <a href="#!">FAQ</a>
                        </li>
                        <li>
                            <a href="#!">Terms &#38; Conditions</a>
                        </li>
                    </ul>
                </div>
                <!--/.Second column-->

                <!--Third column-->
                <div class="col-md-3">
                    <h5 class="text-uppercase">Contact</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#!"><i class="fa fa-phone fa-sm pr-2" aria-hidden="true"></i>01712423414</a>
                        </li>
                        <li>
                            <a href="#!"><i class="fa fa-envelope fa-sm pr-2" aria-hidden="true"></i>bappychanting@outlook.com</a>
                        </li>
                    </ul>
                    <div class="my-3">
                        <!--Facebook-->
                        <a type="button" class="btn-social btn-sm btn-fb mr-3"><i class="fa fa-facebook"></i></a>
                        <!--Twitter-->
                        <a type="button" class="btn-social btn-sm btn-tw mr-3"><i class="fa fa-twitter"></i></a>
                        <!--Google +-->
                        <a type="button" class="btn-social btn-sm btn-gplus mr-3"><i class="fa fa-google-plus"></i></a>
                        <!--Youtube-->
                        <a type="button" class="btn-social btn-sm btn-yt mr-3"><i class="fa fa-youtube"></i></a>   
                    </div>                 
                </div>
                <!--/.Second column-->
            </div>
        </div>
        <!--/.Footer Links-->

        <!--Copyright-->
        <div class="footer-copyright py-3 text-center">
            &copy;  কপিরাইট {{ date('Y') }}:
            <a href="https://mdbootstrap.com/material-design-for-bootstrap/"> আমারনেতা  </a>
        </div>
    </footer>
    

    <!-- Javascript -->

    <!-- Bootstrap core JavaScript -->
    {{Html::script('js/jquery.min.js')}}
    {{Html::script('js/jquery.form.js')}}

    <!-- Bootstrap tooltips -->
    {{Html::script('js/popper.min.js')}}

    <!-- Bootstrap core JavaScript -->
    {{Html::script('js/bootstrap.min.js')}}

    <!-- MDB core JavaScript -->
    {{Html::script('js/material.min.js')}}

    <!-- Custom JavaScript -->
    <script>
        $( window ).resize(function() {
            // Align footer on windows resize
          footerAlign();
        });
        $(document).ready(function(){
                // Align footer
            footerAlign();

                // Set when the loading screen will stop
            setTimeout(function () { $('.page-loader-wrapper').fadeOut(); }, 50);
        });
        function footerAlign() {
          $('footer').css('display', 'block');
          $('footer').css('height', 'auto');
          var footerHeight = $('footer').outerHeight();
          $('body').css('padding-bottom', footerHeight);
          $('footer').css('height', footerHeight);
        }
    </script>

  	@yield('extra-script')

  </body>

</html>

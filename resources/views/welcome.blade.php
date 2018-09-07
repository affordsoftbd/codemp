<!DOCTYPE html>
<html lang="en">

  <!-- Header -->
  <head>
    @include('layouts.partials.meta')

    <!-- Favicon-->
    <link rel="icon" href="https://cdn.appstorm.net/mac.appstorm.net/files/2012/07/icon4.png"/>

    <title>@yield('title') আমার নেতা || আপনার নেতাকে খুঁজে বের করুন</title>

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
    
    <style>
        .intro-2 {
          background: 
            linear-gradient(45deg, rgba(0, 120, 0, 0.8), rgba(120, 0, 0, 0.8) 100%),
            url("https://i.imgur.com/x707Z9F.jpg")no-repeat center center;
            background-size: cover;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        a {
            color: green;
        }

        /* mouse over link */
        a:hover {
            color: red;
        }
        .card-home {
            background-color: rgba(229, 228, 255, 0.2);
        }
        .card-home .md-form .prefix {
            font-size: 1.5rem;
            margin-top: 1rem;
        }
        .card-home .md-form label {
            color: #ffffff;
        }
        .card-home a {
            color: #e6e6e6;
        }
        .classic-tabs .nav.home-tabs li a.active {
            border-color: #ff0000;
        }
        .classic-tabs .nav li a.active {
            border-bottom: 3px solid;
            color: #ff0000;
        }
        .classic-tabs .nav li a {
            display: block;
            padding: 20px 24px;
            font-size: 13px;
            text-transform: uppercase;
            color: #008000;
            text-align: center;
            -webkit-border-radius: 0;
            border-radius: 0;
        }
        .breadcrumb{
            border-radius: .0rem;
            list-style: none;
        }
        .bc-icons .breadcrumb-item + .breadcrumb-item::before {
            content: none; 
        }
        .switch label input[type=checkbox]:checked+.lever:after {
            background-color: red;
        }
    </style>

  </head>
  <!-- #ENDS# Header -->

  <body>
    
    @include('layouts.partials.loader')

    <div class="green z-depth-1">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    
                </div>
                <div class="col-md-2">
                    <div class="switch">
                      <label>
                        <span class="white-text">Ban</span>
                        <input type="checkbox">
                        <span class="lever"></span>
                        <span class="white-text">Eng</span>
                      </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <!--Facebook-->
                        <button type="button" class="btn btn-sm btn-fb"><i class="fa fa-facebook"></i></button>
                        <!--Twitter-->
                        <button type="button" class="btn btn-sm btn-tw"><i class="fa fa-twitter"></i></button>
                        <!--Google +-->
                        <button type="button" class="btn btn-sm btn-gplus"><i class="fa fa-google-plus"></i></button>
                    </div>
                    <!-- <h6 class="float-right mx-4 white-text"><span class="badge indigo">New</span> ENG</h6> -->
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-4">
                <a href="{{ route('welcome') }}">
                    <img src="https://adminpanelproject.000webhostapp.com/amarneta/img/icons/favicon.png" height="50" alt="Logo">
                </a>
            </div>
            <div class="col-md-8">
                <div class="classic-tabs float-right">
                    <!-- Nav tabs -->
                    <div class="tabs-wrapper">
                        <ul class="nav home-tabs" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link waves-light {{ Route::is('login') || Route::is('welcome') ? 'active':'' }}" href="{{ route('welcome') }}" role="tab">সূচক</a>
                            </li><li class="nav-item">
                              <a class="nav-link waves-light {{ Route::is('register*') ? 'active':'' }}" href="{{ route('register.public') }}" role="tab"> রেজিস্টার</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
      
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
                    <h5><i class="fa fa-shopping-bag fa-sm pr-2" aria-hidden="true"></i>আমারনেতা</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
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
                    <!--Facebook-->
                    <a type="button" class="btn-social btn-sm btn-fb mr-3"><i class="fa fa-facebook"></i></a>
                    <!--Twitter-->
                    <a type="button" class="btn-social btn-sm btn-tw mr-3"><i class="fa fa-twitter"></i></a>
                    <!--Google +-->
                    <a type="button" class="btn-social btn-sm btn-gplus mr-3"><i class="fa fa-google-plus"></i></a>
                    <!--Youtube-->
                    <a type="button" class="btn-social btn-sm btn-yt mr-3"><i class="fa fa-youtube"></i></a>                    
                </div>
                <!--/.Second column-->
            </div>
        </div>
        <!--/.Footer Links-->

        <!--Copyright-->
        <div class="footer-copyright py-3 text-center">
            &copy;  কপিরাইট 2018:
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
        $(document).ready(function() {
           $('.mdb-select').material_select();
         });
    </script>

  </body>

</html>

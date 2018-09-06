<!DOCTYPE html>
<html lang="en">

  <!-- Header -->
  <head>
    @include('layouts.partials.meta')

    <!-- Favicon-->
    <link rel="icon" href="{!! asset('favicon.png') !!}"/>

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
        .card-home {
            background-color: rgba(229, 228, 255, 0.2);
        }
        .md-form .prefix {
            font-size: 1.5rem;
            margin-top: 1rem;
        }
        .md-form label {
            color: #ffffff;
        }
        a {
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
    </style>

  </head>
  <!-- #ENDS# Header -->

  <body>
    
    @include('layouts.partials.loader')

    <div class="green z-depth-1">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    
                </div>
                <div class="col-md-6">
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
        <div class="row">
            <div class="col-md-4">
                <img src="https://adminpanelproject.000webhostapp.com/amarneta/img/icons/favicon.png" height="50" alt="">
            </div>
            <div class="col-md-8">
                <div class="classic-tabs float-right">
                    <!-- Nav tabs -->
                    <div class="tabs-wrapper">
                        <ul class="nav home-tabs" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link waves-light active" data-toggle="tab" href="#panel1001" role="tab">সূচক</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link waves-light" data-toggle="tab" href="#panel1002" role="tab">সমর্থক হিসেবে রেজিস্টার</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link waves-light" data-toggle="tab" href="#panel1003" role="tab">নেতা/কর্মী হিসেবে রেজিস্টার</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="intro-2">
    <div class="container mb-5">
    <div class="row">
        <div class="col-md-6">
            <h1 class="display-5 font-weight-bold white-text mt-5">A Warm Welcome!</h1><hr class="hr-light">
            <p class="lead white-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
        </div>
        <div class="col-md-6">
            <div class="card card-home wow h-100" data-wow-delay="0.3s">
                <div class="card-body">
                    <div class="md-form">
                        <form action="messaging.php">
                            <div class="text-center">
                              <h3 class="white-text"><i class="fa fa-user white-text fa-sm pr-2"></i>লগইন</h3>
                              <hr class="hr-light">
                            </div>
                          <!-- Material input text -->
                            <div class="md-form">
                              <i class="fa fa-envelope prefix white-text"></i>
                              <input class="form-control" id="identity" name="identity_kormi" type="text">
                              <label for="identity">আপনার নাম</label>
                            </div>
                          
                          <!-- Material input password -->
                            <div class="md-form">
                              <i class="fa fa-lock prefix white-text"></i>
                              <input class="form-control" id="password" name="password_kormi" type="password" value="">
                              <label for="password">আপনার পাসওয়ার্ড</label>
                            </div>

                            <div class="text-center mt-4">
                            <input class="btn btn-danger" type="submit" value="লগ ইন">
                            </div>

                            <p class="font-small font-weight-bold white-text text-right d-flex justify-content-center mb-3 pt-2"> অথবা লগ ইন সঙ্গে</p>

                            <div class="row my-3 d-flex justify-content-center">
                                <!--Facebook-->
                                <button type="button" class="btn btn-white btn-rounded mr-md-3 z-depth-1a"><i class="fa fa-facebook blue-text text-center"></i></button>
                                <!--Twitter-->
                                <button type="button" class="btn btn-white btn-rounded mr-md-3 z-depth-1a"><i class="fa fa-twitter cyan-text"></i></button>
                                <!--Google +-->
                                <button type="button" class="btn btn-white btn-rounded z-depth-1a"><i class="fa fa-google-plus red-text"></i></button>
                            </div>
                            <p class="mt-3 text-right"><a href="http://localhost:8000/password/reset">পাসওয়ার্ড ভুলে গেছেন?</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- /.container -->

    <!-- Content section -->
    <section class="py-5">
      <div class="container">
        <h1>Section Heading</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, suscipit, rerum quos facilis repellat architecto commodi officia atque nemo facere eum non illo voluptatem quae delectus odit vel itaque amet.</p>
      </div>
    </section>

    <div class="card-group">
        <div class="card green accent-4">
            <div class="card-body text-center">
                <h1 class="white-text"><i class="fa fa-address-book" aria-hidden="true"></i></h1>
                <h4 class="font-weight-bold white-text">Share Yourself</h4>
                <p class="white-text">This is a wider panel with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
        </div>
        <div class="card teal">
            <div class="card-body text-center">
                <h1 class="white-text"><i class="fa fa-child" aria-hidden="true"></i></h1>
                <h4 class="font-weight-bold white-text">Rasie Followers</h4>
                <p class="white-text">This panel has supporting text below as a natural lead-in to additional content.</p>
            </div>
        </div>
        <div class="card red accent-4">
            <div class="card-body text-center">
                <h1 class="white-text"><i class="fa fa-comments" aria-hidden="true"></i></h1>
                <h4 class="font-weight-bold white-text">Talk With People</h4>
                <p class="white-text">This is a wider panel with supporting text below as a natural lead-in to additional content. This panel has even longer content than the first to show that equal height action.</p>
            </div>
        </div>
    </div>

    <!-- Content section -->
    <section class="py-5">
      <div class="container">
        <h1>Section Heading</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, suscipit, rerum quos facilis repellat architecto commodi officia atque nemo facere eum non illo voluptatem quae delectus odit vel itaque amet.</p>
      </div>
    </section>

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
    </script>


  </body>

</html>

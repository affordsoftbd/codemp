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
            background-image: linear-gradient(#ffffff, #f2f2f2);
            /*background: linear-gradient(45deg, rgba(0, 120, 0, 0.8), rgba(120, 0, 0, 0.8) 100%),
            url("https://i.imgur.com/x707Z9F.jpg")no-repeat center center;*/
            background-size: cover;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .p2p {
          max-width: 100%;
          height: auto;
        }

        a {
            color: green;
        }

        /* mouse over link */
        a:hover {
            color: red;
        }
        /*.card-home {
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
        }*/
    </style>

  </head>
  <!-- #ENDS# Header -->

  <body>
    
    @include('layouts.partials.loader')

    <nav class="navbar navbar-expand-lg navbar-dark green">

        <div class="container container-fluid">
        
            <a class="navbar-brand" href="javascript:;;"><i class="fa fa-certificate fa-sm pr-2" aria-hidden="true"></i>আমারনেতা</a>
            <form class="form-inline" method="post" action="{{ route('retry') }}">
                {{ csrf_field() }}
                <div class="md-form mt-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="আপনার নাম">
                </div>
                <div class="md-form mt-0">
                    <input class="form-control mr-sm-2" type="password" placeholder="আপনার পাসওয়ার্ড">
                </div>
                <button class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3" type="submit">লগ ইন</button>
                <a class="white-text ml-3" href="javascript:;;">পাসওয়ার্ড ভুলে গেছেন?</a>
            </form>

        </div>

    </nav>
     

    <!-- Page Content -->
    <div class="intro-2">
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="display-5 font-weight-bold mt-5 green-text">A Warm Welcome!</h1><hr>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
                    {{ HTML::image('img/p2p.png', 'Peer to peer', array('class' => 'p2p img-responsive my-5')) }}
                </div>
                <div class="col-md-6">
                    <div class="card card-home wow h-100" data-wow-delay="0.3s">
                        <div class="card-body">

                            <h5 class="red-text"><i class="fa fa-edit fa-sm pr-2" aria-hidden="true"></i>রেজিস্টার করুন</h5><hr>

                                <div class="alert alert-success" id="login_success" style="display:none"></div>
                                <div class="alert alert-danger" id="login_danger" style="display:none"></div>

                                <form id="registration_form" class="login-form" method="post" action="">
                                {{ csrf_field() }}

                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <!-- First name -->
                                        <div class="md-form">
                                            <input type="text" name="first_name" id="first_name" class="form-control">
                                            <label for="firstname">নামের প্রথম অংশ</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Last name -->
                                        <div class="md-form">
                                            <input type="text" name="last_name" id="last_name" class="form-control">
                                            <label for="lastname">নামের শেষাংশ</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- Phone number -->
                                        <div class="md-form">
                                            <input type="text" name="username" id="username" class="form-control" aria-describedby="materialRegisterFormPhoneHelpBlock">
                                            <label for="username">ইউসার নাম</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- E-mail -->
                                        <div class="md-form">
                                            <input type="email" name="email" id="email" class="form-control">
                                            <label for="email">ই-মেইল</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- Phone number -->
                                        <div class="md-form">
                                            <input type="text" name="phone" id="phone" class="form-control" aria-describedby="materialRegisterFormPhoneHelpBlock">
                                            <label for="phone">ফোন নম্বর</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- Phone number -->
                                        <div class="md-form">
                                            <input type="text" name="nid" id="nid" class="form-control">
                                            <label for="nid">জাতীয় আইডি</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- Choose Division -->
                                        <select class="mdb-select" name="division" id="division">
                                            <option value="" disabled selected>আপনার বিভাগ</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- Choose District -->
                                        <select class="mdb-select" name="district" id="district" searchable="এখানে অনুসন্ধান করুন">
                                            <option value="" disabled selected>আপনার জেলা</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- Choose Thana -->
                                        <select class="mdb-select" name="thana" id="thana" searchable="এখানে অনুসন্ধান করুন">
                                            <option value="" disabled selected>আপনার থানা</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- Choose Zip -->
                                        <select class="mdb-select" name="zip" id="zip" searchable="এখানে অনুসন্ধান করুন">
                                            <option value="" disabled selected>আপনার জিপ</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- Choose Role -->
                                        <select class="mdb-select" name="role_id" id="role_id">
                                            <option value="" disabled selected>আপনার রাজনৈতিক দল</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        
                                        <a href="javascript:void(0)" class="pull-right">নতুন রাজনৈতিক দল যোগ করুন</a>

                                    </div>
                                    <div class="col-sm-12">
                                        <div class="md-form">
                                            <textarea type="text" name="address" id="address" class="md-textarea form-control" rows="2"></textarea>
                                            <label for="address">ঠিকানা</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="md-form">
                                            <input type="password" name="password" id="password" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
                                            <label for="password">পাসওয়ার্ড</label>
                                            <small id="password" class="form-text text-muted mb-4">
                                                অন্ততপক্ষে ৮টি বা আরও অক্ষর এবং ১ সংখ্যা
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Confirm Password -->
                                        <div class="md-form">
                                            <input type="password" name="password_confirm" id="password_confirm" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
                                            <label for="password_confirm">পাসওয়ার্ড নিশ্চিত করুন</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sign up button -->
                                <button class="btn btn-outline-danger btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">রেজিস্টার</button>

                                <hr>
                                <center>
                                <!-- Terms of service -->
                                <p><em>রেজিস্টার</em> 
                                    ক্লিক এর আগে আপনি আমাদের
                                    <a href="" target="_blank">terms of service</a> মেনে নিচ্ছেন</p>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
      
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
                    <h5><i class="fa fa-certificate fa-sm pr-2" aria-hidden="true"></i>আমারনেতা</h5>
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

            $('#division').material_select();
            $('#district').material_select();
            $('#thana').material_select();
            $('#zip').material_select();
            $('#role_id').material_select();

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

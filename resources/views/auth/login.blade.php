@extends('welcome')

@section('content')    
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
                                <a type="button" class="btn-floating btn-fb btn-sm">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a type="button" class="btn-floating btn-tw btn-sm">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a type="button" class="btn-floating btn-li btn-sm">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </div>

                            <div class="row mt-3">
                                <div class="col-xl-8 col-md-8 col-sm-6 col-xs-6 col-6">
                                    <a href="http://localhost:8000/register">রেজিস্টার</a>
                                </div>
                                <div class="col-xl-4 col-md-4 col-sm-6 col-xs-6 col-6 text-right">
                                    <a href="http://localhost:8000/password/reset">পাসওয়ার্ড ভুলে গেছেন?</a>
                                </div>
                              </div>
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

@endsection

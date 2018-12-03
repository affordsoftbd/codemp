@extends('auth.layout')

@section('title', "পাসওয়ার্ড রিসেট || ")

@section('content')    

    <nav class="navbar navbar-expand-lg navbar-dark green">

        <div class="container container-fluid">
        
            <a class="navbar-brand" href="{{ route('welcome') }}"><span class="yellow-text"><i class="fa fa-certificate fa-sm pr-2" aria-hidden="true"></i></span>আমারনেতা</a>

        </div>

    </nav>

    <!-- Material form retry -->
    <div class="container">

        <div class="card my-5 mx-5">

        <!--Card content-->
            <div class="card-body px-lg-5 pt-0 my-5">

                <h4 class="green-text"><i class="fa fa-hand-o-right fa-sm pr-2" aria-hidden="true"></i>পাসওয়ার্ড রিসেট করুন!</h4><hr>

                <form class="login-form" methpd="get" action="{{ route('welcome') }}">
                                {{ csrf_field() }}
                    <!-- Confirm Password -->
                    <div class="md-form">
                        <i class="fa fa-lock prefix red-text"></i>
                        <input type="password" name="password" id="password" class="form-control">
                        <label for="password">পাসওয়ার্ড</label>
                    </div>
                    <!-- Confirm Password -->
                    <div class="md-form">
                        <i class="fa fa-lock prefix red-text"></i>
                        <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                        <label for="password_confirm">পাসওয়ার্ড নিশ্চিত করুন</label>
                    </div>
                    <div class="text-center mt-4">
                        <input class="btn btn-danger btn-sm" type="submit" value="রিসেট">
                    </div>
                </form>
                <!-- Form -->

            </div>

        </div>

    </div>



@endsection

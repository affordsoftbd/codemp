@extends('auth.layout')

@section('title', "পুনরুদ্ধার || ")

@section('content')    

<nav class="navbar navbar-expand-lg navbar-dark green">

    <div class="container container-fluid">
    
        <a class="navbar-brand" href="{{ route('welcome') }}"><i class="fa fa-certificate fa-sm pr-2" aria-hidden="true"></i>আমারনেতা</a>

    </div>

</nav>

 <!-- Material form retry -->
    <div class="container">

        <div class="card my-5 mx-5">

        <!--Card content-->
            <div class="card-body px-lg-5 pt-0 my-5">

                <h4 class="green-text"><i class="fa fa-gears fa-sm pr-2" aria-hidden="true"></i>অ্যাকাউন্ট পুনরুদ্ধার করতে আপনার ইমেল লিখুন</h4><hr>

                <form class="login-form" method="post" action="{{ route('reset') }}">
                                {{ csrf_field() }}
                    <!-- Confirm Password -->
                    <div class="md-form">
                        <i class="fa fa-envelope prefix green-text"></i>
                        <input type="email" name="email" id="email" class="form-control">
                        <label for="email">আপনার ইমেইল</label>
                    </div>
                    <div class="text-center mt-4">
                        <input class="btn btn-danger btn-sm" type="submit" value="সাবমিট">
                    </div>
                </form>
                <!-- Form -->

            </div>

        </div>

    </div>

@endsection
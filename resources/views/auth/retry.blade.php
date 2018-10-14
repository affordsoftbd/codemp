@extends('auth.layout')

@section('title', "পুনরায় চেষ্টা  || ")

@section('extra-style')
    <style>
        .avatar {
          	max-width: 50%;
          	height: auto;
        }
    </style>
@endsection

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

	            <h4 class="green-text text-center"><i class="fa fa-hand-o-right fa-sm pr-2" aria-hidden="true"></i>মাহাদি হাসান হিসাবে লগ ইন করুন!</h4><hr>

	            <center>
	            	{{ Html::image('img/avatar.png', 'Mahadi Hasan', array('class' => 'avatar img-fluid z-depth-1 my-5')) }}
	        	</center>

	            <form class="login-form" method="post" action="">
                    <!-- Confirm Password -->
                    <div class="md-form">
                        <input type="password" name="password_confirm" id="password_confirm" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
                        <label for="password_confirm">পাসওয়ার্ড নিশ্চিত করুন</label>
                    </div>
                    <button type="button" class="btn btn-lg btn-primary" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>
	            </form>
	            <!-- Form -->

            </div>

        </div>

    </div>

@endsection

@section('extra-script')
    <script>
        $(document).ready(function(){

    		// popovers Initialization
			$(function () {
			    $('.example-popover').popover({
			        container: 'body'
			    })
			})
			
        });
    </script>
@endsection
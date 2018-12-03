@extends('auth.layout')

@section('title', "পুনরায় চেষ্টা  || ")

@section('extra-style')
    <style>
        .avatar {
          	max-width: 50%;
          	height: auto;
        }
		.popover-header {
		    color:  #ffffff;
		    background-color: #ff0000;
		}
		.popover-body {
		    color: #ffffff;
		    background-color: #ff6666;
		}
    </style>
@endsection

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

	            <h4 class="green-text text-center"><i class="fa fa-hand-o-right fa-sm pr-2" aria-hidden="true"></i>মাহাদি হাসান হিসাবে লগ ইন!</h4><hr>

	            <center>
	            	{{ Html::image('img/avatar.png', 'Mahadi Hasan', array('class' => 'avatar img-fluid z-depth-1 my-5')) }}
	        	</center>

	            <form class="login-form" method="post" action="">
                                {{ csrf_field() }}
                    <!-- Confirm Password -->
                    <div class="md-form">
                        <i class="fa fa-lock prefix red-text"></i>
						<input type="password" name="password_confirm" id="password_confirm" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" data-toggle="popover" data-placement="right" title="ভুল পাসওয়ার্ড"
						data-content="আপনি যে পাসওয়ার্ডটি প্রবেশ করেছেন সেটি ভুল!">
                        <label for="password_confirm">পাসওয়ার্ড নিশ্চিত করুন</label>
                    </div>
                    <div class="text-center mt-4">
                        <input class="btn btn-danger btn-sm" type="submit" value="লগ ইন">
                    </div>
                    <div class="text-center mt-4">
                    	<a href="{{ route('recovery') }}">পাসওয়ার্ড রিসেট করতে এখানে ক্লিক করুন</a>
                    </div>
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
			    $('[data-toggle="popover"]').popover('show');
			});
			
        });
    </script>
@endsection
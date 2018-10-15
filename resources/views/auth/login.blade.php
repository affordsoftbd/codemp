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
	    
	        <a class="navbar-brand" href="{{ route('welcome') }}"><i class="fa fa-certificate fa-sm pr-2" aria-hidden="true"></i>আমারনেতা</a>

	    </div>

	</nav>

    <!-- Material form retry -->
    <div class="container">

        <div class="card my-5 mx-5">

        <!--Card content-->
        	<div class="card-body px-lg-5 pt-0 my-5">

	            <h4 class="green-text"><i class="fa fa-sign-in fa-sm pr-2" aria-hidden="true"></i>আমার নেতা লগ ইন!</h4><hr>

	            <form class="login-form" method="post" action="">
                                {{ csrf_field() }}

                     <!-- Confirm Email -->
                    <div class="md-form">
                        <i class="fa fa-envelope prefix red-text"></i>
                        <input type="text" name="email" id="email" class="form-control" data-toggle="popover" data-placement="right" title="ভুল লগইন ক্রেডেনশিয়াল" data-content="আপনার প্রদত্ত লগইন ক্রেডেনশিয়াল খুঁজে পাওয়া  যাচ্ছে না!">
                        <label for="email">ইমেইল নিশ্চিত করুন</label>
                    </div>

                    <!-- Confirm Password -->
                    <div class="md-form">
                        <i class="fa fa-lock prefix red-text"></i>
						<input type="password" name="password_confirm" id="password_confirm" class="form-control">
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
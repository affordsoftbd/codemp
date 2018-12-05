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
	    
	        <a class="navbar-brand font-weight-bold" href="{{ route('welcome') }}"><span class="yellow-text"><i class="fa fa-certificate fa-sm pr-2" aria-hidden="true"></i></span>আমারনেতা</a>

	    </div>

	</nav>

    <!-- Material form retry -->
    <div class="container">

        <div class="card my-5 mx-5">

        <!--Card content-->
        	<div class="card-body px-lg-5 pt-0 my-5">

	            <h4 class="green-text"><i class="fa fa-sign-in fa-sm pr-2" aria-hidden="true"></i>আমার নেতা লগ ইন!</h4><hr>

	            <form class="login-form" method="post" action="{{ route('postLogin') }}">
                                {{ csrf_field() }}
                    <div data-toggle="popover" data-placement="top" title="ভুল লগইন ক্রেডেনশিয়াল" data-content="আপনার প্রদত্ত লগইন ক্রেডেনশিয়াল খুঁজে পাওয়া  যাচ্ছে না!"></div>
                     <!-- Confirm Email -->
                    <div class="md-form">
                        <i class="fa fa-envelope prefix red-text"></i>
                        <input type="text" name="username" id="username" class="form-control">
                        <label for="username">ইমেইল নিশ্চিত করুন</label>
                    </div>
                    <!-- Confirm Password -->
                    <div class="md-form">
                        <i class="fa fa-lock prefix red-text"></i>
						<input type="password" name="password" id="password" class="form-control">
                        <label for="password">পাসওয়ার্ড নিশ্চিত করুন</label>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-sign-in pr-2"></i>লগ ইন</button>
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
                @if(isset($_GET['res']))
			    $('[data-toggle="popover"]').popover('show');
                @endif
                setTimeout(function(){
                    $('[data-toggle="popover"]').popover('hide');
                },3000)
			});
			
        });
    </script>
@endsection
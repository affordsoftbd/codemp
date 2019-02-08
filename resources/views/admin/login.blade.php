<!DOCTYPE html>
<html lang="en">

  <!-- Header -->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon-->
    <link rel="icon" href="{{{ asset('favicon.png') }}}"/"/>

    <title>অ্যাডমিন সাইন ইন || আমার নেতা || আপনার নেতাদের সাথে সংযোগ স্থাপন করুন</title>

    <!-- Font Awesome -->
    {{ Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}

    <!-- Bootstrap core CSS -->
    {{ Html::style('css/bootstrap.min.css') }}

    <!-- Material Design Bootstrap -->
    {{ Html::style('css/material.min.css') }}

    <style>
	    a {
	    	color: green;
		}

		a:hover {
		    color: red;
		}
	</style>

  </head>
  <!-- #ENDS# Header -->

  <body class="success-color-dark">
      
    <center>
        <a href="{{ route('welcome') }}">
        	{{ Html::image('img/amarneta.png', 'Amar Neta Logo', array('class' => 'mt-5', 'width' => '292', 'height' => '80')) }}
    	</a>
    </center>

    <!-- Material form retry -->
    <div class="container">

        <div class="card my-5 mx-5">

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0 my-5">

	            <h4 class="green-text">
                    <i class="fa fa-sign-in fa-sm pr-2" aria-hidden="true"></i>অ্যাডমিন সাইন ইন!
                </h4>
                <hr>

	            <form class="login-form" method="post" action="javascript:void(0);">
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
                    	<a href="javascript:void(0);">পাসওয়ার্ড রিসেট করতে এখানে ক্লিক করুন</a>
                    </div>
	            </form>
	            <!-- Form -->

            </div>

        </div>

    </div>
    

    <!-- Javascript -->

    <!-- Bootstrap core JavaScript -->
    {{Html::script('js/jquery.min.js')}}

    <!-- Bootstrap tooltips -->
    {{Html::script('js/popper.min.js')}}

    <!-- Bootstrap core JavaScript -->
    {{Html::script('js/bootstrap.min.js')}}

    <!-- MDB core JavaScript -->
    {{Html::script('js/material.min.js')}}

  </body>

</html>

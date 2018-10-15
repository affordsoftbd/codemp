@extends('auth.layout')

@section('extra-style')
    <style>
        .intro-2 {
            background-image: linear-gradient(#ffffff, #f2f2f2);
            background-size: cover;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .p2p {
          max-width: 100%;
          height: auto;
        }
    </style>
@endsection

@section('content')    

    <nav class="navbar navbar-expand-lg navbar-dark green">

        <div class="container container-fluid">
        
            <a class="navbar-brand" href="javascript:void(0)"><i class="fa fa-certificate fa-sm pr-2" aria-hidden="true"></i>আমারনেতা</a>
            <form class="form-inline" method="post" action="{{ route('retry') }}">
                {{ csrf_field() }}
                <div class="md-form mt-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="আপনার ই-মেইল">
                </div>
                <div class="md-form mt-0">
                    <input class="form-control mr-sm-2" type="password" placeholder="আপনার পাসওয়ার্ড">
                </div>
                <button class="btn btn-outline-white btn-md my-2 my-sm-0 mx-3" type="submit">লগ ইন</button>
                <a class="white-text" href="{{ route('recovery') }}">পাসওয়ার্ড ভুলে গেছেন?</a>
            </form>

        </div>

    </nav>
     

    <!-- Page Content -->
    <div class="intro-2">
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="display-5 font-weight-bold green-text">আপনাকে স্বাগতম!</h1><hr>
                    <!-- <p class="red-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p> -->
                    {{ Html::image('img/p2p.png', 'Peer to peer', array('class' => 'p2p img-responsive my-5')) }}
                </div>
                <div class="col-md-6">
                    <div class="card wow h-100" data-wow-delay="0.3s">
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
                                        <select class="mdb-select" name="party_id" id="party_id">
                                            <option value="" disabled selected>আপনার রাজনৈতিক দল</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                        </select>
                                    </div>
                                    <!-- 
                                    <div class="col-sm-12">
                                        <a href="javascript:void(0)" class="pull-right"><i class="fa fa-hand-o-right fa-sm pr-2" aria-hidden="true"></i>নতুন রাজনৈতিক দল যোগ করুন</a>
                                    </div> 
                                    -->
                                    <div class="col-sm-12">
                                        <!-- Choose Role -->
                                        <select class="mdb-select" name="role_id" id="role_id">
                                            <option value="" disabled selected>আপনি কি হিসাবে নিবন্ধন করতে চান?</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                            <option value="0">Division 1</option>
                                        </select>
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

                                <div class="col-sm-12">                                
                                    {{ Html::image('https://developers.google.com/recaptcha/images/newCaptchaAnchor.gif', 'Captcha', array('class' => 'img-fluid my-3 mx-5', 'height' => '300', 'width' => '300')) }}
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

@endsection

@section('extra-script')
    <script>
        $(document).ready(function(){
            $('#division').material_select();
            $('#district').material_select();
            $('#thana').material_select();
            $('#zip').material_select();
            $('#party_id').material_select();
            $('#role_id').material_select();
        });

        $(document).on('submit', '#login_form', function(event){
            event.preventDefault();
            var username = $('#username').val();
            var password = $('#password').val();
            var validate = '';

            if(username==''){
                validate = validate+"username is required</br>";
            }

            if(password==''){
                validate = validate+"password is required";
            }

            if(validate==''){

                var formData = new FormData($('#login_form')[0]);
                var url = '{{ url('login') }}';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    async: false,
                    success: function (data) {
                        if(data.status == 200){
                            window.location.href="{{ url('/home') }}";
                        }
                        else{
                            $('#login_success').hide();
                            $('#login_danger').show();
                            $('#login_danger').html(data.reason);
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
            else{
                $('#login_success').hide();
                $('#login_danger').show();
                $('#login_danger').html(validate);
            }
        });
    </script>
@endsection

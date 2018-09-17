@extends('welcome')

@section('title', "রেজিস্টার || ")

@section('content')

    <div class="bc-icons green">
        <div class="container">
            <ol class="breadcrumb green">
                <li class="breadcrumb-item"><i class="fa fa-hand-o-right mr-2 white-text" aria-hidden="true"></i><a class="white-text" href="#">রেজিস্টার</a></li>
                <li class="breadcrumb-item active"><i class="fa fa-hand-o-right mx-2 white-text" aria-hidden="true"></i><a class="white-text" href="#">সমর্থক হিসেবে রেজিস্টার</a></li>
            </ol>
        </div>
    </div>

    <!-- Material form register -->
    <div class="container">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs md-tabs nav-justified red my-5 mx-5" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0)" role="tab">
                সমর্থক হিসেবে রেজিস্টার</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register.politician') }}" role="tab">
                নেতা/কর্মী হিসেবে রেজিস্টার</a>
            </li>
        </ul>
        <!-- Nav tabs -->

        <div class="card my-5 mx-5">

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0 my-5">

            <h5 class="green-text"><i class="fa fa-edit fa-sm pr-2" aria-hidden="true"></i>নীচের ঘরগুলোতে প্রয়োজনীয় তথ্য দিয়ে সাবমিট করুন</h5><hr>
            
            <!-- Form -->
            <div class="alert alert-success" id="success_message" style="display:none"></div>
            <div class="alert alert-danger" id="error_message" style="display:none"></div>

            <form id="registration_form" class="login-form" method="post" action="">
                {{ csrf_field() }}
                <input type="hidden" name="role_id" id="role_id" value="1">
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
                    <div class="col-sm-6">
                        <!-- E-mail -->
                        <div class="md-form">
                            <input type="text" name="email" id="email" class="form-control">
                            <label for="email">ই-মেইল</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- Phone number -->
                        <div class="md-form">
                            <input type="text" name="phone" id="phone" class="form-control" aria-describedby="materialRegisterFormPhoneHelpBlock">
                            <label for="phone">ফোন নম্বর</label>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="form-row">
                    <div class="col-sm-6">
                        <div class="md-form">
                            <textarea type="text" name="address" id="address" class="md-textarea form-control" rows="2"></textarea>
                            <label for="address">ঠিকানা</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- Phone number -->
                        <div class="md-form">
                            <input type="text" name="username" id="username" class="form-control" aria-describedby="materialRegisterFormPhoneHelpBlock">
                            <label for="phone">ইউসার নাম</label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
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

                <!-- Social register -->
                <p>অথবা রেজিস্টার করুন:</p>

                <a type="button" class="btn-floating btn-fb btn-sm">
                    <i class="fa fa-facebook"></i>
                </a>
                <a type="button" class="btn-floating btn-tw btn-sm">
                    <i class="fa fa-twitter"></i>
                </a>
                <a type="button" class="btn-floating btn-li btn-sm">
                    <i class="fa fa-google-plus"></i>
                </a>

                <hr>

                <!-- Terms of service -->
                <p><em>রেজিস্টার</em> 
                    ক্লিক এর আগে আপনি আমাদের
                    <a href="" target="_blank">terms of service</a> মেনে নিচ্ছেন
            </form>
            <!-- Form -->

            </div>
        </div>
    </div>
    <!-- Material form register -->

@endsection

@section('extra-script')
    <script>

        $(document).on('submit', '#registration_form', function(event){
            event.preventDefault();
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var password_confirm = $('#password_confirm').val();
            var address = $('#address').val();
            var validate = '';

            if(first_name.trim()==''){
                validate = validate+"নামের প্রথম অংশ প্রয়োজন</br>";
            }
            if(phone.trim()==''){
                validate = validate+"নামের শেষাংশ প্রয়োজন</br>";
            }
            var re = /\S+@\S+\.\S+/;
            if(email.trim()!='' && !re.test(email)){
                validate = validate+"অকার্যকর ইমেইল</br>";
            }
            if(username.trim()==''){
                validate = validate+"ইউসার নাম প্রয়োজন</br>";
            }
            if(password.trim()==''){
                validate = validate+"পাসওয়ার্ড প্রয়োজন</br>";
            }
            if(password.trim()!='' && password.trim().length<8){
                validate = validate+"পাসওয়ার্ড অন্তত ৮ সংখ্যা প্রয়োজন</br>";
            }
            var regex = /\d/g;
            if(password.trim()!='' && !regex.test(password.trim())){
                validate = validate+"পাসওয়ার্ড অন্তত ১ টি নম্বর থাকতে হবে</br>";
            }
            if(password_confirm.trim()==''){
                validate = validate+"পাসওয়ার্ড নিশ্চিত করুন</br>";
            }
            if(password.trim()!='' && password_confirm.trim()!='' && password!=password_confirm){
                validate = validate+"পাসওয়ার্ড এবং পাসওয়ার্ড নিশ্চিত মেলে না";
            }

            if(validate==''){

                var formData = new FormData($('#registration_form')[0]);
                var url = '{{ url('save_public_user') }}';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    async: false,
                    success: function (data) {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        if(data.status == 200){
                            $('#success_message').show();
                            $('#error_message').hide();
                            $('#success_message').html(data.reason);
                            window.location.href="{{ url('/home') }}";
                        }
                        else{
                            $('#success_message').hide();
                            $('#error_message').show();
                            $('#error_message').html(data.reason);
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
            else{
                $("html, body").animate({ scrollTop: 0 }, "slow");
                $('#success_message').hide();
                $('#error_message').show();
                $('#error_message').html(validate);
            }
        });
    </script>
@endsection

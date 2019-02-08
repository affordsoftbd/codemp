@extends('auth.layout')

@section('extra-style')
    <style>
        body {
            background-image: linear-gradient(#ffffff, #ccffcc);
            background-size: cover;
        }
        .intro-2 {
            padding-top: 50px;
            padding-bottom: 50px;
        }
        .p2p {
          max-width: 100%;
          height: auto;
        }
        .error {
            display: none;
        }
    </style>
@endsection

@section('content')    

    <nav class="navbar navbar-expand-lg navbar-dark green">
        <div class="container container-fluid">
            <a class="navbar-brand" href="javascript:void(0)">
                {{ Html::image('img/amarneta.png', 'Amar Neta Logo', array('width' => '146', 'height' => '40')) }}
            </a>
            <form class="form-inline" method="post" action="{{ route('postLogin') }}">
                {{ csrf_field() }}
                <div class="md-form mt-0">
                    <input class="form-control mr-sm-2" name="username" type="text" placeholder="আপনার ই-মেইল">
                </div>
                <div class="md-form mt-0">
                    <input class="form-control mr-sm-2" name="password" type="password" placeholder="আপনার পাসওয়ার্ড">
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
                <div class="col-md-4">
                    <h2 class="display-5 font-weight-bold green-text">নেতা কর্মী সংযোগ</h2><hr>
                    <p class="red-text">সুস্থ ধারার রাজনৈতিক চর্চা, গণতন্ত্র, উন্নয়ন ও জনসেবায় নিয়োজিত নেতা কর্মী ও সমর্থকদের মধ্যে সংযোগ স্থাপন করুন।</p>
                    {{ Html::image('img/p2p.svg', 'Peer to peer', array('class' => 'p2p img-responsive my-5')) }}
                </div>
                <div class="col-md-8">
                    <div class="card wow h-100" data-wow-delay="0.3s">
                        <div class="card-body" id="landing_page_registration">

                            <h5 class="red-text"><i class="fa fa-edit fa-sm pr-2" aria-hidden="true"></i>রেজিস্টার করুন</h5><hr>

                                <div class="alert alert-success" id="success_message" style="display:none"></div>
                                <div class="alert alert-danger" id="error_message" style="display:none"></div>

                                <form id="registration_form" class="login-form" method="post" action="">
                                {{ csrf_field() }}
                                <div class="form-row" id="form_area">
                                    <div class="col-sm-3">
                                        <!-- First name -->
                                        <div class="md-form">
                                            <input type="text" name="first_name" id="first_name" class="form-control">
                                            <label for="first_name">নামের প্রথম অংশ</label>
                                        </div>                                        
                                    </div>
                                    <div class="col-sm-3">
                                        <!-- Last name -->
                                        <div class="md-form">
                                            <input type="text" name="last_name" id="last_name" class="form-control">
                                            <label for="last_name">নামের শেষাংশ</label>
                                        </div>                                       
                                    </div>
                                    <div class="col-sm-3">
                                        <!-- Phone number -->
                                        <div class="md-form">
                                            <input type="text" name="username" id="reg_username" class="form-control">
                                            <label for="reg_username">ইউসার নাম</label>
                                        </div>                                       
                                    </div>
                                    <div class="col-sm-3">
                                        <!-- E-mail -->
                                        <div class="md-form">
                                            <input type="email" name="email" id="reg_email" class="form-control">
                                            <label for="email">ই-মেইল</label>
                                        </div>                                       
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Phone number -->
                                        <div class="md-form">
                                            <input type="text" name="phone" id="phone" class="form-control">
                                            <label for="phone">ফোন নম্বর</label>
                                        </div>                                       
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Phone number -->
                                        <div class="md-form">
                                            <input type="text" name="nid" id="nid" class="form-control" maxlength="16">
                                            <label for="nid">জাতীয় আইডি</label>
                                        </div>                                       
                                    </div>
                                    <div class="col-sm-3">
                                        <!-- Choose Division -->
                                        <select class="mdb-select" name="division" id="division">
                                            <option value="" disabled selected>আপনার বিভাগ</option>
                                            @foreach($divisions as $division)
                                                <option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
                                            @endforeach                                            
                                        </select>                                       
                                    </div>
                                    <div class="col-sm-3">
                                        <!-- Choose District -->
                                        <select class="mdb-select" name="district" id="district" searchable="এখানে অনুসন্ধান করুন">
                                            <option value="" disabled selected>আপনার জেলা</option>
                                            
                                        </select>                                       
                                    </div>
                                    <div class="col-sm-3">
                                        <!-- Choose Thana -->
                                        <select class="mdb-select" name="thana" id="thana" searchable="এখানে অনুসন্ধান করুন">
                                            <option value="" disabled selected>আপনার থানা</option>
                                            
                                        </select>                                       
                                    </div>
                                    <div class="col-sm-3">
                                        <!-- Choose Zip -->
                                        <select class="mdb-select" name="zip" id="zip" searchable="এখানে অনুসন্ধান করুন">
                                            <option value="" disabled selected>আপনার জিপ</option>
                                            
                                        </select>                                       
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="mdb-select" name="party_id" id="party_id">
                                            <option value="" disabled selected>আপনার রাজনৈতিক দল</option>
                                            @foreach($parties as $party)
                                                <option value="{{ $party->party_id }}">{{ $party->party_name }}</option>
                                            @endforeach
                                            
                                        </select>                                       
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Choose Role -->
                                        <select class="mdb-select" name="role_id" id="role_id">
                                            <option value="" disabled selected>আপনি কি হিসাবে নিবন্ধন করতে চান?</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                                            @endforeach
                                        </select>                                       
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="md-form">
                                            <input type="text" name="address" id="address" class="form-control" maxlength="16">
                                            <label for="address">ঠিকানা</label>
                                        </div>                                       
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="md-form">
                                            <input type="password" name="password" id="reg_password" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
                                            <label for="reg_password">পাসওয়ার্ড</label>
                                            <small id="reg_password" class="form-text text-muted">
                                                পাসওয়ার্ড এ ৮টি বা আরও হরফ, অন্ততপক্ষে ১টি বড় অক্ষর এবং ১টি সংখ্যা থাকতে হবে
                                            </small>
                                            <small id="password_strength" class="text-danger" style="display:none">দুর্বল পাসওয়ার্ড</small>
                                        </div>                                       
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Confirm Password -->
                                        <div class="md-form">
                                            <input type="password" name="password_confirm" id="reg_password_confirm" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
                                            <label for="reg_password_confirm">পাসওয়ার্ড নিশ্চিত করুন</label>
                                        </div>                                       
                                    </div>
                                </div>
                                <div class="form-row" id="code_area" style="display:none">
                                    <div class="col-sm-6">
                                        <!-- Confirm Password -->
                                        <label>আপনার মুঠোফোনে একটি কোড পাঠানো হয়েছে। কোডটি এখানে যাচাই করুন </label>
                                        <div class="md-form">
                                            <input type="hidden" id="is_verification" value='off'>
                                            <input type="hidden" id="system_code" value=''>
                                            <input type="text" name="verification_code" id="verification_code" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
                                            <label for="reg_password_confirm">যাচাই কোড</label>
                                        </div>                                       
                                    </div>
                                </div>

                                <div class="col-sm-12">                                
                                    {{-- Html::image('https://developers.google.com/recaptcha/images/newCaptchaAnchor.gif', 'Captcha', array('class' => 'img-fluid my-3 mx-5', 'height' => '300', 'width' => '300')) --}}
                                </div>

                                <!-- Sign up button -->
                                <button id="register_button" class="btn btn-outline-danger btn-rounded btn-block my-3 waves-effect z-depth-0" type="submit">রেজিস্টার</button>
                                <button id="verify_button" class="btn btn-outline-danger btn-rounded btn-block mb-4 waves-effect z-depth-0" type="button" style="display:none" onclick="verify_registration()">কোড নিশ্চিত করুন</button>
                                <hr>
                                <center>
                                    <!-- Terms of service -->
                                    <p><em>রেজিস্টার</em> 
                                    &nbsp;ক্লিক এর আগে আপনি আমাদের
                                    <a href="{{ route('terms') }}" target="_blank">শর্তাবলী</a> মেনে নিচ্ছেন</p>
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

        

        $(document).on('change','#division', function(){
            var division_id = $(this).val();
            set_district(division_id,'');
        });

        $(document).on('change','#district', function(){
            var district_id = $(this).val();
            set_thana(district_id,'');
        });

        $(document).on('change','#thana', function(){
            var thana_id = $(this).val();
            set_zip(thana_id,'');
        });

        $(document).on('change','#role_id', function(){
            var role_id = $(this).val();
            set_leader(role_id);
        });

        function set_district(division_id,district_id){   
            $.ajax({
                type: "POST",
                url: "{{ url('district_by_division') }}",
                data: { _token: "{{ csrf_token() }}",division_id:division_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                        $('#district').material_select('destroy');
                        $('#district').html(data.options);
                        $('#district').val(district_id);
                        $('#district').material_select();
                    }
                    else{
                        alert(data);
                    }
                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        }

        function set_thana(district_id,thana_id){
            $.ajax({
                type: "POST",
                url: "{{ url('thana_by_district') }}",
                data: { _token: "{{ csrf_token() }}",district_id:district_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                        $('#thana').material_select('destroy');
                        $('#thana').html(data.options);
                        $('#thana').val(thana_id);
                        $('#thana').material_select();
                    }
                    else{
                        alert(data);
                    }
                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        }

        function set_zip(thana_id,address_type,zip_id){
            $.ajax({
                type: "POST",
                url: "{{ url('zip_by_thana') }}",
                data: { _token: "{{ csrf_token() }}",thana_id:thana_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                        $('#zip').material_select('destroy');
                        $('#zip').html(data.options);
                        $('#zip').val(zip_id);
                        $('#zip').material_select();
                    }
                    else{
                        alert(data);
                    }
                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        }

        function set_leader(role_id){   
            $.ajax({
                type: "POST",
                url: "{{ url('leader_by_role') }}",
                data: { _token: "{{ csrf_token() }}",role_id:role_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                        $('#leader').material_select('destroy');
                        $('#leader').html(data.options);
                        // $('#leader').val(zip_id);
                        $('#leader').material_select();
                    }
                    else{
                        alert(data);
                    }
                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        }
        $(document).on('keyup', '#reg_password', function(event){
            var password = $(this).val();
            var strength = 0;
            var arr = [/.{8,}/, /[a-z]+/, /[0-9]+/, /[A-Z]+/];
            jQuery.map(arr, function(regexp) {
              if(password.match(regexp)){
                 strength++;
              }
            });
            if(strength<4){
                $('#password_strength').show();
                $('#reg_password').css('border-color','red');
            }
            else{
                $('#password_strength').hide();
                $('#reg_password').css('border-color','#ced4da');
            }
        });

        $(document).on('submit', '#registration_form', function(event){
            event.preventDefault();
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var email = $('#reg_email').val();
            var phone = $('#phone').val();
            var username = $('#reg_username').val();
            var password = $('#reg_password').val();
            var password_confirm = $('#reg_password_confirm').val();
            var nid = $('#nid').val();
            var division = $('#division').val();
            var district = $('#district').val();
            var thana = $('#thana').val();
            var zip = $('#zip').val();
            var party = $('#party_id').val();
            var role = $('#role_id').val();
            var validate = '';

            if(first_name.trim()==''){
                validate = validate+"নামের প্রথম অংশ প্রয়োজন</br>";
                $('#first_name').css('border-color','red');
            }
            else{
                $('#first_name').css('border-color','#ced4da');
            }
            if(phone.trim()==''){
                validate = validate+"ফোন প্রয়োজন </br>";
                $('#phone').css('border-color','red');
            }
            else{
                $('#phone').css('border-color','#ced4da');
            }

            var re = /\S+@\S+\.\S+/;
            if(email.trim()!='' && !re.test(email)){
                validate = validate+"অকার্যকর ইমেইল ঠিকানা</br>";
            }
            else{
                $('#reg_email').css('border-color','#ced4da');
            }
            if(username.trim()==''){
                validate = validate+"ইউসার নাম প্রয়োজন</br>";
                $('#reg_username').css('border-color','red');
            }
            else{
                $('#reg_username').css('border-color','#ced4da');
                $('#reg_username_error').addClass('error');
            }
            if(password.trim()==''){
                validate = validate+"পাসওয়ার্ড প্রয়োজন</br>";
                $('#reg_password').css('border-color','red');
            }
            else{
                $('#reg_password').css('border-color','#ced4da');
            }

            if(password.trim()!=''){
                var strength = 0;
                var arr = [/.{8,}/, /[a-z]+/, /[0-9]+/, /[A-Z]+/];
                jQuery.map(arr, function(regexp) {
                  if(password.match(regexp)){
                     strength++;
                  }
                });
                if(strength<4){
                    validate = validate+"শক্তিশালী পাসওয়ার্ড ব্যবহার করুন</br>";
                    $('#reg_password').css('border-color','red');
                }
                else{
                    $('#reg_password').css('border-color','#ced4da');
                }
            }
            if(password_confirm.trim()==''){
                validate = validate+"পাসওয়ার্ড নিশ্চিত করা প্রয়োজন</br>";
                $('#reg_password_confirm').css('border-color','red');
            }
            else{
                $('#reg_password_confirm').css('border-color','#ced4da');
            }
            if(password.trim()!='' && password_confirm.trim()!='' && password!=password_confirm){
                validate = validate+"পাসওয়ার্ড এবং পাসওয়ার্ড নিশ্চিত মেলে না</br>";
            }
            if(division===null){
                validate = validate+"বিভাগ প্রয়োজন</br>";
                $('#division').parent('.select-wrapper').find('input').css('border-color','red');
            }
            else{
                $('#division').parent('.select-wrapper').find('input').css('border-color','#ced4da');
            }
            if(district===null){
                validate = validate+"জেলা প্রয়োজন</br>";
                $('#district').parent('.select-wrapper').find('input').css('border-color','red');
            }
            else{
                $('#district').parent('.select-wrapper').find('input').css('border-color','#ced4da');
            }
            if(thana===null){
                validate = validate+"থানা প্রয়োজন</br>";
                $('#thana').parent('.select-wrapper').find('input').css('border-color','red');
            }
            else{
                $('#thana').parent('.select-wrapper').find('input').css('border-color','#ced4da');
            }
            if(zip===null){
                validate = validate+"জিপ প্রয়োজন</br>";
                $('#zip').parent('.select-wrapper').find('input').css('border-color','red');
            }
            else{
                $('#zip').parent('.select-wrapper').find('input').css('border-color','#ced4da');
            }
            if(party===null){
                validate = validate+"রাজনৈতিক দল প্রয়োজন</br>";
                $('#party_id').parent('.select-wrapper').find('input').css('border-color','red');
            }
            else{
                $('#party_id').parent('.select-wrapper').find('input').css('border-color','#ced4da');
            }
            if(role===null){
                validate = validate+"রোল প্রয়োজন</br>";
                $('#role_id').parent('.select-wrapper').find('input').css('border-color','red');
            }
            else{
                $('#role_id').parent('.select-wrapper').find('input').css('border-color','#ced4da');
            }

            if(validate==''){
                var formData = new FormData($('#registration_form')[0]);
                var url = '{{ url('save_user') }}';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    async: false,
                    success: function (data) {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        if(data.status == 200){
                            /*$('#is_verification').val('on');
                            $('#system_code').val(data.code);
                            $('#form_area').hide();
                            $('#code_area').show();
                            $('#register_button').hide('hidden');
                            $('#verify_button').show('hidden');*/
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
                //showNotification("এরর!", validate, "#", "danger", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                $('#success_message').hide();
                $('#error_message').show();
                $('#error_message').html('প্রয়োজনীয় তথ্যগুলো পূরণ করুন');
            }
        });
        

        function verify_registration(){
            var verification_code = $('#verification_code').val();
            var validate = '';

            if(verification_code.trim()==''){
                validate = validate+"যাচাই কোড</br>";
                $('#verification_code').css('border-color','red');
            }
            else{
                $('#verification_code').css('border-color','#ced4da');
            }

            if(validate==''){
                var formData = new FormData($('#registration_form')[0]);
                var url = '{{ url('save_user') }}';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    async: false,
                    success: function (data) {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        if(data.status == 200){
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
                //showNotification("এরর!", validate, "#", "danger", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                $('#success_message').hide();
                $('#error_message').show();
                $('#error_message').html('যাচাই কোড প্রয়োজন');
            }
        }
    </script>
@endsection

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
            <form class="form-inline" method="post" action="{{ route('postLogin') }}">
                {{ csrf_field() }}
                <div class="md-form mt-0">
                    <input class="form-control mr-sm-2" name="username" id="username" type="text" placeholder="আপনার ই-মেইল">
                </div>
                <div class="md-form mt-0">
                    <input class="form-control mr-sm-2" name="password" id="password" type="password" placeholder="আপনার পাসওয়ার্ড">
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

                                <div class="alert alert-success" id="success_message" style="display:none"></div>
                                <div class="alert alert-danger" id="error_message" style="display:none"></div>

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
                                            <input type="text" name="username" id="reg_username" class="form-control" aria-describedby="materialRegisterFormPhoneHelpBlock">
                                            <label for="username">ইউসার নাম</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- E-mail -->
                                        <div class="md-form">
                                            <input type="email" name="email" id="reg_email" class="form-control">
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
                                            <input type="text" name="nid" id="nid" class="form-control" maxlength="16">
                                            <label for="nid">জাতীয় আইডি</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- Choose Division -->
                                        <select class="mdb-select" name="division" id="division">
                                            <option value="" disabled selected>আপনার বিভাগ</option>
                                            @foreach($divisions as $division)
                                                <option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
                                            @endforeach                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- Choose District -->
                                        <select class="mdb-select" name="district" id="district" searchable="এখানে অনুসন্ধান করুন">
                                            <option value="" disabled selected>আপনার জেলা</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- Choose Thana -->
                                        <select class="mdb-select" name="thana" id="thana" searchable="এখানে অনুসন্ধান করুন">
                                            <option value="" disabled selected>আপনার থানা</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- Choose Zip -->
                                        <select class="mdb-select" name="zip" id="zip" searchable="এখানে অনুসন্ধান করুন">
                                            <option value="" disabled selected>আপনার জিপ</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <select class="mdb-select" name="party_id" id="party_id">
                                            <option value="" disabled selected>আপনার রাজনৈতিক দল</option>
                                            
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
                                            @foreach($roles as $role)
                                                <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                                            @endforeach
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
                                            <input type="password" name="password" id="reg_password" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
                                            <label for="password">পাসওয়ার্ড</label>
                                            <small id="password" class="form-text text-muted mb-4">
                                                অন্ততপক্ষে ৮টি বা আরও অক্ষর এবং ১ সংখ্যা
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Confirm Password -->
                                        <div class="md-form">
                                            <input type="password" name="password_confirm" id="reg_password_confirm" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
                                            <label for="password_confirm">পাসওয়ার্ড নিশ্চিত করুন</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">                                
                                    {{-- Html::image('https://developers.google.com/recaptcha/images/newCaptchaAnchor.gif', 'Captcha', array('class' => 'img-fluid my-3 mx-5', 'height' => '300', 'width' => '300')) --}}
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
                validate = validate+"first name is required</br>";
            }
            if(phone.trim()==''){
                validate = validate+"phone is required</br>";
            }
            var re = /\S+@\S+\.\S+/;
            if(email.trim()!='' && !re.test(email)){
                validate = validate+"invalid email address</br>";
            }
            if(username.trim()==''){
                validate = validate+"username is required</br>";
            }
            if(password.trim()==''){
                validate = validate+"password is required</br>";
            }
            if(password.trim()!='' && password.trim().length<8){
                validate = validate+"password needs at least 8 digits</br>";
            }
            var regex = /\d/g;
            if(password.trim()!='' && !regex.test(password.trim())){
                validate = validate+"password should contain at least 1 number</br>";
            }
            if(password_confirm.trim()==''){
                validate = validate+"password confirm is required</br>";
            }
            if(password.trim()!='' && password_confirm.trim()!='' && password!=password_confirm){
                validate = validate+"Password and password confirm does not match";
            }
            if(division==''){
                validate = validate+"Division is required</br>";
            }
            if(district==''){
                validate = validate+"District is required</br>";
            }
            if(thana==''){
                validate = validate+"Thana is required</br>";
            }
            if(zip==''){
                validate = validate+"Zip is required</br>";
            }
            if(party==''){
                validate = validate+"Party is required</br>";
            }
            if(role==''){
                validate = validate+"Role is required</br>";
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
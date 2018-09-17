@extends('welcome')

@section('title', "রেজিস্টার || ")

@section('content')

    <div class="bc-icons green">
        <div class="container">
            <ol class="breadcrumb green">
                <li class="breadcrumb-item"><i class="fa fa-hand-o-right mr-2 white-text" aria-hidden="true"></i><a class="white-text" href="#">রেজিস্টার</a></li>
                <li class="breadcrumb-item active"><i class="fa fa-hand-o-right mx-2 white-text" aria-hidden="true"></i><a class="white-text" href="#">নেতা/কর্মী হিসেবে রেজিস্টার</a></li>
            </ol>
        </div>
    </div>

    <!-- Material form register -->
    <div class="container">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs md-tabs nav-justified red my-5 mx-5" role="tablist">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register.public') }}" role="tab">
                সমর্থক হিসেবে রেজিস্টার</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0)" role="tab">
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
                            <input type="email" name="email" id="email" class="form-control">
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
                            @foreach($divisions as $division)
                                <option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <!-- Choose District -->
                        <select class="mdb-select" name="district" id="district" searchable="এখানে অনুসন্ধান করুন">
                            <option value="" disabled selected>আপনার জেলা</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->district_id }}">{{ $district->district_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <!-- Choose Thana -->
                        <select class="mdb-select" name="thana" id="thana" searchable="এখানে অনুসন্ধান করুন">
                            <option value="" disabled selected>আপনার থানা</option>
                            @foreach($thanas as $thana)
                                <option value="{{ $thana->thana_id }}">{{ $thana->thana_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <!-- Choose Zip -->
                        <select class="mdb-select" name="zip" id="zip" searchable="এখানে অনুসন্ধান করুন">
                            <option value="" disabled selected>আপনার জিপ</option>
                            @foreach($zips as $zip)
                                <option value="{{ $zip->zip_id }}">{{ $zip->zip_code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <!-- Choose Zip -->
                        <select class="mdb-select" name="role_id" id="role_id" searchable="এখানে অনুসন্ধান করুন">
                            <option value="" disabled selected>হিসাবে নিবন্ধন করুন</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <!-- Choose Zip -->
                        <select class="mdb-select" name="leader" id="leader" searchable="এখানে অনুসন্ধান করুন">
                            <option value="" disabled selected>আপনার নেতা</option>
                        </select>
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

                <hr>

                <!-- Terms of service -->
                <p><em>রেজিস্টার</em> 
                    ক্লিক এর আগে আপনি আমাদের
                    <a href="" target="_blank">terms of service</a> মেনে নিচ্ছেন
            </form>
            <!-- Form -->
            <!-- Form -->

            </div>
        </div>
    </div>
    <!-- Material form register -->

@endsection


@section('extra-script')
    <script>

        $(document).on('change','#division', function(){
            var division_id = $(this).val();
            //set_district(division_id,'');
        });

        $(document).on('change','#district', function(){
            var district_id = $(this).val();
            //set_thana(district_id,'');
        });

        $(document).on('change','#thana', function(){
            var thana_id = $(this).val();
            //set_zip(thana_id,'');
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
                        $('#district').html(data.options);
                        $('#district').val(district_id);
                        $('#district').selectpicker('refresh');
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
                        $('#thana').html(data.options);
                        $('#thana').val(thana_id);
                        $('#thana').selectpicker('refresh');
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
                        $('#zip').html(data.options);
                        $('#zip').val(zip_id);
                        $('#zip').selectpicker('refresh');
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
                        $('#leader').html(data.options);
                        $('#leader').selectpicker('refresh');
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
            var email = $('#email').val();
            var phone = $('#phone').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var password_confirm = $('#password_confirm').val();
            var nid = $('#nid').val();
            var division = $('#division').val();
            var district = $('#district').val();
            var thana = $('#thana').val();
            var zip = $('#zip').val();
            var leader = $('#leader').val();
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
            if(division==''){
                validate = validate+"বিভাগ প্রয়োজন</br>";
            }
            if(district==''){
                validate = validate+"জেলা প্রয়োজন</br>";
            }
            if(thana==''){
                validate = validate+"থানা প্রয়োজন</br>";
            }
            if(zip==''){
                validate = validate+"জিপ প্রয়োজন</br>";
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
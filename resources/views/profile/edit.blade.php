@extends('layouts.master')

@section('title', "পরিলেখ || হালনাগাদ ||")

@section('content')

<h3>প্রোফাইল হালনাগাদ</h3>
<!--small class="grey-text">শেষ হালনাগাদ হয়েছিল <strong>সিলেট > মোগগ্রারা সদর > সোনারগাঁও উপজেলা</strong></small-->
<hr>
<div class="form-row">
    <div class="alert alert-success" id="success_message" style="display:none"></div>
    <div class="alert alert-danger" id="error_message" style="display:none"></div>

    <form id="user_form" class="login-form" method="post" action="">
        {{ csrf_field() }}
    	<div class="row">
            <div class="col-sm-6">
                <!-- First name -->
                <div class="md-form">
                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $user->first_name }}">
                    <label for="firstname">নামের প্রথম অংশ</label>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- Last name -->
                <div class="md-form">
                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $user->last_name }}">
                    <label for="lastname">নামের শেষাংশ</label>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- Phone number -->
                <div class="md-form">
                    <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" aria-describedby="materialRegisterFormPhoneHelpBlock">
                    <input type="hidden" name="old_username" value="{{ $user->username }}" aria-describedby="materialRegisterFormPhoneHelpBlock">
                    <label for="phone">ইউসার নাম</label>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- E-mail -->
                <div class="md-form">
                    <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}">
                    <input type="hidden" name="old_email" value="{{ $user->email }}">
                    <label for="email">ই-মেইল</label>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- Phone number -->
                <div class="md-form">
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" aria-describedby="materialRegisterFormPhoneHelpBlock">
                    <input type="hidden" name="old_phone" value="{{ $user->phone }}" aria-describedby="materialRegisterFormPhoneHelpBlock">
                    <label for="phone">ফোন নম্বর</label>
                </div>
            </div>
            <div class="col-sm-12">
                <!-- Phone number -->
                <div class="md-form">
                    <input type="text" name="nid" id="nid" class="form-control" value="{{ $user->nid }}">
                    <label for="nid">জাতীয় আইডি</label>
                </div>
            </div>
            <!--  -->
            <div class="col-sm-12">
                <!-- Choose Zip -->
                <select class="mdb-select" name="leader" id="leader" searchable="এখানে অনুসন্ধান করুন">
                    <option value="" disabled selected>আপনার নেতা</option>
                </select>
            </div>
            <div class="col-sm-12">
                <div class="md-form">
                    <textarea type="text" name="address" id="address" class="md-textarea form-control" rows="2">{{ $user->address }}</textarea>
                    <label for="address">ঠিকানা</label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="md-form">
                    <input type="file" name="profile_image" id="profile_image" class="form-control">
                    <label for="address">প্রোফাইল ছবি পরিবর্তন</label>
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

        <!-- Sign up button -->
        <button class="btn btn-outline-danger btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">হালনাগাদ</button>
    </form>
</div>


@endsection

@section('extra-script')
    <script>
        

        $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var password_confirm = $('#password_confirm').val();
            var nid = $('#nid').val();
            //var division = $('#division').val();
            //var district = $('#district').val();
            //var thana = $('#thana').val();
            //var zip = $('#zip').val();
            //var leader = $('#leader').val();
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
            if(password.trim()!='' && password.trim().length<8){
                validate = validate+"password needs at least 8 digits</br>";
            }
            var regex = /\d/g;
            if(password.trim()!='' && !regex.test(password.trim())){
                validate = validate+"password should contain at least 1 number</br>";
            }
            if(password!=password_confirm){
                validate = validate+"password and password confirm does not match";
            }
            /*if(division==''){
                validate = validate+"division is required</br>";
            }
            if(district==''){
                validate = validate+"district is required</br>";
            }
            if(thana==''){
                validate = validate+"thana is required</br>";
            }
            if(zip==''){
                validate = validate+"zip is required</br>";
            }*/

            if(validate==''){
                var formData = new FormData($('#user_form')[0]);
                var url = '{{ url('save_user_profile') }}';
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
                            $('#success_message').html(data.reason);;
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



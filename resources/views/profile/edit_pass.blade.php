@extends('layouts.master')

@section('title', "পরিলেখ || পাসওয়ার্ড হালনাগাদ ||")

@section('content')

<h3><i class="fa fa-edit fa-sm pr-2" aria-hidden="true"></i>পাসওয়ার্ড হালনাগাদ</h3>
<small class="grey-text">শেষ হালনাগাদ হয়েছিল <strong>2018-09-29 20:31:58</strong></small>
<hr>
<div class="alert alert-success" id="success_message" style="display:none"></div>
<div class="alert alert-danger" id="error_message" style="display:none"></div>

<form id="user_form" method="post" action="">
    {{ csrf_field() }}
	<div class="row">
       <div class="col-sm-12">
            <div class="md-form">
                <input type="password" name="old_password" id="old_pass" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
                <label for="old_pass">পুরাতন পাসওয়ার্ড</label>
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
            <div class="md-form">
                <input type="password" name="password_confirm" id="password_confirm" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
                <label for="password_confirm">পাসওয়ার্ড নিশ্চিত করুন</label>
            </div>
        </div>
    </div>

    <!-- Sign up button -->
    <div class="text-center my-4">
        <button class="btn btn-danger btn-rounded waves-effect text-center" type="submit">হালনাগাদ</button>
    </div>
</form>

<a class="btn btn-success waves-effect btn-sm" href="{{ route('profile', Session::get('username')) }}"><i class="fa fa-arrow-circle-left fa-sm pr-2" aria-hidden="true"></i>প্রত্যাবর্তন</a>


@endsection

@section('extra-script')
    <script>
        

        $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            var old_password = $('#old_pass').val();
            var password = $('#password').val();
            var password_confirm = $('#password_confirm').val();
            
            var validate = '';
            if(old_password.trim()==''){
                validate = validate+"পুরাতন পাসওয়ার্ড লিখুন</br>";
            }
            if(password.trim()==''){
                validate = validate+"নতুন পাসওয়ার্ড লিখুন</br>";
            }
            if(old_password.trim()==''){
                validate = validate+"পাসওয়ার্ড নিশ্চিত লিখুন</br>";
            }
            if(password.trim()!='' && password.trim().length<8){
                validate = validate+"পাসওয়ার্ড অন্তত ৮ সংখ্যা প্রয়োজন</br>";
            }
            var regex = /\d/g;
            if(password.trim()!='' && !regex.test(password.trim())){
                validate = validate+"পাসওয়ার্ড অন্তত ১ টি নম্বর থাকতে হবে</br>";
            }
            if(password!=password_confirm){
                validate = validate+"পাসওয়ার্ড এবং পাসওয়ার্ড নিশ্চিত মেলে না";
            }
            
            if(validate==''){
                var formData = new FormData($('#user_form')[0]);
                var url = '{{ url('update_user_password') }}';
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



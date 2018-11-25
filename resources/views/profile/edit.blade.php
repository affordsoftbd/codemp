@extends('layouts.master')

@section('title', "পরিলেখ || হালনাগাদ ||")

@section('content')

<h3><i class="fa fa-edit fa-sm pr-2" aria-hidden="true"></i>প্রোফাইল হালনাগাদ</h3>
<small class="grey-text">শেষ হালনাগাদ হয়েছিল <strong>2018-09-29 20:31:58</strong></small>
<hr>
<div class="form-row">
    <div class="alert alert-success" id="success_message" style="display:none"></div>
    <div class="alert alert-danger" id="error_message" style="display:none"></div>

    <form id="user_form" method="post" action="">
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
                    <input type="text" name="nid" id="nid" class="form-control" value="{{ $user->nid}}">
                    <label for="nid">জাতীয় আইডি</label>
                </div>
            </div>
            <div class="col-sm-12">
            <!-- Choose Division -->
            <select class="mdb-select" name="division" id="division">
                <option value="" disabled selected>আপনার বিভাগ</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->division_id }}" @if($division->division_id == $user->division_id) selected @endif>{{ $division->division_name }}</option>
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
                    <
                </select>
            </div>
            <div class="col-sm-4">
                <!-- Choose Zip -->
                <select class="mdb-select" name="zip" id="zip" searchable="এখানে অনুসন্ধান করুন">
                    <option value="" disabled selected>আপনার জিপ</option>
                    
                </select>
            </div>
            <div class="col-sm-12">
                <!-- Choose Role -->
                <select class="mdb-select" name="role_id" id="role_id">
                    <option value="" disabled selected>আপনি কি হিসাবে নিবন্ধন করতে চান</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->role_id }}" @if($role->role_id == $user->role_id) selected @endif>{{ $role->role_name }}</option>
                    @endforeach                
                </select>
            </div>
            <div class="col-sm-12">
                <div class="md-form">
                    <textarea type="text" name="address" id="address" class="md-textarea form-control" rows="2">{{ $user->address }}</textarea>
                    <label for="address">ঠিকানা</label>
                </div>
            </div>
        </div>

        <!-- Sign up button -->
        <div class="text-center my-4">
            <button class="btn btn-danger btn-rounded waves-effect text-center" type="submit">হালনাগাদ</button>
        </div>
    </form>
</div>



<a class="btn btn-success waves-effect btn-sm" href="{{ route('profile', Session::get('username')) }}"><i class="fa fa-arrow-circle-left fa-sm pr-2" aria-hidden="true"></i>প্রত্যাবর্তন</a>

@endsection

@section('extra-script')
    <script>
        
        $(document).ready(function() {
           $('#division').material_select();
           $('#district').material_select();
           $('#thana').material_select();
           $('#zip').material_select();
           $('#role_id').material_select();
           $('#leader').material_select();

           set_district('{{ $user->division_id }}','{{ $user->district_id }}');
           set_thana('{{ $user->district_id }}','{{ $user->thana_id }}');
           set_zip('{{ $user->thana_id }}','{{ $user->zip_id }}');
           //set_leader('{{ $user->role_id }}','{{ $user->parent_id }}');
        });

        $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var username = $('#username').val();
            var nid = $('#nid').val();
            var division = $('#division').val();
            var district = $('#district').val();
            var thana = $('#thana').val();
            var zip = $('#zip').val();
            var role = $('#role_id').val();
            var validate = '';

            if(first_name.trim()==''){
                validate = validate+"নামের প্রথম অংশ প্রয়োজন</br>";
            }
            if(phone.trim()==''){
                validate = validate+"ফোন প্রয়োজন </br>";
            }
            var re = /\S+@\S+\.\S+/;
            if(email.trim()!='' && !re.test(email)){
                validate = validate+"অকার্যকর ইমেইল ঠিকানা</br>";
            }
            if(username.trim()==''){
                validate = validate+"ইউসার নাম প্রয়োজন</br>";
            }
            if(division===null){
                validate = validate+"বিভাগ প্রয়োজন</br>";
            }
            if(district===null){
                validate = validate+"জেলা প্রয়োজন</br>";
            }
            if(thana===null){
                validate = validate+"থানা প্রয়োজন</br>";
            }
            if(zip===null){
                validate = validate+"জিপ প্রয়োজন</br>";
            }
            if(role===null){
                validate = validate+"রোল প্রয়োজন</br>";
            }

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



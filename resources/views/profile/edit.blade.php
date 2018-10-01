@extends('layouts.master')

@section('title', "পরিলেখ || হালনাগাদ ||")

@section('content')

<h3>প্রোফাইল হালনাগাদ</h3>
<small class="grey-text">শেষ হালনাগাদ হয়েছিল <strong>সিলেট > মোগগ্রারা সদর > সোনারগাঁও উপজেলা</strong></small>
<hr>
<div class="form-row">
	<div class="row">
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
                <label for="phone">ইউসার নাম</label>
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
        <!--  -->
        <div class="col-sm-12">
            <!-- Choose Zip -->
            <select class="mdb-select" name="leader" id="leader" searchable="এখানে অনুসন্ধান করুন">
                <option value="" disabled selected>আপনার নেতা</option>
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

    <!-- Sign up button -->
    <button class="btn btn-outline-danger btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">হালনাগাদ</button>
</div>


@endsection



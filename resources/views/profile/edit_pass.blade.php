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



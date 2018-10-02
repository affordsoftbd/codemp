@extends('layouts.master')

@section('title', "পরিলেখ || রাজনীতিবিদ্ তথ্য হালনাগাদ ||")

@section('content')

<h3><i class="fa fa-edit fa-sm pr-2" aria-hidden="true"></i>রাজনীতিবিদ্ তথ্য হালনাগাদ</h3>
<small class="grey-text">শেষ হালনাগাদ হয়েছিল <strong>2018-09-29 20:31:58</strong></small>
<hr>
<div class="alert alert-success" id="success_message" style="display:none"></div>
<div class="alert alert-danger" id="error_message" style="display:none"></div>

<form id="user_form" method="post" action="">
    {{ csrf_field() }}
    <div class="row">
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
                <option value="">Option 1</option>
                <option value="">Option 2</option>
                <option value="">Option 2</option>
            </select>
        </div>
        <div class="col-sm-4">
            <!-- Choose District -->
            <select class="mdb-select" name="district" id="district" searchable="এখানে অনুসন্ধান করুন">
                <option value="" disabled selected>আপনার জেলা</option>
                <option value="">Option 1</option>
                <option value="">Option 2</option>
                <option value="">Option 2</option>
            </select>
        </div>
        <div class="col-sm-4">
            <!-- Choose Thana -->
            <select class="mdb-select" name="thana" id="thana" searchable="এখানে অনুসন্ধান করুন">
                <option value="" disabled selected>আপনার থানা</option>
                <option value="">Option 1</option>
                <option value="">Option 2</option>
                <option value="">Option 2</option>
            </select>
        </div>
        <div class="col-sm-4">
            <!-- Choose Zip -->
            <select class="mdb-select" name="zip" id="zip" searchable="এখানে অনুসন্ধান করুন">
                <option value="" disabled selected>আপনার জিপ</option>
                <option value="">Option 1</option>
                <option value="">Option 2</option>
                <option value="">Option 2</option>
            </select>
        </div>
        <div class="col-sm-12">
            <!-- Choose Role -->
            <select class="mdb-select" name="role_id" id="role_id">
                <option value="" disabled selected>আপনি কি হিসাবে নিবন্ধন করতে চান?</option>
                <option value="">Option 1</option>
                <option value="">Option 2</option>
                <option value="">Option 2</option>
            </select>
        </div>
        <div class="col-sm-12">
            <!-- Choose Zip -->
            <select class="mdb-select" name="leader" id="leader" searchable="এখানে অনুসন্ধান করুন">
                <option value="" disabled selected>আপনার নেতা</option>
                <option value="">Option 1</option>
                <option value="">Option 2</option>
                <option value="">Option 2</option>
            </select>
        </div>
    </div>

    <!-- Sign up button -->
    <div class="text-center my-4">
        <button class="btn btn-danger btn-rounded waves-effect text-center" type="submit">হালনাগাদ</button>
    </div>
</form>

<a class="btn btn-success waves-effect btn-sm" href="{{ route('profile', Session::get('username')) }}"><i class="fa fa-arrow-circle-left fa-sm pr-2" aria-hidden="true"></i>প্রত্যাবর্তন</a>

<h1>home page er code gulo copy korle dropdown show korbe</h1>

@endsection



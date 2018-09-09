@extends('welcome')

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
            <form class="text-center" style="color: #757575;">

                <div class="form-row">
                    <div class="col-sm-6">
                        <!-- First name -->
                        <div class="md-form">
                            <input type="text" id="materialRegisterFormFirstName" class="form-control">
                            <label for="materialRegisterFormFirstName">নামের প্রথম অংশ</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- Last name -->
                        <div class="md-form">
                            <input type="text" id="materialRegisterFormLastName" class="form-control">
                            <label for="materialRegisterFormLastName">নামের শেষাংশ</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- E-mail -->
                        <div class="md-form">
                            <input type="email" id="materialRegisterFormEmail" class="form-control">
                            <label for="materialRegisterFormEmail">ই-মেইল</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- Phone number -->
                        <div class="md-form">
                            <input type="text" id="materialRegisterFormPhone" class="form-control" aria-describedby="materialRegisterFormPhoneHelpBlock">
                            <label for="materialRegisterFormPhone">ফোন নম্বর</label>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="md-form">
                    <textarea type="text" id="address" class="md-textarea form-control" rows="2"></textarea>
                    <label for="address">ঠিকানা</label>
                </div>

                <div class="form-row">
                    <div class="col-sm-6">
                        <div class="md-form">
                            <input type="password" id="password" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
                            <label for="password">পাসওয়ার্ড</label>
                            <small id="password" class="form-text text-muted mb-4">
                                অন্ততপক্ষে ৮টি বা আরও অক্ষর এবং ১ সংখ্যা
                            </small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- Confirm Password -->
                        <div class="md-form">
                            <input type="password" id="password_confirm" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
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
                    ক্লিক এর মাধ্যমে আপনি আমাদের
                    <a href="" target="_blank">terms of service</a> মেনে নিচ্ছেন
            </form>
            <!-- Form -->

            </div>
        </div>
    </div>
    <!-- Material form register -->

@endsection

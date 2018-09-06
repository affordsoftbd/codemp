@extends('welcome')

@section('content')

    <div class="card green">
        <div class="card-body">
            <div class="container">
                <h4 class="font-weight-bold white-text"><i class="fa fa-edit fa-sm pr-2" aria-hidden="true"></i>নীচের ঘরগুলোতে প্রয়োজনীয় তথ্য দিয়ে সাবমিট করুন</h4>
            </div>
        </div>
    </div>

    <!-- Material form register -->
    <div class="container">
        <div class="card my-5 mx-5">
        <h5 class="card-header red white-text text-center py-4">
            <strong>সমর্থক হিসেবে রেজিস্টার</strong>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center" style="color: #757575;">

                <div class="form-row">
                    <div class="col">
                        <!-- First name -->
                        <div class="md-form">
                            <input type="text" id="materialRegisterFormFirstName" class="form-control">
                            <label for="materialRegisterFormFirstName">First name</label>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Last name -->
                        <div class="md-form">
                            <input type="email" id="materialRegisterFormLastName" class="form-control">
                            <label for="materialRegisterFormLastName">Last name</label>
                        </div>
                    </div>
                </div>

                <!-- E-mail -->
                <div class="md-form mt-0">
                    <input type="email" id="materialRegisterFormEmail" class="form-control">
                    <label for="materialRegisterFormEmail">E-mail</label>
                </div>

                <!-- Password -->
                <div class="md-form">
                    <input type="password" id="materialRegisterFormPassword" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
                    <label for="materialRegisterFormPassword">Password</label>
                    <small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                        At least 8 characters and 1 digit
                    </small>
                </div>

                <!-- Phone number -->
                <div class="md-form">
                    <input type="password" id="materialRegisterFormPhone" class="form-control" aria-describedby="materialRegisterFormPhoneHelpBlock">
                    <label for="materialRegisterFormPhone">Phone number</label>
                    <small id="materialRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">
                        Optional - for two step authentication
                    </small>
                </div>

                <!-- Newsletter -->
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="materialRegisterFormNewsletter">
                    <label class="form-check-label" for="materialRegisterFormNewsletter">Subscribe to our newsletter</label>
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

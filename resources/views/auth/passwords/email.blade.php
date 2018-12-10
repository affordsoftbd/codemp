@extends('auth.layout')

@section('title', "পুনরুদ্ধার || ")

@section('content')    

<nav class="navbar navbar-expand-lg navbar-dark green">

    <div class="container container-fluid">
    
        <a class="navbar-brand font-weight-bold" href="{{ route('welcome') }}"><span class="red-text"><i class="fa fa-certificate fa-sm pr-2" aria-hidden="true"></i></span>আমারনেতা</a>

    </div>

</nav>

 <!-- Material form retry -->
    <div class="container">

        <div class="card my-5 mx-5">

        <!--Card content-->
            <div class="card-body px-lg-5 pt-0 my-5">

                <h4 class="green-text"><i class="fa fa-gears fa-sm pr-2" aria-hidden="true"></i>অ্যাকাউন্ট পুনরুদ্ধার করতে আপনার ইমেল লিখুন</h4><hr>

                <div class="alert alert-success" id="success_message" style="display:none"></div>
                <div class="alert alert-danger" id="error_message" style="display:none"></div>

                <form id="forgot_password_form" class="login-form" method="post" action="{{ route('reset') }}">
                                {{ csrf_field() }}
                    <!-- Confirm Password -->
                    <div class="md-form">
                        <i class="fa fa-envelope prefix green-text"></i>
                        <input type="text" name="email" id="email" class="form-control">
                        <label for="email">আপনার ইমেইল</label>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-send pr-2"></i>সাবমিট</button>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}">লগইন এ ফিরে যান</a>
                    </div>
                </form>
                <!-- Form -->

            </div>

        </div>

    </div>

@endsection

@section('extra-script')

<script>   

        $(document).on('submit', '#forgot_password_form', function(event){
            event.preventDefault();
            var email = $('#email').val();
            var validate = '';

            if(email.trim()==''){
                validate = validate+"Email is required</br>";
            }
            var re = /\S+@\S+\.\S+/;
            if(email.trim()!='' && !re.test(email)){
                validate = validate+"invalid email address</br>";
            }

            if(validate==''){
                var formData = new FormData($('#forgot_password_form')[0]);
                var url = '{{ route('reset_password') }}';
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
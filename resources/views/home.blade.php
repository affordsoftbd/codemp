@extends('layouts.master')

@section('title', "ফিড || ")

@section('content')

<h4>আপনি কি ভাবছেন?</h4><hr>

<div class="card border message_area border-light">
    <div class="card-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs md-tabs nav-justified green" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">
                    <i class="fa fa-edit fa-sm pr-2"></i>পোস্ট রচনা করুন
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel2" role="tab">
                    <i class="fa fa-file-image-o fa-sm pr-2"></i>অ্যালবাম / ফটো
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel3" role="tab">
                    <i class="fa fa-file-movie-o fa-sm pr-2"></i>লাইভ ভিডিও
                </a>
            </li>
        </ul>
         <!-- Tab panels -->
         <div class="tab-content">
            <div class="tab-pane fade in show active" id="panel1" role="tabpanel">

                <div class="alert alert-success" id="post_success" style="display:none"></div>
                <div class="alert alert-danger" id="post_danger" style="display:none"></div>
                <form id="text_post_form" class="login-form" method="post" action="">
                    {{ csrf_field() }}

                    <div class="md-form">
                        {!! Form::textarea('additional_details', null, array('class'=>'editor','name'=>'post_text','id'=>'post_text')) !!}
                    </div>
                    <div class="text-center my-4">
                        {!! Form::button('অবস্থা হালনাগাদ করুন', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm pull-right')) !!}
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
            <!--/.Panel 1-->
            <!--Panel 2-->
            <div class="tab-pane fade" id="panel2" role="tabpanel">
                {!! Form::open(['class'=>'md-form']) !!}
                    
                    <div class="md-form">
                      {!! Form::text('album_title', null, array('class' =>'form-control', 'id'=>'album_title')) !!}
                      {!! Form::label('album_title', 'অ্যালবাম শিরনাম') !!}
                    </div>

                    <div class="md-form">
                        <div class="file-field">
                            <div class="btn btn-danger btn-sm float-left">
                            <span>নির্বাচন</span>
                                {!! Form::file("image", ['class'=>'input_image', 'multiple'=>'true']) !!}
                            </div>
                            <div class="file-path-wrapper">
                                {!! Form::text('', null, ['class'=>'file-path validate', 'placeholder'=>'আপনার ফাইলগুলো চয়ন করুন']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="preview_input"></div>
                    <div class="text-center mt-4">
                        {{ Form::button('চিত্র আপলোড <i class="fa fa-upload ml-1"></i>', ['type' => 'submit', 'class' => 'btn btn-danger mt-1 btn-md'] ) }}
                    </div>
                {!! Form::close() !!}
            </div>
            <!--/.Panel 2-->
            <!--Panel 3-->
            <div class="tab-pane fade" id="panel3" role="tabpanel">
                {!! Form::open(['class'=>'md-form']) !!}
                    <button type="button" class="btn btn-danger btn-lg btn-block"><i class="fa fa-video-camera fa-sm pr-2"></i>ভিডিওটি শুরু করতে এখানে ক্লিক করুন</button>
                    <div class="md-form">
                        {!! Form::textarea('address', null, array('class'=>'md-textarea form-control no-resize auto-growth', 'rows'=>'1', 'id'=>'address')) !!}
                        {!! Form::label('address', 'ভিডিও বিবরণ') !!}
                    </div>
                    <div class="text-center mt-4">
                        {{ Form::button('ভিডিও আপলোড <i class="fa fa-upload ml-1"></i>', ['type' => 'submit', 'class' => 'btn btn-danger mt-1 btn-md'] ) }}
                    </div>
                {!! Form::close() !!}
            </div>
         </div>
    </div>
</div>

<div id="post_list">

</div>


<div class="row justify-content-center" id="load_more_spinner">
    <i class="fa fa-spinner fa-spin my-5 content_load"></i>
</div>

<div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['class'=>'md-form']) !!}
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">আপনার মন্তব্য লিখুন</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="md-form">
                    {!! Form::textarea('address', null, array('class'=>'md-textarea form-control no-resize auto-growth', 'rows'=>'1', 'id'=>'address')) !!}
                    {!! Form::label('address', 'মন্তব্য') !!}
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                {{ Form::button('পোস্ট', ['type' => 'submit', 'class' => 'btn btn-danger mt-1 btn-md'] ) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>



<!--div class="success_messages hidden">
    <h1>স্বাগতম!</h1>
    <p>আপনি সফলভাবে লগ ইন করেছেন!</p>
</div-->



@endsection

@section('extra-script')
    <script>

        $(document).ready(function(){
            setTimeout(function(){
                getPost(0);
            },3000)
        });

        $(window).on('scroll', function() {

            var eventFired = false,
            objectPositionTop = $('#load_more_spinner').offset().top;

            var currentPosition = $(document).scrollTop();
            if (currentPosition > objectPositionTop && eventFired === false) {
                eventFired = true;
                alert(currentPosition+" > "+bjectPositionTop);
            }

        });

        function start_count(){
            alert('start_count');
            //Add your code here
        }
        
        $(document).on('submit', '#text_post_form', function(event){
            event.preventDefault();
            var post_text = $('#post_text').val();
            var validate = '';

            if(post_text==''){
                validate = validate+"দয়া করে কিছু লিখুন";
            }

            if(validate==''){

                var formData = new FormData($('#text_post_form')[0]);
                var url = '{{ url('saveTextPost') }}';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    async: false,
                    success: function (data) {
                        if(data.status == 200){
                            location.reload();
                        }
                        else{
                            $('#post_success').hide();
                            $('#post_danger').show();
                            $('#post_danger').html(data.reason);
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
            else{
                $('#post_success').hide();
                $('#post_danger').show();
                $('#post_danger').html(validate);
            }
        });

        function getPost(last_id){
            var html = '';
            $.ajax({
                type: "POST",
                url: "{{ url('get_post_ajax') }}",
                data: { _token: "{{ csrf_token() }}",last_id:last_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                        /*
                        *Text post
                        */
                        html +='<div class="card my-4">';        
                            html +='<div class="card-body">';
                                html +='<div class="row">';
                                    html +='<div class="col-xl-1 col-lg-2 col-md-2">';
                                        html +='<img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg" class="rounded-circle z-depth-1-half">';
                                    html +='</div>';
                                    html +='<div class="col-xl-11 col-lg-10 col-md-10">';
                                        html +='<h6 class="font-weight-bold">Gracie Monahan</h6>';
                                        html +='<small class="grey-text">Monday 20 August 2018, 09:50 AM</small>';
                                        html +='<a class="btn-floating btn-action ml-auto mr-4 red pull-right" data-toggle="modal" data-target="#modalSubscriptionForm"><i class="fa fa-edit pl-1"></i></a>';
                                    html +='</div>';
                                html +='</div>';
                                html +='<hr>';
                                html +='Doloremque doloremque fuga nostrum harum. Omnis totam id alias dolorum qui. Recusandae assumenda adipisci ut enim rerum aut repudiandae. Nihil quia temporibus quam sapiente ut. Accusamus tenetur labore fuga incidunt. Recusandae porro ipsam cumque ut consequatur. Non et sed et quisquam ipsa et praesentium. Odit aut culpa earum consequatur sit quis. Consequatur est error mollitia ex aliquid. Quia tempore quae qui adipisci quidem laboriosam voluptates.';
                            html +='</div>';

                            html +='<div class="rounded-bottom green text-center pt-3">';
                                html +='<ul class="list-unstyled list-inline font-small">';
                                    html +='<li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-thumbs-o-up pr-1"></i>12</a></li>';
                                    html +='<li class="list-inline-item"><a href="#" class="white-text"><i class="fa fa-facebook pr-1"></i>5</a></li>';
                                    html +='<li class="list-inline-item"><a href="#" class="white-text"><i class="fa fa-twitter pr-1"></i>4</a></li';                html +='<li class="list-inline-item"><a href="{{ route('post') }}" class="white-text"><i class="fa fa-comments-o pr-1"></i>12</a></li>';
                                html +='</ul>';
                            html +='</div>';
                        html +='</div>';

                        /*
                        *Image post
                        */
                        html +='<div class="card my-4">';
                            html +='<div class="view overlay mt-4" align="center">';
                                html +='<div class="lightgallery">';
                                    html +='<p><span id="counter0">1</span> of 05</p>';
                                    html +='<ul class="lightSlider">';
                                        html +='<li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-8.jpg" data-src="http://sachinchoolur.github.io/lightslider/img/cS-8.jpg" data-sub-html="Focused client-server ability 10">';
                                            html +='<img src="http://sachinchoolur.github.io/lightslider/img/cS-8.jpg" />';
                                        html +='</li>';
                                        html +='<li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-9.jpg" data-src="http://sachinchoolur.github.io/lightslider/img/cS-9.jpg" data-sub-html="Focused client-server ability 14">';
                                            html +='<img src="http://sachinchoolur.github.io/lightslider/img/cS-9.jpg" />';
                                        html +='</li>';
                                        html +='<li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-10.jpg" data-src="http://sachinchoolur.github.io/lightslider/img/cS-10.jpg" data-sub-html="Focused client-server ability 15">';
                                            html +='<img src="http://sachinchoolur.github.io/lightslider/img/cS-10.jpg" />';
                                        html +='</li>';
                                        html +='<li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-11.jpg" data-src="http://sachinchoolur.github.io/lightslider/img/cS-11.jpg" data-sub-html="Focused client-server ability 10">';
                                            html +='<img src="http://sachinchoolur.github.io/lightslider/img/cS-12.jpg" />';
                                        html +='</li>';
                                        html +='<li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-13.jpg" data-src="http://sachinchoolur.github.io/lightslider/img/cS-13.jpg" data-sub-html="Focused client-server ability 10">';
                                            html +='<img src="http://sachinchoolur.github.io/lightslider/img/cS-13.jpg" />';
                                        html +='</li>';
                                    html +='</ul>';
                                html +='</div> ';
                            html +='</div>';

                          html +='<a class="btn-floating btn-action ml-auto mr-4 red" data-toggle="modal" data-target="#modalSubscriptionForm"><i class="fa fa-edit pl-1"></i></a>';

                            html +='<div class="card-body">';
                                html +='<div class="row">';
                                    html +='<div class="col-xl-11 col-lg-10 col-md-10">';
                                        html +='<h6 class="font-weight-bold">Gracie Monahan</h6>';
                                        html +='<small class="grey-text">Monday 20 August 2018, 09:50 AM</small>';
                                    html +='</div>';
                                    html +='<div class="col-xl-1 col-lg-2 col-md-2">';
                                        html +='<img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg" class="rounded-circle z-depth-1-half">';
                                    html +='</div>';
                                html +='</div>';
                                html +='<hr>';
                                html +='Doloremque doloremque fuga nostrum harum. Omnis totam id alias dolorum qui. Recusandae assumenda adipisci ut enim rerum aut repudiandae. Nihil quia temporibus quam sapiente ut. Accusamus tenetur labore fuga incidunt. Recusandae porro ipsam cumque ut consequatur. Non et sed et quisquam ipsa et praesentium. Odit aut culpa earum consequatur sit quis. Consequatur est error mollitia ex aliquid. Quia tempore quae qui adipisci quidem laboriosam voluptates.';
                            html +='</div>';

                          html +='<div class="rounded-bottom green text-center pt-3">';
                            html +='<ul class="list-unstyled list-inline font-small">';
                                html +='<li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-thumbs-o-up pr-1"></i>12</a></li>';
                                    html +='<li class="list-inline-item"><a href="#" class="white-text"><i class="fa fa-facebook pr-1"></i>5</a></li>';
                                    html +='<li class="list-inline-item"><a href="#" class="white-text"><i class="fa fa-twitter pr-1"></i>4</a></li>';
                                html +='<li class="list-inline-item"><a href="{{ route('image') }}" class="white-text"><i class="fa fa-comments-o pr-1"></i>12</a></li>';
                            html +='</ul>';
                          html +='</div>';

                        html +='</div>';

                        /*
                        * Video post
                        */
                        html +='<div class="card my-4">';
                            html +='<div class="view overlay mt-4" align="center">';
                                html +='<div class="embed-responsive embed-responsive-16by9">';
                                    html +='<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/v64KOxKVLVg" allowfullscreen></iframe>';
                        html +='<div> ';
                            html +='</div>';
                          html +='<a class="btn-floating btn-action ml-auto mr-4 red" data-toggle="modal" data-target="#modalSubscriptionForm"><i class="fa fa-edit pl-1"></i></a>';
                            
                            html +='<div class="card-body">';
                                html +='<div class="row">';
                                    html +='<div class="col-xl-1 col-lg-2 col-md-2">';
                                        html +='<img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg" class="rounded-circle z-depth-1-half">';
                                    html +='</div>';
                                    html +='<div class="col-xl-11 col-lg-10 col-md-10">';
                                        html +='<h6 class="font-weight-bold">Gracie Monahan</h6>';
                                        html +='<small class="grey-text">Monday 20 August 2018, 09:50 AM</small>';
                                    html +='</div>';
                                html +='</div>';
                                html +='<hr>';
                                html +='Doloremque doloremque fuga nostrum harum. Omnis totam id alias dolorum qui. Recusandae assumenda adipisci ut enim rerum aut repudiandae. Nihil quia temporibus quam sapiente ut. Accusamus tenetur labore fuga incidunt. Recusandae porro ipsam cumque ut consequatur. Non et sed et quisquam ipsa et praesentium. Odit aut culpa earum consequatur sit quis. Consequatur est error mollitia ex aliquid. Quia tempore quae qui adipisci quidem laboriosam voluptates.';
                            html +='</div>';

                          html +='<div class="rounded-bottom green text-center pt-3">';
                            html +='<ul class="list-unstyled list-inline font-small">';
                                html +='<li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-thumbs-o-up pr-1"></i>12</a></li>';
                                html +='<li class="list-inline-item"><a href="#" class="white-text"><i class="fa fa-facebook pr-1"></i>5</a></li>';
                                html +='<li class="list-inline-item"><a href="#" class="white-text"><i class="fa fa-twitter pr-1"></i>4</a></li>';
                                html +='<li class="list-inline-item"><a href="{{ route('video') }}" class="white-text"><i class="fa fa-comments-o pr-1"></i>12</a></li>';
                            html +='</ul>';
                          html +='</div>';

                        html +='</div>';

                        $('#post_list').html(html);
                    }
                    else{
                        alert(data);
                    }
                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        }
    </script>
@endsection



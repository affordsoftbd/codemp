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

<input type="hidden" name="last_load" id="last_load">
<div class="row justify-content-center load_more_spinner" id="load_more_spinner">
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

<button type="button" class="btn btn-danger" id="appendnewcontainer">Click me To create new slider</button>
<div id="fotoappendarea">
    
</div>


<!--div class="success_messages hidden">
    <h1>স্বাগতম!</h1>
    <p>আপনি সফলভাবে লগ ইন করেছেন!</p>
</div-->



@endsection

@section('extra-script')
    <script>

        $(document).ready(function(){
            // $('#last_load').val({{ $lastPost->post_id }});
            // getPost({{ $lastPost->post_id }});

             var imagesarray = [
                "https://www.elastic.co/assets/bltada7771f270d08f6/enhanced-buzz-1492-1379411828-15.jpg",
                "https://images.pexels.com/photos/236047/pexels-photo-236047.jpeg?auto=compress&cs=tinysrgb&h=350"
            ];

            var hiddenimages = "",
                    albumcover;

            function refreshSlider(){ 
                $('.lightSlider').each(function (index) {
                    $(this).lightSlider({
                        gallery: true,
                        item: 1,
                        loop: true,
                        slideMargin: 0,
                        thumbItem: 9,
                        onBeforeSlide: function (el) {
                            $('.slidercount:eq('+index+')').text(el.getCurrentSlideCount());
                        },
                        onSliderLoad: function(el) {
                            el.lightGallery({
                                selector: '.lightgallery .lslide'
                            });
                        }
                    });
                });               
            }   

            var slider = refreshSlider(); 

            $("#appendnewcontainer").click(function() {
                if($('.lightSlider').length){
                    $('.lightSlider').lightSlider().destroy();
                }
                $("#fotoappendarea").append("<div class='lightgallery my-5'><p><span class='slidercount'>1</span> of "+imagesarray.length+"</p><ul class= 'lightSlider'><li data-thumb=" + imagesarray[0] + " data-src=" + imagesarray[0] + "><img src='" + imagesarray[0] + "' class='_34'/></li><li data-thumb=" + imagesarray[1] + " data-src=" + imagesarray[1] + "><img src='" + imagesarray[1] + "' class='_34'/></li></ul></div>");
                slider = refreshSlider();

            });

            setTimeout(function(){
                var last_load = $('#last_load').val(); 
                $('#last_load').val(parseInt(last_load)-5);
                getPost(parseInt(last_load)-5);
            },5000)

            /*Scroll function starts*/
            $.fn.is_on_screen = function(){     
                var win = $(window);             
                var viewport = {
                    top : win.scrollTop(),
                    left : win.scrollLeft()
                };
                viewport.right = viewport.left + win.width();
                viewport.bottom = viewport.top + win.height();
                 
                var bounds = this.offset();
                bounds.right = bounds.left + this.outerWidth();
                bounds.bottom = bounds.top + this.outerHeight();
                 
                return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
                 
            };
            /*$(window).scroll(function(){ // bind window scroll event
                console.log($('.load_more_spinner').length);
                if( $('.load_more_spinner').length > 0 ) { // if target element exists in DOM
                    if( $('.load_more_spinner').is_on_screen() ) { // if target element is visible on screen after DOM loaded
                        setTimeout(function(){
                            var last_load = $('#last_load').val(); 
                            $('#last_load').val(last_load-5);
                            getPost(last_load-5);
                        },3000)
                    }
                }
            });*/
            /*Scroll function starts*/
        });
        
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
                            //tinyMCE.get('#post_text').setContent('');
                            $('#post_success').hide();
                            $('#post_danger').hide();
                            $('#post_success').html('');
                            $('#post_danger').html('');

                            getPost({{ $lastPost->post_id }});
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
            if(last_id > 0){  
                var html = '';
                $.ajax({
                    type: "POST",
                    url: "{{ url('get_post_ajax') }}",
                    data: { _token: "{{ csrf_token() }}",last_id:last_id},
                    dataType: "json",
                    cache : false,
                    success: function(data){
                        if(data.status == 200){                   
                            $.each(data.posts, function( index, value ) {
                                if(value.post_type=='text'){
                                    /*
                                    *Text post
                                    */
                                    if(value.image_path!='' || value.image_path!='null'){
                                        var profile_image = "{{ url('/')}}"+value.image_path;
                                    }
                                    else{
                                        var profile_image = "https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg";
                                    }

                                    html +='<div class="card my-4">';        
                                        html +='<div class="card-body">';
                                            html +='<div class="row">';
                                                html +='<div class="col-xl-1 col-lg-2 col-md-2">';
                                                    html +='<img src="'+profile_image+'" class="rounded-circle z-depth-1-half">';
                                                html +='</div>';
                                                html +='<div class="col-xl-11 col-lg-10 col-md-10">';
                                                    html +='<h6 class="font-weight-bold">'+value.first_name+' '+value.last_name+'</h6>';
                                                    html +='<small class="grey-text">'+value.created_at+'</small>';
                                                    html +='<a class="btn-floating btn-action ml-auto mr-4 red pull-right" data-toggle="modal" data-target="#modalSubscriptionForm"><i class="fa fa-edit pl-1"></i></a>';
                                                html +='</div>';
                                            html +='</div>';
                                            html +='<hr>';
                                            html +=value.description;
                                        html +='</div>';

                                        html +='<div class="rounded-bottom green text-center pt-3">';
                                            html +='<ul class="list-unstyled list-inline font-small">';
                                                html +='<li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-thumbs-o-up pr-1"></i>'+value.likes.length+'</a></li>';                
                                                html +='<li class="list-inline-item"><a href="{{ route('post') }}" class="white-text"><i class="fa fa-comments-o pr-1"></i>'+value.comments.length+'</a></li>';
                                            html +='</ul>';
                                        html +='</div>';
                                    html +='</div>';
                                }
                                if(value.post_type=='photo'){  
                                    /*
                                    *Image post
                                    */
                                    html +='<div class="card my-4">';
                                        html +='<div class="view overlay mt-4" align="center">';
                                            html +='<div class="lightgallery">';
                                                html +='<p><span id="counter0">1</span> of 05</p>';
                                                html +='<ul class="lightSlider">';
                                                $.each(value.images, function( index, image ) {
                                                    var image_url = '{{ url('/') }}'+image.image_path
                                                    html +='<li data-thumb="'+image_url+'" data-src="'+image_url+'" data-sub-html="Focused client-server ability 10">';
                                                        html +='<img src="'+image_url+'" />';
                                                    html +='</li>';
                                                });
                                                html +='</ul>';
                                            html +='</div> ';
                                        html +='</div>';

                                      html +='<a class="btn-floating btn-action ml-auto mr-4 red" data-toggle="modal" data-target="#modalSubscriptionForm"><i class="fa fa-edit pl-1"></i></a>';

                                        html +='<div class="card-body">';
                                            html +='<div class="row">';
                                                html +='<div class="col-xl-11 col-lg-10 col-md-10">';
                                                    html +='<h6 class="font-weight-bold">'+value.first_name+' '+value.last_name+'</h6>';
                                                    html +='<small class="grey-text">'+value.created_at+'</small>';
                                                html +='</div>';
                                                html +='<div class="col-xl-1 col-lg-2 col-md-2">';
                                                    html +='<img src="'+profile_image+'" class="rounded-circle z-depth-1-half">';
                                                html +='</div>';
                                            html +='</div>';
                                            html +='<hr>';
                                            html +=value.description;
                                        html +='</div>';

                                      html +='<div class="rounded-bottom green text-center pt-3">';
                                            html +='<ul class="list-unstyled list-inline font-small">';
                                                html +='<li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-thumbs-o-up pr-1"></i>'+value.likes.length+'</a></li>';                
                                                html +='<li class="list-inline-item"><a href="{{ route('post') }}" class="white-text"><i class="fa fa-comments-o pr-1"></i>'+value.comments.length+'</a></li>';
                                            html +='</ul>';
                                        html +='</div>';

                                    html +='</div>';
                                }
                                else if(value.post_type=='video'){  
                                    /*
                                    * Video post
                                    */
                                    html +='<div class="card my-4">';
                                        html +='<div class="view overlay mt-4" align="center">';
                                            html +='<div class="embed-responsive embed-responsive-16by9">';
                                                html +='<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/v64KOxKVLVg" allowfullscreen></iframe>';
                                            html +='</div> ';
                                        html +='</div>';
                                      html +='<a class="btn-floating btn-action ml-auto mr-4 red" data-toggle="modal" data-target="#modalSubscriptionForm"><i class="fa fa-edit pl-1"></i></a>';

                                        html +='<div class="card-body">';
                                            html +='<div class="row">';
                                                html +='<div class="col-xl-1 col-lg-2 col-md-2">';
                                                    html +='<img src="'+profile_image+'" class="rounded-circle z-depth-1-half">';
                                                html +='</div>';
                                                html +='<div class="col-xl-11 col-lg-10 col-md-10">';
                                                    html +='<h6 class="font-weight-bold">'+value.first_name+' '+value.last_name+'</h6>';
                                                    html +='<small class="grey-text">'+value.created_at+'</small>';
                                                html +='</div>';
                                            html +='</div>';
                                            html +='<hr>';
                                            html +=value.description;
                                        html +='</div>';
                                      html +='<div class="rounded-bottom green text-center pt-3">';
                                            html +='<ul class="list-unstyled list-inline font-small">';
                                                html +='<li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-thumbs-o-up pr-1"></i>'+value.likes.length+'</a></li>';                
                                                html +='<li class="list-inline-item"><a href="{{ route('post') }}" class="white-text"><i class="fa fa-comments-o pr-1"></i>'+value.comments.length+'</a></li>';
                                            html +='</ul>';
                                        html +='</div>';

                                    html +='</div>';
                                }
                            }); 

                            $('#post_list').append(html);
                        }
                        else{
                            alert(data);
                        }
                    } ,error: function(xhr, status, error) {
                        alert(error);
                    },
                });
            }
        }
    </script>
@endsection



@extends('layouts.master')

@section('title', "প্রোফাইল || অ্যালবাম ||")

@section('content')

@include('profile.profile')
<!-- Nav tabs -->
 <ul class="nav nav-tabs md-tabs nav-justified red my-5" role="tablist">
     <li class="nav-item">
         <a class="nav-link" href="{{ route('profile.posts', Session::get('username')) }}" role="tab"><i class="fa fa-edit fa-sm pr-2"></i> পোস্ট সমূহ</a>
     </li>
     <li class="nav-item">
         <a class="nav-link active" data-toggle="tab" href="javascript:void(0)" role="tab"><i class="fa fa-file-image-o fa-sm pr-2"></i> অ্যালবাম সমূহ</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('profile.videos', Session::get('username')) }}" role="tab"><i class="fa fa-file-movie-o fa-sm pr-2"></i> ভিডিও সমূহ</a>
     </li>
 </ul>
 <!-- Tab panels -->
 <div class="tab-content">
	<div id="post_list">

	</div>
	<!--Pagination-->
	<div class="container-fluid my-5">
	    <div class="row">
	        <div class="col-md-4">
	            <hr>
	        </div>
	        <div class="col-md-4" align="center">
	            <button class="btn btn-md btn-red load_more_button"><i class="fa fa-refresh fa-sm pr-2"></i>&nbsp;Load More!</button>
	        </div>
	        <div class="col-md-4">
	            <hr>
	        </div>
	    </div>
	</div>
 </div>

<div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="alert alert-success" id="comment_success" style="display:none"></div>
            <div class="alert alert-danger" id="comment_error" style="display:none"></div>
            <form id="comment_form" class="login-form" method="post" action="">
                {{ csrf_field() }}  
                <input type="hidden" name="post_id" id="post_id" value="">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">আপনার মন্তব্য লিখুন</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form">
                        {!! Form::textarea('address', null, array('class'=>'md-textarea form-control no-resize auto-growth', 'rows'=>'1', 'name'=>'comment_text', 'id'=>'comment_text')) !!}
                        {!! Form::label('address', 'মন্তব্য') !!}
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    {{ Form::button('পোস্ট', ['type' => 'submit', 'class' => 'btn btn-danger mt-1 btn-md'] ) }}
                </div>
            </form>
        </div>
    </div>
</div>

<input type="hidden" name="last_load" id="last_load">
<input type="hidden" name="last_id" id="last_id">

@endsection


@section('extra-script')

    <script>        
        $(document).ready(function(){
            var last_post_id = {{ $last_id }};
            $('#last_load').val(last_post_id);
            $('#last_id').val(last_post_id);
            getPost(last_post_id,'init');
        });

        $(document).on('click','.load_more_button',function(){
            var last_load = $('#last_load').val(); 
            $('#last_load').val(parseInt(last_load)-5);
            getPost(parseInt(last_load)-5);
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
                            tinyMCE.activeEditor.setContent('');
                            $('#post_success').hide();
                            $('#post_danger').hide();
                            $('#post_success').html('');
                            $('#post_danger').html('');

                            var last_id = $('#last_id').val();
                            $('#last_id').val(parseInt(last_id)+1);

                            getPost(parseInt(last_id)+1,'init');
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



        function getPost(last_id,type){
            if(last_id > 0){  
                var html = '';
                $.ajax({
                    type: "POST",
                    url: "{{ url('get_user_post_ajax',$user->id) }}",
                    data: { _token: "{{ csrf_token() }}",last_id:last_id},
                    dataType: "json",
                    cache : false,
                    success: function(data){
                        if(data.status == 200){                   
                            $.each(data.posts, function( index, value ) {
                                if(value.post_type=='photo'){  
                                    /*
                                    *Image post
                                    */
                                    image_post = true;

                                    if(value.image_path!='' || value.image_path!='null'){
                                        var profile_image = '{{ url('/') }}'+value.image_path;
                                    }
                                    else{
                                        var profile_image = "https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg";
                                    }
                                    html +='<div class="card my-4 news-card">';

                                        html +='<div class="card-body">';
                                            html +='<div class="content">';
                                                html +='<div class="right-side-meta">'+value.created_at+'</div>';
                                                html +='<img src="'+profile_image+'" class="rounded-circle profile-image-thumbnile avatar-img z-depth-1-half"><strong>'+value.first_name+' '+value.last_name+'</strong>';
                                            html +='</div>';
                                            html +='<hr>';
                                            html +=value.description;
                                        html +='</div>';

                                        html +='<div class="ml-auto mr-4 mb-4 ">';
                                        html +='<a class="btn-floating btn-action light-green" href="javascript:void(0)"><i class="fa fa-edit pl-1"></i></a>';
                                        html +='<a class="btn-floating btn-action deep-orange" href="javascript:void(0)"><i class="fa fa-trash pl-1"></i></a>';
                                        html +='<a class="btn-floating btn-action green" href="{{ route('image') }}/'+value.post_id+'"><i class="fa fa-eye pl-1"></i></a>';
                                        html +='<a class="btn-floating btn-action red" onclick="show_comment_box('+value.post_id+')"><i class="fa fa-comment-o pl-1"></i></a>';
                                        html +='</div>';

                                        html +='<div class="view overlay mt-4" align="center">';
                                            html +='<div class="lightgallery mb-4">';
                                                html +='<p>এই অ্যালবামের মোট '+Object.keys(value.images).length+'টি ছবি থেকে <span class="slidercount">1</span>নং ছবি</p>';
                                                html +='<ul class="lightSlider">'; // slidercount
                                                $.each(value.images, function( index, image ) {
                                                    var image_url =  '{{ url('/') }}'+image.image_path;
                                                    html +='<li data-thumb="'+image_url+'" data-src="'+image_url+'" data-sub-html="Focused client-server ability 10">';
                                                        html +='<img src="'+image_url+'" />';
                                                    html +='</li>';
                                                });
                                                html +='</ul>';
                                            html +='</div> ';
                                        html +='</div>';

                                      html +='<div class="rounded-bottom green text-center pt-3">';
                                            html +='<ul class="list-unstyled list-inline font-small">';
                                                html +='<li class="list-inline-item pr-2"><a href="javascript:void(0)" class="white-text" onclick="save_post_like('+value.post_id+')"><i class="fa fa-thumbs-o-up pr-1"></i><span id="p_like_'+value.post_id+'">'+value.likes.length+'</span></a></li>';                
                                                 html +='<li class="list-inline-item"><a href="{{ route('image') }}/'+value.post_id+'" class="white-text"><i class="fa fa-comments-o pr-1"></i><span id="p_comment_'+value.post_id+'">'+value.comments.length+'</span></a></li>';
                                            html +='</ul>';
                                        html +='</div>';

                                    html +='</div>';
                                }
                            }); 

                            if(type=='init'){
                                $('#post_list').html(html);
                            }
                            else{
                                $('#post_list').append(html);
                            }
                            
                            if (typeof image_post !== 'undefined'){
                                $('.lightSlider').each(function (index) {
                                    if (this.hasAttribute("sliderInstance")) {
                                    }
                                    else{
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
                                    }
                                });
                                $('.lightSlider').attr("sliderInstance", "instantiated");
                                delete image_post;
                            }
                        }
                        else{
                            alert(data);
                        }
                    } ,error: function(xhr, status, error) {
                        alert(error);
                    },
                });
            }

            if(last_id-5<5){
                $('.load_more_button').hide();
            }
        }

            //  Show image preview
        $(".input_image").on("change", function(e) {
        var files = e.target.files,
        filesLength = files.length;
        $("#image_upload_feedback").attr('style', '');
        $("#image_upload_feedback").html("<h5 class='red-text font-weight-bold mt-3'>Preview Images</h5><small class='grey-text mb-3'>Following functionalities are for preview only! Please select your images again if you want a different set of images! Image size can not be more than <strong>2MB</strong>!</small><hr>");
        for (var i = 0; i < filesLength; i++) {
          var f = files[i];
          var fileReader = new FileReader();
          fileReader.onload = (function(e) {
            var file = e.target;
            $("#image_upload_feedback").append("<span class='pip' align='center'><img src='"+ file.result+"' alt="+f.name+"' class='img-thumbnail mx-3 my-3' width= '200'><button type='button' class='btn btn-sm btn-danger remove' data-toggle='tooltip' data-placement='right' title='Hide Preview!'><i class='fa fa-eye-slash'></i></button></span>").hide().fadeIn(500+Math.pow(i, 2));
            $(".remove").click(function() {
                $(this).parent(".pip").fadeOut("normal", function() {
                     $(this).parent(".pip").remove();
                });
            });
          });
          fileReader.readAsDataURL(f);
        }
        });

        (function() {
            $('.share_video').ajaxForm({
              beforeSend: function() {
                $('#video_error_message').delay(5000).empty();
                $("#video_upload_feedback").empty().append("<p class='mt-1 mb-2 orange-text'>Connecting with server...</p>");
              },
              uploadProgress: function() {
                $("#video_upload_feedback").empty().append("<p class='mt-1 mb-2 orange-text'>Video is being saved! Please wait...</p><div class='progress primary-color-dark'><div class='indeterminate'></div></div>");
              },
              success: function() {
                $("#video_upload_feedback").empty().append("<p class='mt-1 mb-2 green-text'>Video has been saved. Wait till return message..</p><div class='progress primary-color-dark'><div class='indeterminate'></div></div>").fadeIn("slow");        
              },
              error: function() {
               $("#video_upload_feedback").empty().append("<p class='mt-1 mb-2 red-text'>Something went wrong in the server. Wait till return message..</p>").fadeIn("slow");        
              },
              complete: function(xhr) {
                $(".input_video").val(null);
                $("#selected_video_name").empty().val("");
                $("#video_description").empty().val("");
                $('#video_upload_feedback').fadeOut('slow', function() {
                    var json = JSON.parse(xhr.responseText);
                    if(json.response == 'error'){
                        $('#video_error_message').html('<div class="alert alert-danger mt-3 mb-5" role="alert"><center>'+json.message+'</center></div>');
                        $(this).empty();
                    }
                    else{
                        $(this).html('<p class="green-text">'+json.message+'</p>').fadeIn('slow');
                        $(this).delay(2000).fadeOut('slow');
                    }
                });

                var last_id = $('#last_id').val();
                $('#last_id').val(parseInt(last_id)+1);

                getPost(parseInt(last_id)+1,'init');
              }
            }); 
        })();

        (function() {
        $('.upload_image').ajaxForm({
          beforeSend: function() {
            $('#image_error_message').delay(5000).empty();
            $('#image_upload_feedback').fadeOut('fast', function() {
                $(this).html("<div class='progress md-progress' style='height: 20px'><div class='progress-bar bg-success progress-bar-striped progress-bar-animated' role='progressbar' style='width: 0%; height: 20px' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'>0%</div></div>").fadeIn('slow');
            });
          },
          uploadProgress: function(event, position, total, percentComplete) {
            percentVal = percentComplete + '%';
            $('#image_upload_feedback').html("<div class='progress md-progress' style='height: 20px'><div class='progress-bar bg-success progress-bar-striped progress-bar-animated' role='progressbar' style='width: "+percentVal+"; height: 20px' aria-valuenow='"+percentVal+"' aria-valuemin='0' aria-valuemax='100'>"+percentVal+"</div></div>");
          },
          success: function() {
            $('#image_upload_feedback').html("<div class='progress md-progress' style='height: 20px'><div class='progress-bar bg-success progress-bar-striped progress-bar-animated' role='progressbar' style='width: 100%; height: 20px' aria-valuenow='100%' aria-valuemin='0' aria-valuemax='100'>100%</div></div>");   
          },
          error: function() {
            $("#image_upload_feedback").html("<h5 class='mt-1 mb-2 red-text text-center'><i class='fa fa-warning'></i> ছবি আপলোড করা যাচ্ছে না!!</h5><p class='mt-1 mb-2 light-blue-text text-center'>সার্ভারে সমস্যার সম্মুখীন হয়েছে।! অনুগ্রহপূর্বক আবার চেষ্টা করুন!</p>").fadeIn("slow");        
          },
          complete: function(xhr) {
            $(".input_image").val(null);
            $("#image_description").empty().val("");
            $("#selected_images_names").empty().val("");
            $('#image_upload_feedback').fadeOut('slow', function() {
                var json = JSON.parse(xhr.responseText);
                if(json.response == 'error'){
                    $('#image_error_message').html('<div class="alert alert-danger my-3" role="alert"><center>'+json.message+'</center></div>');
                    $(this).empty();
                }
                else{
                    html = '<ul class="green-text">';
                    for( var i = 0; i<json.message.length; i++){
                        html +='<li>'+json.message[i]+'</li>';
                    }
                    html +='</ul>';
                    $(this).html(html).fadeIn('slow');
                    $(this).delay(2000).fadeOut('slow');
                }
            });

            var last_id = $('#last_id').val();
            $('#last_id').val(parseInt(last_id)+1);

            getPost(parseInt(last_id)+1,'init');
          }
        }); 
      })();

        function show_comment_box(id){
            $('#post_id').val(id);
            $('#modalSubscriptionForm').modal('show');
        }


        $(document).on('submit', '#comment_form', function(event){
            event.preventDefault();
            var post_id = $('#post_id').val();
            var comment_text = $('#comment_text').val();
            var validate = '';

            if(comment_text==''){
                validate = validate+"দয়া করে কিছু লিখুন";
            }

            if(validate==''){

                var formData = new FormData($('#comment_form')[0]);
                var url = '{{ url('save_comment') }}';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    async: false,
                    success: function (data) {
                        if(data.status == 200){
                            show_success_message(data.reason);
                            $('#post_id').val('');
                            $('#comment_text').val('');
                            $('#modalSubscriptionForm').modal('hide');

                            var current_comment = $('#p_comment_'+post_id).text();
                            var new_comment = parseInt(current_comment)+1;
                            $('#p_comment_'+post_id).text(new_comment);

                            setTimeout(function(){
                                $('#alert-modal').modal('hide');
                            },2000)
                        }
                        else{
                            $('#comment_success').hide();
                            $('#comment_error').show();
                            $('#comment_error').html(data.reason);
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
            else{
                $('#comment_success').hide();
                $('#comment_error').show();
                $('#comment_error').html(validate);
            }
        });

        function save_post_like(post_id){
            $.ajax({
                type: "POST",
                url: "{{ url('save_post_like') }}",
                data: { _token: "{{ csrf_token() }}",post_id:post_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                        var current_like = $('#p_like_'+post_id).text();
                        var new_like = parseInt(current_like)+data.like;
                        $('#p_like_'+post_id).text(new_like);
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



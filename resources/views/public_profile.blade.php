@extends('layouts.master')

@section('title', "প্রোফাইল || পোস্ট ||")

@section('content')

@include('public_profile_basic')

@guest          

@else
    <!-- Nav tabs -->
     <ul class="nav nav-tabs md-tabs nav-justified red my-5" role="tablist">
         <li class="nav-item">
             <a class="nav-link active" data-toggle="tab" href="javascript:void(0)" role="tab"><i class="fa fa-edit fa-sm pr-2"></i> পোস্ট সমূহ</a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="{{ route('profile.albums', Session::get('username')) }}" role="tab"><i class="fa fa-file-image-o fa-sm pr-2"></i> অ্যালবাম সমূহ</a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="{{ route('profile.videos', Session::get('username')) }}" role="tab"><i class="fa fa-file-movie-o fa-sm pr-2"></i> ভিডিও সমূহ</a>
         </li>
     </ul>
     <!-- Tab panels -->
@endguest

<div class="tab-content">
	<div id="post_list">

	</div>
	
	<div class="container-fluid my-5">
	    <div class="row">
	        <div class="col-md-4">
	            <hr>
	        </div>
	        <div class="col-md-4" align="center">
                <button class="btn btn-md btn-red load_more_button"><i class="fa fa-refresh fa-sm pr-2"></i>আরো দেখুন!</button>
	        </div>
	        <div class="col-md-4">
	            <hr>
	        </div>
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

                                    var like_icon = "fa fa-thumbs-o-up";
                                    if(value.likes.length > 0){
                                        for (var i = 0; i < value.likes.length; i++) {
                                            if(value.likes[i]['user_id'] == {{ Session::get('user_id') }}){
                                                var like_icon = "fa fa-thumbs-up";
                                            }
                                            break; 
                                        }
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
                                        html +='<a class="btn-floating btn-action green" href="{{ route('post') }}/'+value.post_id+'"><i class="fa fa-eye pl-1"></i></a>';
                                        html +='<a class="btn-floating btn-action red" onclick="show_comment_box('+value.post_id+')"><i class="fa fa-comment-o pl-1"></i></a>';
                                        html +='</div>';

                                        html +='<div class="rounded-bottom green text-center pt-3">';
                                            html +='<ul class="list-unstyled list-inline font-small">';
                                                html +='<li class="list-inline-item pr-2"><a href="javascript:void(0)" class="white-text" onclick="save_post_like('+value.post_id+')"><i class="'+like_icon+' pr-1" id="p_like_ico_'+value.post_id+'"></i><span id="p_like_'+value.post_id+'">'+value.likes.length+'</span></a></li>';                
                                                html +='<li class="list-inline-item"><a href="{{ route('post') }}/'+value.post_id+'#total_comments" class="white-text"><i class="fa fa-comments-o pr-1"></i><span id="p_comment_'+value.post_id+'">'+value.comments.length+'</span></a></li>';
                                            html +='</ul>';
                                        html +='</div>';
                                    html +='</div>';
                                }
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

                                    var like_icon = "fa fa-thumbs-o-up";
                                    if(value.likes.length > 0){
                                        for (var i = 0; i < value.likes.length; i++) {
                                            if(value.likes[i]['user_id'] == {{ Session::get('user_id') }}){
                                                var like_icon = "fa fa-thumbs-up";
                                            }
                                            break; 
                                        }
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
                                        html +='<a class="btn-floating btn-action green" href="{{ route('image') }}/'+value.post_id+'"><i class="fa fa-eye pl-1"></i></a>';
                                        html +='<a class="btn-floating btn-action red" onclick="show_comment_box('+value.post_id+')"><i class="fa fa-comment-o pl-1"></i></a>';
                                        html +='</div>';

                                        html +='<div class="view overlay mt-4" align="center">';
                                            html +='<div class="lightgallery mb-4">';
                                                html +='<p>এই অ্যালবামের মোট '+Object.keys(value.images).length+'টি ছবি থেকে <span class="slidercount">1</span>নং ছবি</p>';
                                                html +='<ul class="lightSlider">'; // slidercount
                                                $.each(value.images, function( index, image ) {
                                                    var image_url =  '{{ url('/') }}'+image.image_path;
                                                    var sub_html = index + 1;
                                                    html +='<li data-thumb="'+image_url+'" data-src="'+image_url+'" data-sub-html="চিত্র '+sub_html+'">';
                                                        html +='<img src="'+image_url+'" />';
                                                    html +='</li>';
                                                });
                                                html +='</ul>';
                                            html +='</div> ';
                                        html +='</div>';

                                      html +='<div class="rounded-bottom green text-center pt-3">';
                                            html +='<ul class="list-unstyled list-inline font-small">';
                                                html +='<li class="list-inline-item pr-2"><a href="javascript:void(0)" class="white-text" onclick="save_post_like('+value.post_id+')"><i class="'+like_icon+' pr-1" id="p_like_ico_'+value.post_id+'"></i><span id="p_like_'+value.post_id+'">'+value.likes.length+'</span></a></li>';                
                                                 html +='<li class="list-inline-item"><a href="{{ route('image') }}/'+value.post_id+'#total_comments" class="white-text"><i class="fa fa-comments-o pr-1"></i><span id="p_comment_'+value.post_id+'">'+value.comments.length+'</span></a></li>';
                                            html +='</ul>';
                                        html +='</div>';

                                    html +='</div>';
                                }
                                else if(value.post_type=='video'){  
                                    /*
                                    * Video post
                                    */
                                    video_post = true;
                                    
                                    if(value.image_path!='' || value.image_path!='null'){
                                        var profile_image = "{{ url('/')}}"+value.image_path;
                                    }
                                    else{
                                        var profile_image = "https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg";
                                    }

                                    var like_icon = "fa fa-thumbs-o-up";
                                    if(value.likes.length > 0){
                                        for (var i = 0; i < value.likes.length; i++) {
                                            if(value.likes[i]['user_id'] == {{ Session::get('user_id') }}){
                                                var like_icon = "fa fa-thumbs-up";
                                            }
                                            break; 
                                        }
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
                                        html +='<a class="btn-floating btn-action green" href="{{ route('video') }}/'+value.post_id+'"><i class="fa fa-eye pl-1"></i></a>';
                                        html +='<a class="btn-floating btn-action red" onclick="show_comment_box('+value.post_id+')"><i class="fa fa-comment-o pl-1"></i></a>';
                                        html +='</div>';

                                        $.each(value.videos, function( index, video ) {
                                            var video_url =  '{{ url('/') }}'+video.video_path;

                                            html +='<div class="view overlay my-3" align="center">';
                                                html +='<video class="video-js z-depth-1" controls style="width:100%">';
                                                    html +='<source src="'+video_url+'" type="video/mp4">';
                                                html +='</video> ';
                                            html +='</div>';
                                        });
                                        
                                        html +='<div class="rounded-bottom green text-center pt-3">';
                                            html +='<ul class="list-unstyled list-inline font-small">';
                                                html +='<li class="list-inline-item pr-2"><a href="javascript:void(0)" class="white-text" onclick="save_post_like('+value.post_id+')"><i class="'+like_icon+' pr-1" id="p_like_ico_'+value.post_id+'"></i><span id="p_like_'+value.post_id+'">'+value.likes.length+'</span></a></li>';                
                                                 html +='<li class="list-inline-item"><a href="{{ route('video') }}/'+value.post_id+'#total_comments" class="white-text"><i class="fa fa-comments-o pr-1"></i><span id="p_comment_'+value.post_id+'">'+value.comments.length+'</span></a></li>';
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
                            if (typeof video_post !== 'undefined'){
                                var massVideo = $('.video-js');
                                for(var i = 0; i < massVideo.length; i++){
                                  videojs(massVideo[i]).ready(function(){});
                                }
                                delete video_post;
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

        function show_comment_box(id){
            $('#post_id').val(id);
            $('#modalSubscriptionForm').modal('show');
        }

          //  Show image preview
      $(".input_album").on("change", function(e) {
        var files = e.target.files,
        filesLength = files.length;
        $("#album_upload_feedback").attr('style', '');
        $("#album_upload_feedback").html("<h5 class='red-text font-weight-bold mt-3'>Preview Images</h5><small class='grey-text mb-3'>Following functionalities are for preview only! Please select your images again if you want a different set of images! Image size can not be more than <strong>2MB</strong>!</small><hr>");
        for (var i = 0; i < filesLength; i++) {
          var f = files[i];
          var fileReader = new FileReader();
          fileReader.onload = (function(e) {
            var file = e.target;
            $("#album_upload_feedback").append("<span class='pip' align='center'><img src='"+ file.result+"' alt="+f.name+"' class='img-thumbnail mx-3 my-3' width= '200'><button type='button' class='btn btn-sm btn-danger remove' data-toggle='tooltip' data-placement='right' title='Hide Preview!'><i class='fa fa-eye-slash'></i></button></span>").hide().fadeIn(500+Math.pow(i, 2));
            $(".remove").click(function() {
                $(this).parent(".pip").fadeOut("normal", function() {
                     $(this).parent(".pip").remove();
                });
            });
          });
          fileReader.readAsDataURL(f);
        }
      });

         //  Jquery form for uploading image and showing progress (image_error_message)



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
                            showNotification("সাকসেস!", data.reason, "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
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
                        if($('#p_like_ico_'+post_id).hasClass("fa fa-thumbs-up")) {
                            $('#p_like_ico_'+post_id).removeClass('fa fa-thumbs-up').addClass('fa fa-thumbs-o-up');
                        }
                        else if($('#p_like_ico_'+post_id).hasClass("fa fa-thumbs-o-up")){
                            $('#p_like_ico_'+post_id).removeClass('fa fa-thumbs-o-up').addClass('fa fa-thumbs-up');
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

        function follow_leader(leader_id){
            $.ajax({
                type: "POST",
                url: "{{ route('follow_leader') }}",
                data: { _token: "{{ csrf_token() }}",leader_id:leader_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                      showNotification("সাকসেস!", 'leader followed successfully', "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                      location.reload();
                    }
                    else{
                        alert(data);
                    }
                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        }

        function un_follow_leader(leader_id){
            $.ajax({
                type: "POST",
                url: "{{ route('un_follow_leader') }}",
                data: { _token: "{{ csrf_token() }}",leader_id:leader_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                        showNotification("সাকসেস!", 'leader un-followed successfully', "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                        location.reload();
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



@extends('layouts.master')

@section('title', "প্রোফাইল || পোস্ট ||")

@section('content')

@include('profile.profile')

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

	<!--div class="card mb-4">
		<div class="card-body">
			<div class="row">
				<div class="col-xl-1 col-lg-2 col-md-2 post_creator">
				<img src="http://localhost:8000null" class="rounded-circle profile-image-thumbnile z-depth-1-half"></div>
				<div class="col-xl-11 col-lg-10 col-md-10">
					<h6 class="font-weight-bold">Mohiuddin Muhin</h6>
					<small class="grey-text">2018-09-29 20:31:58</small>
				</div>
			</div>
			<hr>asdasd
		</div>
		<div class="rounded-bottom green text-center pt-3">
			<ul class="list-unstyled list-inline font-small">
				<li class="list-inline-item pr-2">
				</li>
				<li class="list-inline-item">
					<a href="http://localhost:8000/post/75" class="white-text">
							<i class="fa fa-comments-o pr-1"></i><span id="p_comment_75">0</span>
						</a>
				</li>
			</ul>
		</div>
	</div-->
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
                /*showNotification("এরর!", "দয়া করে কিছু লিখুন", "#", "danger", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');*/
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
                            /*$('#post_success').hide();
                            $('#post_danger').hide();
                            $('#post_success').html('');
                            $('#post_danger').html('');*/
                            showNotification("সফল!", "পোস্টটি সফলভাবে শেয়ার করা হয়েছে", "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');

                            var last_id = $('#last_id').val();
                            $('#last_id').val(parseInt(last_id)+1);

                            getPost(parseInt(last_id)+1,'init');
                        }
                        else{
                            /*$('#post_success').hide();
                            $('#post_danger').show();
                            $('#post_danger').html(data.reason);*/
                            showNotification("এরর!", data.reason, "#", "danger", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
            else{
                /*$('#post_success').hide();
                $('#post_danger').show();
                $('#post_danger').html(validate);*/
                showNotification("এরর!", validate, "#", "danger", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
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
                                if(value.post_type=='text'){
                                    /*
                                    *Text post
                                    */
                                    if(value.image_path!='' || value.image_path!='null'){
                                        var profile_image = "{{ url('/').'/' }}"+value.image_path;
                                    }
                                    else{
                                        var profile_image = "url('/').'/img/avatar.png";
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
                                        html +='<a class="btn-floating btn-action light-green" href="{{ url('/') }}/post/'+value.post_id+'/edit"><i class="fa fa-edit pl-1"></i></a>';
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
                                        var profile_image = '{{ url('/').'/' }}'+value.image_path;
                                    }
                                    else{
                                        var profile_image = "url('/').'/img/avatar.png";
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
                                        html +='<a class="btn-floating btn-action light-green" href="{{ url('/') }}/post/'+value.post_id+'/edit"><i class="fa fa-edit pl-1"></i></a>';
                                        html +='<a class="btn-floating btn-action green" href="{{ route('image') }}/'+value.post_id+'"><i class="fa fa-eye pl-1"></i></a>';
                                        html +='<a class="btn-floating btn-action red" onclick="show_comment_box('+value.post_id+')"><i class="fa fa-comment-o pl-1"></i></a>';
                                        html +='</div>';

                                        html +='<div class="view overlay mt-4" align="center">';
                                            html +='<div class="lightgallery mb-4">';
                                                html +='<p>এই অ্যালবামের মোট '+Object.keys(value.images).length+'টি ছবি থেকে <span class="slidercount">1</span>নং ছবি</p>';
                                                html +='<ul class="lightSlider">'; // slidercount
                                                $.each(value.images, function( index, image ) {
                                                    var image_url =  '{{ url('/').'/' }}'+image.image_path;
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
                                        var profile_image = "{{ url('/').'/' }}"+value.image_path;
                                    }
                                    else{
                                        var profile_image = "url('/').'/img/avatar.png";
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
                                        html +='<a class="btn-floating btn-action light-green" href="{{ url('/') }}/post/'+value.post_id+'/edit"><i class="fa fa-edit pl-1"></i></a>';
                                        html +='<a class="btn-floating btn-action green" href="{{ route('video') }}/'+value.post_id+'"><i class="fa fa-eye pl-1"></i></a>';
                                        html +='<a class="btn-floating btn-action red" onclick="show_comment_box('+value.post_id+')"><i class="fa fa-comment-o pl-1"></i></a>';
                                        html +='</div>';

                                        $.each(value.videos, function( index, video ) {
                                            var video_url =  '{{ url('/').'/' }}'+video.video_path;

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
        $("#album_upload_feedback").html("<h5 class='red-text font-weight-bold mt-3'>প্রিভিউ ছবি</h5><small class='grey-text mb-3'>নিম্নলিখিত ফাঙ্কশনালিটিজ শুধুমাত্র প্রিভিউ এর জন্য! আপনি যদি ইমেজ এর একটি ভিন্ন সেট চান তাহলে আবার আপনার ছবি নির্বাচন করুন! ইমেজ আকার <strong>2MB</strong> এর বেশী হতে পারবেনা!</small><hr>");
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

      (function() {
        $('.upload_album').ajaxForm({
          beforeSend: function() {
            $('#image_error_message').delay(5000).empty();
            $('#album_upload_feedback').fadeOut('fast', function() {
                $(this).html("<div class='progress md-progress' style='height: 20px'><div class='progress-bar bg-success progress-bar-striped progress-bar-animated' role='progressbar' style='width: 0%; height: 20px' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'>0%</div></div>").fadeIn('slow');
            });
          },
          uploadProgress: function(event, position, total, percentComplete) {
            percentVal = percentComplete + '%';
            $('#album_upload_feedback').html("<div class='progress md-progress' style='height: 20px'><div class='progress-bar bg-success progress-bar-striped progress-bar-animated' role='progressbar' style='width: "+percentVal+"; height: 20px' aria-valuenow='"+percentVal+"' aria-valuemin='0' aria-valuemax='100'>"+percentVal+"</div></div>");
          },
          success: function() {
            $('#album_upload_feedback').html("<div class='progress md-progress' style='height: 20px'><div class='progress-bar bg-success progress-bar-striped progress-bar-animated' role='progressbar' style='width: 100%; height: 20px' aria-valuenow='100%' aria-valuemin='0' aria-valuemax='100'>100%</div></div>");   
          },
          error: function() {
            $("#album_upload_feedback").html("<h5 class='mt-1 mb-2 red-text text-center'><i class='fa fa-warning'></i> ছবি আপলোড করা যাচ্ছে না!!</h5><p class='mt-1 mb-2 light-blue-text text-center'>সার্ভারে সমস্যার সম্মুখীন হয়েছে।! অনুগ্রহপূর্বক আবার চেষ্টা করুন!</p>").fadeIn("slow");        
          },
          complete: function(xhr) {
            $(".input_album").val(null);
            $("#image_description").empty().val("");
            $("#selected_images_names").empty().val("");
            $('#album_upload_feedback').fadeOut('slow', function() {
                $(this).empty();
            });
            var json = JSON.parse(xhr.responseText);
            if(json.response == 'error'){
                for( var i = 0; i<json.message.length; i++){
                    showNotification("এরর!", json.message[i], "#", "danger", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                }

            }
            else{
                for( var i = 0; i<json.message.length; i++){
                    showNotification("সাফল্য!", json.message[i], "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                }
            }

            var last_id = $('#last_id').val();
            $('#last_id').val(parseInt(last_id)+1);

            getPost(parseInt(last_id)+1,'init');
          }
        }); 
      })();

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
                    $(this).empty();
                });
                var json = JSON.parse(xhr.responseText);
                if(json.response == 'error'){
                    for( var i = 0; i<json.message.length; i++){
                        showNotification("এরর!", json.message[i], "#", "danger", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                    }

                }
                else{
                    showNotification("সাফল্য!", json.message, "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                }

                var last_id = $('#last_id').val();
                $('#last_id').val(parseInt(last_id)+1);

                getPost(parseInt(last_id)+1,'init');
              }
            }); 
        })();


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
                            showNotification("সতর্কতা!", "আপনার পছন্দ মুছে ফেলা হয়েছে", "#", "warning", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                        }
                        else if($('#p_like_ico_'+post_id).hasClass("fa fa-thumbs-o-up")){
                            $('#p_like_ico_'+post_id).removeClass('fa fa-thumbs-o-up').addClass('fa fa-thumbs-up');
                            showNotification("সাফল্য!", "আপনি এই পোস্টটি পছন্দ করেছেন", "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
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

    </script>
@endsection



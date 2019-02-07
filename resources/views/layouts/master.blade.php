<!DOCTYPE html>
<html lang="en">

  <!-- Header -->
  <head>
    @include('layouts.partials.meta')

    <!-- Favicon-->
    <link rel="icon" href="{{{ asset('favicon.png') }}}"/"/>

    <title>@yield('title') আমার নেতা || আপনার নেতাদের সাথে সংযোগ স্থাপন করুন</title>

    <!-- Font Awesome -->
    {{ Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}

    <!-- Google Icons -->
    {{ Html::style('https://fonts.googleapis.com/icon?family=Material+Icons') }}

    <!-- Bootstrap core CSS -->
    {{ Html::style('css/bootstrap.min.css') }}

    @include('layouts.partials.styles')
    
    @yield('extra-css')

  </head>
  <!-- #ENDS# Header -->

  <body>
    
  	@include('layouts.partials.loader')
  	@include('layouts.partials.navigation')

    <div class="container home-container my-5">
        <div class="row justify-content-center">
            <div class="col-md-3 mb-3">
              @include('layouts.partials.sidemenu')
            </div>
            <div class="col-md-9 mb-3 order-first order-sm-12">
              <a href="#list-navigation-menu" class="btn btn-red btn-sm mb-3 navigation-button"><i class="fa fa-list pr-2"></i>মেনু প্রদর্শন</a>
              <!-- Content -->
              @yield('content')
              <!-- #ENDS# Content -->
            </div>
        </div>
    </div>



<!-- alert message START -->
<div class="modal fade alert" role="dialog" id="alert-modal" style="z-index: 99999">
    <div class="modal-dialog" style="width: 350px">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body text-center">
                <div id="alert-error-msg">
                    <div>
                        <i class="material-icons">error_outline</i>
                    </div>
                    <p class="text-danger"></p>
                </div>
                <div id="alert-success-msg">
                    <div>
                        <i class="material-icons">check</i>
                    </div>
                    <p class="text-success"></p>
                </div>
                <button class="btn btn-primary" data-dismiss="modal" id="alert-ok">ok</button>
            </div>
        </div>
    </div>
</div>
<!-- alert message End -->



<!-- warning message START -->
<div class="modal fade alert" role="dialog" id="warning-modal" style="z-index: 99999">
    <div class="modal-dialog" style="width: 350px">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body text-center">
                <div id="alert-error-msg">
                    <div>
                        <i class="material-icons">error_outline</i>
                    </div>
                    <p class="text-danger">
                        Are you sure you want to do this?
                    </p>
                    <input type="hidden" id="item_id">
                </div>
                <button class="btn btn-primary" id="warning_ok">Yes</button>
                <button class="btn btn-danger" data-dismiss="modal" id="alert-ok">No</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="page_type" value='all'>

<!-- alert message End -->

  	@include('layouts.partials.alerts')
    @include('layouts.partials.scrolltotop')

    <!-- Javascript -->

    <!-- Bootstrap core JavaScript -->
    {{Html::script('js/jquery.min.js')}}
    {{Html::script('js/jquery.form.js')}}

    <!-- Bootstrap tooltips -->
    {{Html::script('js/popper.min.js')}}

    <!-- Bootstrap core JavaScript -->
    {{Html::script('js/bootstrap.min.js')}}

    @include('layouts.partials.scripts')

    @yield('extra-script')

    <script>      

      function show_success_message($message){

          $('#alert-modal').modal('show');

          $('#alert-error-msg').hide();

          $('#alert-success-msg').show();

          $('#alert-success-msg p').html($message);

      }

      function show_error_message(message){

          $('#alert-modal').modal('show');

          $('#alert-error-msg').show();

          $('#alert-success-msg').hide();

          $('#alert-error-msg p').html(message);

      }

      $(document).ready(function(){
          set_new_request_count(); 

          
      });


      $(document).on('change','#division', function(){
          var division_id = $(this).val();
          set_district(division_id,'');
      });

      $(document).on('change','#district', function(){
          var district_id = $(this).val();
          set_thana(district_id,'');
      });

      $(document).on('change','#thana', function(){
          var thana_id = $(this).val();
          set_zip(thana_id,'');
      });

      function set_district(division_id,district_id){   
          $.ajax({
              type: "POST",
              url: "{{ url('district_by_division') }}",
              data: { _token: "{{ csrf_token() }}",division_id:division_id},
              dataType: "json",
              cache : false,
              success: function(data){
                  if(data.status == 200){
                      $('#district').material_select('destroy');
                      $('#district').html(data.options);
                      $('#district').val(district_id);
                      $('#district').material_select();
                  }
                  else{
                      alert(data);
                  }
              } ,error: function(xhr, status, error) {
                  alert(error);
              },
          });
      }

      function set_thana(district_id,thana_id){
          $.ajax({
              type: "POST",
              url: "{{ url('thana_by_district') }}",
              data: { _token: "{{ csrf_token() }}",district_id:district_id},
              dataType: "json",
              cache : false,
              success: function(data){
                  if(data.status == 200){
                      $('#thana').material_select('destroy');
                      $('#thana').html(data.options);
                      $('#thana').val(thana_id);
                      $('#thana').material_select();
                  }
                  else{
                      alert(data);
                  }
              } ,error: function(xhr, status, error) {
                  alert(error);
              },
          });
      }

      function set_zip(thana_id,zip_id){
          $.ajax({
              type: "POST",
              url: "{{ url('zip_by_thana') }}",
              data: { _token: "{{ csrf_token() }}",thana_id:thana_id},
              dataType: "json",
              cache : false,
              success: function(data){
                  if(data.status == 200){
                      $('#zip').material_select('destroy');
                      $('#zip').html(data.options);
                      $('#zip').val(zip_id);
                      $('#zip').material_select();
                  }
                  else{
                      alert(data);
                  }
              } ,error: function(xhr, status, error) {
                  alert(error);
              },
          });
      }


      function set_new_request_count(){   
          $.ajax({
              type: "POST",
              url: "{{ url('new_request_ajax') }}",
              data: { _token: "{{ csrf_token() }}"},
              dataType: "json",
              cache : false,
              success: function(data){
                  if(data.status == 200){
                    if(data.new_request !=0){
                      $('#request_count').show();
                      $('#request_count').html(data.new_request);
                    }
                    else{
                      $('#request_count').hide();
                      $('#request_count').html(0);
                    }
                  }
                  else{
                      
                  }
              } ,error: function(xhr, status, error) {
                  alert(error);
              },
          });
      }

      function checkImage(image){
        var profile_image = "{{ url('/img/avatar.png') }}";
        $.ajax({
            url: "{{ url('/').'/' }}"+image,
            type:'HEAD',
            async: false,
            success:function(){
                profile_image = "{{ url('/').'/' }}"+image; 
            }
        });
        return profile_image;
      }

      function getPost(last_id,type,page){
            $('#page_type').val(page); // Set current page name/type
            if(last_id > 0){  
                var html = '';
                $.ajax({
                    type: "POST",
                    url: "{{ url('get_post_ajax') }}",
                    data: { _token: "{{ csrf_token() }}",last_id:last_id,type:page},
                    dataType: "json",
                    cache : false,
                    success: function(data){
                        if(data.status == 200){                   
                            $.each(data.posts, function( index, value ) {
                                if(value.post_type=='text' && (page=='all' || page=='text')){
                                    /*
                                    *Text post
                                    */

                                    var profile_image = checkImage(value.image_path);

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
                                                html +='<div class="right-side-meta">'+$.format.date(value.created_at, 'ddd d MMMM yyyy, h:ss a')+'</div>';
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
                                if(value.post_type=='photo' && (page=='all' || page=='album')){  
                                    /*
                                    *Image post
                                    */
                                    image_post = true;

                                    var profile_image = checkImage(value.image_path);

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
                                                html +='<div class="right-side-meta">'+$.format.date(value.created_at, 'ddd d MMMM yyyy, h:ss a')+'</div>';
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
                                else if(value.post_type=='video' && (page=='all' || page=='video')){  
                                    /*
                                    * Video post
                                    */
                                    video_post = true;

                                    var profile_image = checkImage(value.image_path);

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
                                                html +='<div class="right-side-meta">'+$.format.date(value.created_at, 'ddd d MMMM yyyy, h:ss a')+'</div>';
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


        
        $(document).on('submit', '#text_post_form', function(event){
            event.preventDefault();
            var post_text = $('#post_text').val();
            var page = $('#page_type').val();
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
                            showNotification("সফল!", "পোস্টটি সফলভাবে শেয়ার করা হয়েছে", "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');

                            var last_id = $('#last_id').val();
                            $('#last_id').val(parseInt(last_id)+1);

                            getPost(parseInt(last_id)+1,'init',page);
                        }
                        else{
                            showNotification("এরর!", data.reason, "#", "danger", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
            else{
                showNotification("এরর!", validate, "#", "danger", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
            }
        });

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
                            showNotification("সাকসেস!", data.reason, "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                            var comment_from = $('#comment_from').val();
                            $('#post_id').val('');
                            $('#comment_text').val('');
                            //tinymce.get('#comment_text').setContent('');
                            $('#modalSubscriptionForm').modal('hide');

                            var current_comment = $('#p_comment_'+post_id).text();
                            var new_comment = parseInt(current_comment)+1;
                            $('#p_comment_'+post_id).text(new_comment);

                            setTimeout(function(){
                                $('#alert-modal').modal('hide');
                                if(comment_from=='post_detail'){
                                  location.reload();
                                }
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
                        var like_from = $('#comment_from').val();
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
                        
                        if(like_from=='post_detail'){
                          location.reload();
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
                    $("#album_upload_feedback").html("<h5 class='mt-1 mb-2 red-text text-center'><i class='fa fa-warning'></i> ছবি আপলোড করা যাচ্ছে না!</h5><p class='mt-1 mb-2 light-blue-text text-center'>সার্ভারে কিছু ত্রুটি হয়েছে।! প্রতিক্রিয়া পর্যন্ত অপেক্ষা করুন ..</p>").fadeIn("slow");        
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
                    var content_type = $('#content_type').val();
                    $('#last_id').val(parseInt(last_id)+1);

                    getPost(parseInt(last_id)+1,'init', content_type);
                }
            }); 
        })();

          //  Jquery form for uploading video and showing progress

        (function() {
            $('.share_video').ajaxForm({
              beforeSend: function() {
                $('#video_error_message').delay(5000).empty();
                $("#video_upload_feedback").empty().append("<p class='mt-1 mb-2 orange-text'>Connecting with server...</p>");
              },
              uploadProgress: function() {
                $("#video_upload_feedback").empty().append("<p class='mt-1 mb-2 orange-text'>ভিডিও সংরক্ষণ করা হচ্ছে! অনুগ্রহপূর্বক অপেক্ষা করুন...</p><div class='progress primary-color-dark'><div class='indeterminate'></div></div>");
              },
              success: function() {
                $("#video_upload_feedback").empty().append("<p class='mt-1 mb-2 green-text'>ভিডিও সংরক্ষণ করা হয়েছে!। প্রতিক্রিয়া পর্যন্ত অপেক্ষা করুন ..</p><div class='progress primary-color-dark'><div class='indeterminate'></div></div>").fadeIn("slow");        
              },
              error: function() {
               $("#video_upload_feedback").empty().append("<p class='mt-1 mb-2 red-text'>সার্ভারে কিছু ত্রুটি হয়েছে।! প্রতিক্রিয়া পর্যন্ত অপেক্ষা করুন ..</p>").fadeIn("slow");        
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
                var content_type = $('#content_type').val();
                $('#last_id').val(parseInt(last_id)+1);

                getPost(parseInt(last_id)+1,'init', content_type);
              }
            }); 
        })();
    </script>

  </body>

</html>

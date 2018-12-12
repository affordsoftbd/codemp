@extends('layouts.master')

@section('title', "প্রোফাইল || ভিডিও ||")

@section('content')

@include('profile.profile')
<!-- Nav tabs -->
 <ul class="nav nav-tabs md-tabs nav-justified red my-5" role="tablist">
     <li class="nav-item">
         <a class="nav-link" href="{{ route('profile.posts', Session::get('username')) }}" role="tab"><i class="fa fa-edit fa-sm pr-2"></i> পোস্ট সমূহ</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('profile.albums', Session::get('username')) }}" role="tab"><i class="fa fa-file-image-o fa-sm pr-2"></i> অ্যালবাম সমূহ</a>
     </li>
     <li class="nav-item">
         <a class="nav-link active" data-toggle="tab" href="javascript:void(0)" role="tab"><i class="fa fa-file-movie-o fa-sm pr-2"></i> ভিডিও সমূহ</a>
     </li>
 </ul>
 <!-- Tab panels -->
 <div class="tab-content">

    <div id="post_list"></div>
    <div id="get_last_id" style="display: none">{{ $last_id }}</div>

    <!--Pagination-->
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
                    {{ Form::button('পোস্ট', ['type' => 'submit', 'class' => 'btn btn-danger mt-1 btn-sm'] ) }}
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
            var last_post_id = {{$last_id}}
            ///var last_post_id = $('#get_last_id').text();
            $('#last_load').val(last_post_id);
            $('#last_id').val(last_post_id);
            getPost(last_post_id,'init','video');
        });

        $(document).on('click','.load_more_button',function(){
            var last_load = $('#last_load').val(); 
            $('#last_load').val(parseInt(last_load)-5);
            getPost(parseInt(last_load)-5,'','video');
        });

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

            getPost(parseInt(last_id)+1,'init','video');
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

                getPost(parseInt(last_id)+1,'init','video');
              }
            }); 
        })();

    </script>
@endsection



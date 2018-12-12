@extends('layouts.master')

@section('title', "ফিড ||")

@section('content')

<div class="card border message_area border-light">
    <div class="card-body">
        <h4 class="red-text"><i class="fa fa-share-alt fa-sm pr-2"></i>আপনি কি ভাবছেন?</h4><hr>
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
                    <i class="fa fa-file-movie-o fa-sm pr-2"></i>ভিডিও
                </a>
            </li>
        </ul>
         <!-- Tab panels -->
         <div class="tab-content">
            <!--Panel 1-->
            <div class="tab-pane fade in show active" id="panel1" role="tabpanel">                

                <div class="alert alert-success" id="post_success" style="display:none"></div>
                <div class="alert alert-danger" id="post_danger" style="display:none"></div>

                {!! Form::open(['method' => 'post', 'id' => 'text_post_form', 'class'=>'md-form login-form']) !!}
                    <div align="right">
                        <!-- Material inline 1 -->
                        <div class="form-check form-check-inline">
                          <input type="radio" class="form-check-input" id="privacy1" name="post_privacy" value="public" checked>
                          <label class="form-check-label" for="privacy1">সর্বজনীন</label>
                        </div>

                        <!-- Material inline 2 -->
                        <div class="form-check form-check-inline">
                          <input type="radio" class="form-check-input red" id="privacy2" name="post_privacy" value="followers">
                          <label class="form-check-label" for="privacy2">অনুসারীগণ</label>
                        </div>
                    </div>

                    <div class="md-form">
                        {!! Form::textarea('additional_details', null, array('class'=>'editor','name'=>'post_text','id'=>'post_text')) !!}
                    </div>
                    <div class="text-center my-4">
                        {!! Form::button('শেয়ার<i class="fa fa-share fa-sm pl-2"></i>', array('type' => 'submit', 'class' =>'btn btn-danger btn-md pull-right')) !!}
                    </div>
                {!! Form::close() !!}
            </div>
            <!--/.Panel 1-->
            <!--Panel 2-->
            <div class="tab-pane fade" id="panel2" role="tabpanel">
                {!! Form::open(['method' => 'post', 'route' => ['image.save'], 'class'=>'md-form upload_album']) !!}
                    
                    <div align="right">
                        <!-- Material inline 1 -->
                        <div class="form-check form-check-inline">
                          <input type="radio" class="form-check-input" id="privacy3" name="post_privacy" value="public" checked>
                          <label class="form-check-label" for="privacy3">সর্বজনীন</label>
                        </div>

                        <!-- Material inline 2 -->
                        <div class="form-check form-check-inline">
                          <input type="radio" class="form-check-input red" id="privacy4" name="post_privacy" value="followers">
                          <label class="form-check-label" for="privacy4">অনুসারীগণ</label>
                        </div>
                    </div>

                    <div class="md-form">
                        <div class="file-field">
                            <div class="btn btn-danger btn-sm float-left">
                            <span>নির্বাচন</span>
                                {!! Form::file("images[]", ['class'=>'input_album', 'multiple'=>'true']) !!}
                            </div>
                            <div class="file-path-wrapper">
                                {!! Form::text('', null, ['class'=>'file-path validate', 'id'=>'selected_images_names', 'placeholder'=>'আপনার চিত্রগুলো নির্বাচন করুন']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="md-form">
                        {!! Form::textarea('description', null, array('class'=>'md-textarea form-control no-resize auto-growth', 'rows'=>'1', 'id'=>'image_description')) !!}
                        {!! Form::label('image_description', 'অ্যালবাম বিশদ') !!}
                    </div>
                    
                    <div class="text-center mt-4">
                        {{ Form::button('আপলোড<i class="fa fa-upload fa-sm pl-2"></i>', ['type' => 'submit', 'class' => 'btn btn-danger mt-1 btn-md'] ) }}
                    </div>
                    <div class="clearfix"></div>
                    <div id="album_upload_feedback" class="my-5"></div>
                {!! Form::close() !!}
            </div>
            <!--/.Panel 2-->
            <!--Panel 3-->
            <div class="tab-pane fade" id="panel3" role="tabpanel">
                <div id="video_error_message"></div>
                {!! Form::open(['method' => 'post', 'route' => ['video.save'], 'class'=>'md-form share_video']) !!}

                    <div align="right">
                        <!-- Material inline 1 -->
                        <div class="form-check form-check-inline">
                          <input type="radio" class="form-check-input radio-custom" id="privacy5" name="post_privacy" value="public" checked>
                          <label class="form-check-label" for="privacy5">সর্বজনীন</label>
                        </div>

                        <!-- Material inline 2 -->
                        <div class="form-check form-check-inline">
                          <input type="radio" class="form-check-input radio-custom" id="privacy6" name="post_privacy" value="followers">
                          <label class="form-check-label" for="privacy6">অনুসারীগণ</label>
                        </div>
                    </div>

                    <div class="md-form">
                        <div class="file-field">
                            <div class="btn btn-danger btn-sm float-left">
                            <span>নির্বাচন</span>
                                {!! Form::file("video", ['class'=>'input_video']) !!}
                            </div>
                            <div class="file-path-wrapper">
                                {!! Form::text('', null, ['class'=>'file-path validate', 'id'=>'selected_video_name', 'placeholder'=>'আপনার ভিডিওটি নির্বাচন করুন']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="md-form">
                        {!! Form::textarea('description', null, array('class'=>'md-textarea form-control no-resize auto-growth', 'rows'=>'1', 'id'=>'video_description')) !!}
                        {!! Form::label('video_description', 'ভিডিও বিবরণ') !!}
                    </div>
                    <div class="text-center mt-4">
                        {{ Form::button('আপলোড<i class="fa fa-upload fa-sm pl-2"></i>', ['type' => 'submit', 'class' => 'btn btn-danger mt-1 btn-md'] ) }}
                    </div>
                    <div class="clearfix"></div>
                    <div id="video_upload_feedback" class="my-5" align="center"></div>
                {!! Form::close() !!}
            </div>
         </div>
    </div>
</div>

<div id="post_list"></div>


<input type="hidden" name="last_load" id="last_load">
<input type="hidden" name="last_id" id="last_id">
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
<!-- <div class="row justify-content-center load_more_spinner" id="load_more_spinner">
    <i class="fa fa-spinner fa-spin my-5 content_load"></i>
</div> -->

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
                    {{ Form::button('<i class="fa fa-plus pr-2"></i>পোস্ট', ['type' => 'submit', 'class' => 'btn btn-danger mt-1 btn-sm'] ) }}
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

@section('extra-script')
    <script>

        $(document).ready(function(){           
          var last_post_id = {{$last_id}}
          $('#last_load').val(last_post_id);
          $('#last_id').val(last_post_id);
          getPost(last_post_id,'init','all');
        });
      
      $(document).on('click','.load_more_button',function(){
          var last_load = $('#last_load').val(); 
          $('#last_load').val(parseInt(last_load)-5);
          getPost(parseInt(last_load)-5,'','all');
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

            getPost(parseInt(last_id)+1,'init','all');
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

                getPost(parseInt(last_id)+1,'init','all');
              }
            }); 
        })();

    </script>
@endsection



@extends('layouts.master')

@section('title', "খবর ||")

@section('content')

<!-- Grid row -->
  <div class="row">

    <!-- News -->
    <div class="col-lg-9 mb-4">

        <!-- Card -->
        <div class="card card-cascade wider reverse">

          <!-- Card image -->
          <div class="view view-cascade overlay">
            <img class="card-img-top" src="{{ file_exists($news->image_path) ? asset($news->image_path) : 'http://via.placeholder.com/1000x500?text=News+Image' }}" alt="Sample image">
            <a href="#!">
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>

          <!-- Card content -->
          <div class="card-body card-body-cascade text-center">

            <!-- Title -->
            <h2 class="font-weight-bold"><a>{{ $news->title }}</a></h2>
            <!--a href="#!" class="red-text"><h6 class="font-weight-bold mb-3"><i class="fa fa-tag pr-2"></i>Adventure</h6></a-->
            <!-- Data -->
            <p>{{ $news->created_at->format('l d F Y, h:i A') }}</p>

          </div>
          <!-- Card content -->

        </div>
        <!-- Card -->

        <!-- Excerpt -->
        <div class="mt-5">

          {{ $news->description }}

        </div>

        <h4 class="font-weight-bold mt-5">মন্তব্য</h4><hr>

        <div class="row">
          @foreach($news->comments as $comment)
          <div class="col-xl-1 col-lg-2 col-md-2 my-3 post_creator">
            <img src="{{ file_exists($comment->user->detail->image_path) ? asset($comment->user->detail->image_path) : url('/').'/img/avatar.png' }}" class="rounded-circle z-depth-1-half image-thumbnail my-3">
          </div>
          <div class="col-xl-11 col-lg-10 col-md-10 my-3">
              <div class="card border message_area border-light">
                  <div class="card-body">
                    <h6 class="font-weight-bold">{{ $comment->user->first_name." ".$comment->user->last_name }}</h6>
                    <small class="grey-text">{{ date('l d F Y, h:i A',strtotime($comment->created_at)) }}</small>
                    <hr>
                    <div class="news_comment_area" data-url-edit="{{ route('news.comment.edit', $comment->global_news_comment_id) }}" data-url-update="{{ route('news.comment.update', $comment->global_news_comment_id) }}">
                      <?php echo htmlspecialchars_decode($comment->comment); ?>
                    </div>
                    @if($user->id == $news->user_id || $comment->user_id == $user->id && (strtotime($comment->created_at) + 3600) > time())
                        <div class="clearfix"></div>
                        <div class="news_options">
                            {!! Form::open(['method' => 'delete', 'route' => ['news.comment.delete', $comment->global_news_comment_id]]) !!}
                                <div class="btn-group mb-3 mx-3 pull-right" role="group" aria-label="Basic example">
                                  <button type="button" class="btn btn-light-green btn-sm btn-rounded edit_comment_button"><i class="fa fa-edit"" aria-hidden="true"></i></button>
                                  {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('class' => 'btn btn-deep-orange btn-sm btn-rounded form_warning_sweet_alert', 'title'=>'আপনি কি নিশ্চিত?', 'text'=>'আপনার মন্তব্য হারিয়ে যাবে!', 'confirmButtonText'=>'হ্যাঁ, মন্তব্য মুছে দিন!', 'type'=>'submit')) !!}
                                </div>
                            {!! Form::close() !!} 
                        </div>
                    @endIf
                  </div>
              </div>
          </div>
          @endforeach
        </div>

        <div class="alert alert-success" id="comment_success" style="display:none"></div>
        <div class="alert alert-danger" id="comment_error" style="display:none"></div>
        <div class="row add_comment">
          <div class="col-xl-1 col-lg-2 col-md-2 my-3 post_creator">
            <img src="{{ file_exists($user->detail->image_path) ? asset($user->detail->image_path) : url('/').'/img/avatar.png' }}" class="rounded-circle z-depth-1-half image-thumbnail my-3">
          </div>
          <div class="col-xl-11 col-lg-10 col-md-10 my-3">
            <form id="comment_form" class="login-form" method="post" action="">
                {{ csrf_field() }}  
                <input type="hidden" name="news_id" value="{{ $news->global_news_id }}">
                <div class="md-form">
                    {!! Form::textarea('additional_details', null, array('class'=>'editor','name'=>'comment_text','id'=>'comment_text')) !!}
                </div>
                <div class="text-center my-4">
                    {!! Form::button('<i class="fa fa-plus pr-2"></i>পোস্ট', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
                </div>
            </form>
          </div>
        </div>

    </div>

    <!-- Navigate -->
    <div class="col-lg-3 mb-4">
      @include('news.sort')
    </div>

  </div>

@endsection

@section('extra-script')
    <script>
        
        $(document).on('submit', '#comment_form', function(event){
            event.preventDefault();
            var comment_text = $('#comment_text').val();
            var validate = '';

            if(comment_text==''){
                validate = validate+"দয়া করে কিছু লিখুন";
            }

            if(validate==''){

                var formData = new FormData($('#comment_form')[0]);
                var url = '{{ url('save_news_comment') }}';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    async: false,
                    success: function (data) {
                        if(data.status == 200){

                            showNotification("সাকসেস!", data.reason, "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                            setTimeout(function(){
                              location.reload();
                          }, 2000);
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

      $(document).ready(function(){

        $(document).on('click', '.edit_comment_button', function(){
            var url = $(this).closest('div.card-body').find('.news_comment_area').data("url-edit");
            var div = $(this).closest('div.card-body').find('.news_comment_area');
            var html = '';
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
              }
            });
            $.ajax({
              url: url,
              type: 'GET',
              dataType: 'JSON',
              beforeSend: function(){
                div.html("<center><h1><i class='fa fa-spinner fa-spin my-5'></i></h1></center>");
              },
              success:function(response){
                div.hide().html('<textarea class="editor" name="comment">'+response+'</textarea><button class="btn btn-sm btn-danger my-3 save_comment"><i class="fa fa-check pr-2"></i>হালনাগাদ</button>').fadeIn('slow');
                setTinyMce();
                $(".news_options").hide();
                $(".add_comment").hide();
              }
            });
        });

        $(document).on('click', '.save_comment', function(){
            var url = $(this).closest('div.card-body').find('.news_comment_area').data("url-update");
            var div = $(this).closest('div.card-body').find('.news_comment_area');
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
              }
            });
            $.ajax({
              url: url,
              type: 'PUT',
              data: {
                'comment': tinyMCE.activeEditor.getContent()
              },
              dataType: 'JSON',
              beforeSend: function(){
                div.html("<center><h1><i class='fa fa-spinner fa-spin my-5'></i></h1></center>");
              },
              success:function(response){
                div.html(response);
                $(".news_options").show();
                $(".add_comment").show();
                showNotification("সাফল্য!", "মন্তব্য হালনাগাদ করা হয়েছে!", "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp'); 
              },
              error: function(response){
                div.hide().html('<textarea class="editor" name="comment">'+tinyMCE.activeEditor.getContent()+'</textarea><button class="btn btn-sm btn-danger save_comment"><i class="fa fa-check pr-2"></i>হালনাগাদ</button>').fadeIn('slow');
                setTinyMce();
                showNotification("আপডেট করার সময় ত্রুটি!", "আপনার মন্তব্য আপডেট করা যাবে না! আপনার মন্তব্য খালি না তা নিশ্চিত করুন!", "#", "danger", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp'); 
              }
            });
        });

    });
    </script>
@endsection



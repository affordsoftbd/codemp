@extends('layouts.master')

@section('title', "অ্যালবাম বিস্তারিত ||")

@section('content')

<div class="row">
    <div class="col-xl-1 col-lg-2 col-md-2 post_creator">
        <img src="{{ file_exists($post->image_path) ? asset($post->image_path) : url('/').'/img/avatar.png' }}" class="img-fluid rounded-circle z-depth-1-half image-thumbnail my-3">
    </div>
    <div class="col-xl-6 col-lg-4 col-md-4">
        <h4 class="font-weight-bold green-text">{{ $post->first_name." ".$post->last_name}}</h4>
        <small class="red-text">{{ date('l d F Y, h:i A',strtotime($post->created_at)) }}</small>
    </div>
    <div class="col-xl-5 col-lg-6 col-md-6" align="right">
         {!! Form::open(['route' => ['post.delete', $post->post_id], 'method'=>'delete']) !!}
            <a href="{{ route('post.edit', $post->post_id) }}" class="btn btn-light-green btn-sm">
                <i class="fa fa-edit"></i>
            </a>
            {!! Form::button('<i class="fa fa-trash"" aria-hidden="true"></i>', array('class' => 'btn btn-deep-orange btn-sm form_warning_sweet_alert', 'title'=>'আপনি কি নিশ্চিত?', 'text'=>'এই পোস্টটি আর উদ্ধার করা যাবে না!', 'confirmButtonText'=>'হ্যাঁ, পোস্টটি মুছে দিন!', 'type'=>'submit')) !!}
            <!--Likes-->
            <button id="like_btn" type="button" class="btn {{ ($my_like==0)? 'btn-yellow' : 'btn-green' }} btn-sm" 
            onclick="save_post_like({{ $post->post_id }})"><i class="fa fa-thumbs-o-up"></i></button>
            <span class="counter" id="p_like_{{ $post->post_id }}">{{ count($post->likes) }}</span>
            <!--Comments-->
            <a href="#total_comments" class="btn btn-red btn-sm">
                <i class="fa fa-comments"></i>
            </a>
            <span class="counter">{{ count($post_comments) }}</span>
        {!! Form::close() !!}
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12">
        <hr>
        <?php echo htmlspecialchars_decode($post->description); ?>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="item mt-5" id="aniimated-thumbnials" align="center">
            <ul id="content-slider" class="content-slider">
                @foreach($post->images as $image)
                <li>
                    <a href="{{ file_exists($image->image_path) ? asset($image->image_path) : 'http://via.placeholder.com/450' }}" data-sub-html="চিত্র {{ $loop->iteration }}"> 
                        <img class="img-fluid" src="{{ file_exists($image->image_path) ? asset($image->image_path) : 'http://via.placeholder.com/450' }}" alt="{{ file_exists($image->image_path) ? asset($image->image_path) : 'http://via.placeholder.com/450' }}">
                    </a>
                    {!! Form::open(['route' => ['image.delete', $image->post_image_id], 'method'=>'delete']) !!}
                        {!! Form::button('<i class="fa fa-trash"" aria-hidden="true"></i>', array('class' => 'btn btn-red btn-sm form_warning_sweet_alert', 'title'=>'আপনি কি নিশ্চিত?', 'text'=>'এই ছবি আর উদ্ধার করা যাবে না!', 'confirmButtonText'=>'হ্যাঁ, ছবি মুছে দিন!', 'type'=>'submit')) !!}
                    {!! Form::close() !!}
                </li>
                @endforeach
            </ul>
            <button type="button" class="btn green btn-sm my-5" data-toggle="modal" data-target="#updateimage">
              <i class="fa fa-plus fa-sm pr-2"" aria-hidden="true"></i>একটি নতুন ইমেজ যোগ করুন
            </button>
            <hr>
        </div>
        <h5 class="grey-text font-weight-bold" id="total_comments">মোট মন্তব্য: {{ count($post_comments) }}</h5>
    </div>

    @foreach($post_comments as $comment)
    <div class="col-xl-1 col-lg-2 col-md-2 my-3 post_creator">
        <img src="{{ file_exists($post->image_path) ? asset($post->image_path) : url('/').'/img/avatar.png' }}" class="rounded-circle z-depth-1-half image-thumbnail my-3">
    </div>
    <div class="col-xl-11 col-lg-10 col-md-10 my-3">
        <div class="card border message_area border-light">
            <div class="card-body">
                <h6 class="font-weight-bold">{{ $comment->first_name." ".$comment->last_name}}</h6>
                <small class="grey-text">{{ date('l d F Y, h:i A',strtotime($comment->created_at)) }}</small>
                <hr>
                <div class="post_comment_area" data-url-edit="{{ route('post.comment.edit', $comment->post_comment_id) }}" data-url-update="{{ route('post.comment.update', $comment->post_comment_id) }}">
                    <?php echo htmlspecialchars_decode($comment->comment); ?>
                </div>
                @if($user->id == $post->user_id || $comment->user_id == $user->id && (strtotime($comment->created_at) + 3600) > time())
                    <div class="clearfix"></div>
                    <div class="post_options">
                        {!! Form::open(['method' => 'delete', 'route' => ['post.comment.delete', $comment->post_comment_id]]) !!}
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

    <div class="col-xl-12 col-lg-12 col-md-12 mt-5 text-center">
        <h6 class="font-weight-bold red-text">আপনার মন্তব্য যোগ করুন</h6>
    </div>
    <div class="col-xl-1 col-lg-2 col-md-2">
        <img src="{{ file_exists(Session::get('image_path')!='') ? asset(Session::get('image_path')!='') : url('/').'/img/avatar.png' }}" class="img-fluid rounded-circle z-depth-1 image-thumbnail my-3">
    </div>
    <div class="col-xl-11 col-lg-10 col-md-10">
        <div class="alert alert-success" id="comment_success" style="display:none"></div>
        <div class="alert alert-danger" id="comment_error" style="display:none"></div>
        <form id="comment_form" class="login-form" method="post" action="">
            {{ csrf_field() }}  
            <input type="hidden" name="post_id" value="{{ $post->post_id }}">
            <div class="md-form">
                {!! Form::textarea('additional_details', null, array('class'=>'editor','name'=>'comment_text','id'=>'comment_text')) !!}
            </div>
            <div class="text-center my-4">
                {!! Form::button('<i class="fa fa-plus pr-2"></i>পোস্ট', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
            </div>
        </form>
        <div class="clearfix"></div>
    </div>

</div>

<!-- Image Modal -->
<div class="modal fade" id="updateimage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">অ্যালবামে ছবি যোগ করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body image_modal">
              <div class="text-center">
                <img src="http://placehold.it/200" class="img-fluid z-depth-1 preview_input" alt="Responsive image">
                <p class="text-center mt-4">সর্বাধিক অনুমোদিত আকার:: 5 এমবি</p>
              </div>
                {!! Form::open(['class'=>'md-form upload_image', 'method' => 'post', 'route' => ['image.add'], 'enctype' => 'multipart/form-data']) !!}
                    {!! Form::hidden('post_id', $post->post_id) !!}
                    <div class="file-field">
                      <div class="btn btn-success btn-sm float-left">
                          <span>নির্বাচন</span>
                          {!! Form::file("image", ['class'=>'input_image', 'accept'=>'image/*']) !!}
                      </div>
                      <div class="file-path-wrapper">
                          {!! Form::text('', null, ['class'=>'file-path validate', 'placeholder'=>'আপনার চিত্র নির্বাচন করুন']) !!}
                      </div>
                    </div>
                    <div class="text-center mt-4">
                      {{ Form::button('আপলোড <i class="fa fa-upload ml-1"></i>', ['type' => 'submit', 'class' => 'btn btn-danger mt-1 btn-md'] ) }}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- Image Modal -->

@endsection

@section('extra-script')
    <script>

        $(document).ready(function(){

        $(document).on('click', '.edit_comment_button', function(){
            var url = $(this).closest('div.card-body').find('.post_comment_area').data("url-edit");
            var div = $(this).closest('div.card-body').find('.post_comment_area');
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
                $(".post_options").hide();
                $(".add_comment").hide();
              }
            });
        });

        $(document).on('click', '.save_comment', function(){
            var url = $(this).closest('div.card-body').find('.post_comment_area').data("url-update");
            var div = $(this).closest('div.card-body').find('.post_comment_area');
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
                $(".post_options").show();
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



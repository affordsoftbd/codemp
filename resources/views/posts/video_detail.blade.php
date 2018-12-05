@extends('layouts.master')

@section('title', "ভিডিও বিস্তারিত ||")

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
        <div class="view overlay my-3">
            @foreach($post->videos as $video)
            <video id="my-video" class="video-js" preload="auto" controls data-setup="{}" style="width:100%">
              <source src="{{ asset($video->video_path) }}" type="video/mp4">
            </video>
            @endforeach
        </div> 
        <hr>
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
                <?php echo htmlspecialchars_decode($comment->comment); ?>
            </div>
        </div>
    </div>
    @endforeach

    <div class="col-xl-12 col-lg-12 col-md-12 mt-5 text-center">
        <h6 class="font-weight-bold red-text">আপনার মন্তব্য যোগ করুন</h6>
    </div>
    <div class="col-xl-1 col-lg-2 col-md-2">
        <img src="{{ file_exists(Session::get('image_path')) ? asset(Session::get('image_path')) : url('/').'/img/avatar.png' }}" class="img-fluid rounded-circle z-depth-1 image-thumbnail my-3">
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

@endsection

@section('extra-script')
    <script>

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
                        if(data.like<1){
                            $('#like_btn').removeClass('btn-green').addClass('btn-yellow');
                            showNotification("সতর্কতা!", "আপনার পছন্দ মুছে ফেলা হয়েছে", "#", "warning", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                        }
                        else{
                            $('#like_btn').removeClass('btn-yellow').addClass('btn-green');
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
        
        $(document).on('submit', '#comment_form', function(event){
            event.preventDefault();
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
                            location.reload();
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
    </script>
@endsection



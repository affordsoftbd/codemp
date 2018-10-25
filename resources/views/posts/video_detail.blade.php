@extends('layouts.master')

@section('title', "ভিডিও বিস্তারিত ||")

@section('content')

<div class="row">
    <div class="col-xl-1 col-lg-2 col-md-2 post_creator">
        @if($post->image_path!='')
            <img src="{{ url('/').$post->image_path}}" class="img-fluid rounded-circle z-depth-1-half">
        @else
            <img src="{{ url('/').'/img/avatar.png'}}" class="img-fluid rounded-circle z-depth-1-half">
        @endif
        
    </div>
    <div class="col-xl-6 col-lg-4 col-md-4">
        <h6 class="font-weight-bold">{{ $post->first_name." ".$post->last_name}}</h6>
        <small class="grey-text">{{ $post->created_at}}</small>
    </div>
    <div class="col-xl-5 col-lg-6 col-md-6" align="right">
         {!! Form::open(['route' => ['post.delete', $post->post_id], 'method'=>'delete']) !!}
            <a href="{{ route('post.edit', $post->post_id) }}" class="btn btn-light-green btn-sm">
                <i class="fa fa-edit"></i>
            </a>
            {!! Form::button('<i class="fa fa-trash"" aria-hidden="true"></i>', array('class' => 'btn btn-deep-orange btn-sm form_warning_sweet_alert', 'title'=>'আপনি কি নিশ্চিত?', 'text'=>'এই পোস্টটি আর উদ্ধার করা যাবে না!', 'confirmButtonText'=>'হ্যাঁ, পোস্টটি মুছে দিন!', 'type'=>'submit')) !!}
            <!--Likes-->
            <button id="like_btn" type="button" class="btn {{ ($my_like==0)? 'btn-green' : 'btn-yellow' }} btn-sm" 
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
              <source src="{{ url('/').$video->video_path}}" type="video/mp4">
            </video>
            @endforeach
            <!--iframe class="embed-responsive-item" src="https://www.youtube.com/embed/v64KOxKVLVg" allowfullscreen></iframe-->
        </div> 
        <hr>
        <h5 class="grey-text font-weight-bold" id="total_comments">মোট মন্তব্য: {{ count($post_comments) }}</h5>
    </div>
    <!--div class="col-xl-12 col-lg-12 col-md-12 my-5">
        <button type="button" class="btn btn-sm btn-fb"><i class="fa fa-facebook"></i></button>
        <button type="button" class="btn btn-sm btn-tw"><i class="fa fa-twitter"></i></button>
        <button type="button" class="btn btn-sm btn-gplus"><i class="fa fa-google-plus"></i></button>
    </div-->
    @foreach($post_comments as $comment)
    <div class="col-xl-1 col-lg-2 col-md-2 my-3 post_creator">
        @if($comment->image_path!='')
            <img src="{{ url('/').$post->image_path}}" class="rounded-circle z-depth-1-half">
        @else
            <img src="{{ url('/').'/img/avatar.png'}}" class="rounded-circle z-depth-1-half">
        @endif
    </div>
    <div class="col-xl-11 col-lg-10 col-md-10 my-3">
        <div class="card border message_area border-light">
            <div class="card-body">
                <h6 class="font-weight-bold">{{ $comment->first_name." ".$comment->last_name}}</h6>
                <small class="grey-text">{{ $comment->created_at}}</small>
                <hr>
                <?php echo htmlspecialchars_decode($comment->comment); ?>
            </div>
        </div>
    </div>
    @endforeach

    <div class="col-xl-12 col-lg-12 col-md-12 mt-5 text-center" id="add_comment">
        <h6 class="font-weight-bold red-text">আপনার মন্তব্য পোস্ট করুন</h4>
    </div>
    <div class="col-xl-1 col-lg-2 col-md-2">
        <img src="{{ (Session::get('image_path')!='') ? url('/').Session::get('image_path') : url('/').'/img/avatar.png' }}" class="img-fluid rounded-circle z-depth-1 my-5">
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
                {!! Form::button('পোস্ট', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
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
                            $('#like_btn').removeClass('btn-yellow').addClass('btn-green');
                        }
                        else{
                            $('#like_btn').removeClass('btn-green').addClass('btn-yellow');
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



@extends('layouts.master')

@section('title', "অ্যালবাম বিস্তারিত ||")

@section('content')

<div class="row">
    <div class="col-xl-1 col-lg-2 col-md-2 post_creator">
        @if($post->image_path!='')
            <img src="{{ url('/').$post->image_path}}" class="img-fluid rounded-circle z-depth-1-half">
        @else
            <img src="{{ url('/').'/img/avatar.png'}}" class="img-fluid rounded-circle z-depth-1-half">
        @endif
        
    </div>
    <div class="col-xl-7 col-lg-5 col-md-4">
        <h6 class="font-weight-bold">{{ $post->first_name." ".$post->last_name}}</h6>
        <small class="grey-text">{{ $post->created_at}}</small>
    </div>
    <div class="col-xl-4 col-lg-5 col-md-6" align="right">
        <a href="javascript:void(0)" class="btn btn-light-green btn-sm">
            <i class="fa fa-edit"></i>
        </a>
        <!--Likes-->
        <button type="button" class="btn btn-green btn-sm">
            <i class="fa fa-thumbs-o-up"></i>
        </button>
        <span class="counter">22</span>
        <!--Comments-->
        <button type="button" class="btn btn-red btn-sm">
            <i class="fa fa-comments"></i>
        </button>
        <span class="counter">22</span>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12">
        <hr>
        <?php echo htmlspecialchars_decode($post->description); ?>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12" align="center">
        <div class="item my-4" id="aniimated-thumbnials">
            <ul id="content-slider" class="content-slider">
                @foreach($post->images as $image)
                <li>
                    <a href="{{ url('/').$image->image_path }}" data-sub-html="Focused client-server ability 1"> 
                        <img class="img-fluid" src="{{ url('/').$image->image_path }}" alt="Photo">
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
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

    <div class="col-xl-12 col-lg-12 col-md-12 mt-5 text-center">
        <h6 class="font-weight-bold red-text">আপনার মন্তব্য পোস্ট করুন</h4>
    </div>
    <div class="col-xl-1 col-lg-2 col-md-2">
        
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



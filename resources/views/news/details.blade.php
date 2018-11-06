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
            <img class="card-img-top" src="{{ url('/').'/'.$news->image_path}}" alt="Sample image">
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
            <p>{{ date('d/m/Y',strtotime($news->created_at)) }}</p>

          </div>
          <!-- Card content -->

        </div>
        <!-- Card -->

        <!-- Excerpt -->
        <div class="mt-5">

          {{ $news->description }}

        </div>

        <h4 class="font-weight-bold mt-5">মন্তব্য</h4><hr>

        @foreach($news_comments as $comment)
        <!-- Card -->
        <div class="card news-card mb-4">
          <!-- Heading-->
          <div class="card-body">
            <div class="content">
              <div class="right-side-meta">{{ date('d/m/Y h:i',strtotime($comment->created_at)) }}</div>
              @if($comment->image_path!='')
              <img src="{{ url('/').$comment->image_path}}" class="rounded-circle profile-image-thumbnile avatar-img z-depth-1-half">
              @else
              <img src="{{ url('/').'/img/avatar.png'}}" class="rounded-circle profile-image-thumbnile avatar-img z-depth-1-half">
              @endif
              <strong>{{ $comment->first_name." ".$comment->last_name}}</strong>
            </div>
          </div>
          <hr>
          <!-- Card content -->
          <div class="card-body">
            <!-- Social meta-->
            <div class="social-meta">
              <p>{{ $comment->comment}}</p>
            </div>
          </div>
        </div>
        <!-- Card -->
        @endforeach

        <div class="alert alert-success" id="comment_success" style="display:none"></div>
        <div class="alert alert-danger" id="comment_error" style="display:none"></div>
        <form id="comment_form" class="login-form" method="post" action="">
            {{ csrf_field() }}  
            <input type="hidden" name="news_id" value="{{ $news->global_news_id }}">
            <div class="md-form">
                {!! Form::textarea('additional_details', null, array('class'=>'editor','name'=>'comment_text','id'=>'comment_text')) !!}
            </div>
            <div class="text-center my-4">
                {!! Form::button('পোস্ট', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
            </div>
        </form>

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
                            $('#comment_success').show();
                            $('#comment_error').hide();
                            $('#comment_success').html(data.reason);
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



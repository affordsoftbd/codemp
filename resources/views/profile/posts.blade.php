@extends('layouts.master')

@section('title', "পরিলেখ || পোস্ট ||")

@section('content')

@include('profile.profile')
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
 <div class="tab-content">

	<!--div class="card mb-4">
		<div class="card-body">
			<div class="row">
				<div class="col-xl-1 col-lg-2 col-md-2 post_creator">
				<img src="http://localhost:8000null" class="rounded-circle z-depth-1-half"></div>
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
	            <button class="btn btn-md btn-red load_more_button"><i class="fa fa-refresh fa-sm pr-2"></i>&nbsp;Load More!</button>
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
                            $('#post_success').hide();
                            $('#post_danger').hide();
                            $('#post_success').html('');
                            $('#post_danger').html('');

                            var last_id = $('#last_id').val();
                            $('#last_id').val(parseInt(last_id)+1);

                            getPost(parseInt(last_id)+1,'init');
                        }
                        else{
                            $('#post_success').hide();
                            $('#post_danger').show();
                            $('#post_danger').html(data.reason);
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
            else{
                $('#post_success').hide();
                $('#post_danger').show();
                $('#post_danger').html(validate);
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
                                        var profile_image = "{{ url('/')}}"+value.image_path;
                                    }
                                    else{
                                        var profile_image = "https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg";
                                    }

                                    html +='<div class="card my-4">';        
                                        html +='<div class="card-body">';
                                            html +='<div class="row">';
                                                html +='<div class="col-xl-1 col-lg-2 col-md-2 post_creator">';
                                                    html +='<img src="'+profile_image+'" class="rounded-circle z-depth-1-half">';
                                                html +='</div>';
                                                html +='<div class="col-xl-11 col-lg-10 col-md-10">';
                                                    html +='<h6 class="font-weight-bold">'+value.first_name+' '+value.last_name+'</h6>';
                                                    html +='<small class="grey-text">'+value.created_at+'</small>';
                                                    html +='<a class="btn-floating btn-action ml-auto mr-4 red pull-right" onclick="show_comment_box('+value.post_id+')"><i class="fa fa-edit pl-1"></i></a>';
                                                html +='</div>';
                                            html +='</div>';
                                            html +='<hr>';
                                            html +=value.description;
                                        html +='</div>';

                                        html +='<div class="rounded-bottom green text-center pt-3">';
                                            html +='<ul class="list-unstyled list-inline font-small">';
                                                html +='<li class="list-inline-item pr-2"><a href="javascript:void(0)" class="white-text" onclick="save_post_like('+value.post_id+')"><i class="fa fa-thumbs-o-up pr-1"></i><span id="p_like_'+value.post_id+'">'+value.likes.length+'</span></a></li>';                
                                                html +='<li class="list-inline-item"><a href="{{ route('post') }}/'+value.post_id+'" class="white-text"><i class="fa fa-comments-o pr-1"></i><span id="p_comment_'+value.post_id+'">'+value.comments.length+'</span></a></li>';
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
                                        var profile_image = '{{ url('/') }}'+value.image_path;
                                    }
                                    else{
                                        var profile_image = "https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg";
                                    }
                                    html +='<div class="card my-4">';

                                        html +='<div class="card-body">';
                                            html +='<div class="row">';
                                                html +='<div class="col-xl-1 col-lg-2 col-md-2 post_creator">';
                                                    html +='<img src="'+profile_image+'" class="rounded-circle z-depth-1-half">';
                                                html +='</div>';
                                                html +='<div class="col-xl-11 col-lg-10 col-md-10">';
                                                    html +='<h6 class="font-weight-bold">'+value.first_name+' '+value.last_name+'</h6>';
                                                    html +='<small class="grey-text">'+value.created_at+'</small>';
                                                html +='</div>';
                                            html +='</div>';
                                            html +='<hr>';
                                            html +=value.description;
                                        html +='</div>';

                                        html +='<a class="btn-floating btn-action ml-auto mr-4 mb-4 red" onclick="show_comment_box('+value.post_id+')"><i class="fa fa-edit pl-1"></i></a>';

                                        html +='<div class="view overlay mt-4" align="center">';
                                            html +='<div class="lightgallery mb-4">';
                                                html +='<p><span class="slidercount">1</span> of '+Object.keys(value.images).length+' total images in this album</p>';
                                                html +='<ul class="lightSlider">'; // slidercount
                                                $.each(value.images, function( index, image ) {
                                                    var image_url =  '{{ url('/').'/' }}'+image.image_path;
                                                    html +='<li data-thumb="'+image_url+'" data-src="'+image_url+'" data-sub-html="Focused client-server ability 10">';
                                                        html +='<img src="'+image_url+'" />';
                                                    html +='</li>';
                                                });
                                                html +='</ul>';
                                            html +='</div> ';
                                        html +='</div>';

                                      html +='<div class="rounded-bottom green text-center pt-3">';
                                            html +='<ul class="list-unstyled list-inline font-small">';
                                                html +='<li class="list-inline-item pr-2"><a href="javascript:void(0)" class="white-text" onclick="save_post_like('+value.post_id+')"><i class="fa fa-thumbs-o-up pr-1"></i><span id="p_like_'+value.post_id+'">'+value.likes.length+'</span></a></li>';                
                                                 html +='<li class="list-inline-item"><a href="{{ route('image') }}/'+value.post_id+'" class="white-text"><i class="fa fa-comments-o pr-1"></i><span id="p_comment_'+value.post_id+'">'+value.comments.length+'</span></a></li>';
                                            html +='</ul>';
                                        html +='</div>';

                                    html +='</div>';
                                }
                                else if(value.post_type=='video'){  
                                    /*
                                    * Video post
                                    */
                                    if(value.image_path!='' || value.image_path!='null'){
                                        var profile_image = "{{ url('/')}}"+value.image_path;
                                    }
                                    else{
                                        var profile_image = "https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg";
                                    }
                                    
                                    html +='<div class="card my-4">';

                                        html +='<div class="card-body">';
                                            html +='<div class="row">';
                                                html +='<div class="col-xl-1 col-lg-2 col-md-2 post_creator">';
                                                    html +='<img src="'+profile_image+'" class="rounded-circle z-depth-1-half">';
                                                html +='</div>';
                                                html +='<div class="col-xl-11 col-lg-10 col-md-10">';
                                                    html +='<h6 class="font-weight-bold">'+value.first_name+' '+value.last_name+'</h6>';
                                                    html +='<small class="grey-text">'+value.created_at+'</small>';
                                                html +='</div>';
                                            html +='</div>';
                                            html +='<hr>';
                                            html +=value.description;
                                        html +='</div>';

                                        
                                      html +='<a class="btn-floating btn-action ml-auto mr-3 mb-4 red" onclick="show_comment_box('+value.post_id+')"><i class="fa fa-edit pl-1"></i></a>';

                                        html +='<div class="view overlay my-3" align="center">';
                                            html +='<div class="embed-responsive embed-responsive-16by9">';
                                                html +='<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/v64KOxKVLVg" allowfullscreen></iframe>';
                                            html +='</div> ';
                                        html +='</div>';

                                        html +='<div class="rounded-bottom green text-center pt-3">';
                                            html +='<ul class="list-unstyled list-inline font-small">';
                                                html +='<li class="list-inline-item pr-2"><a href="javascript:void(0)" class="white-text" onclick="save_post_like('+value.post_id+')"><i class="fa fa-thumbs-o-up pr-1"></i><span id="p_like_'+value.post_id+'">'+value.likes.length+'</span></a></li>';                
                                                 html +='<li class="list-inline-item"><a href="{{ route('image') }}/'+value.post_id+'" class="white-text"><i class="fa fa-comments-o pr-1"></i><span id="p_comment_'+value.post_id+'">'+value.comments.length+'</span></a></li>';
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
                            show_success_message(data.reason);
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



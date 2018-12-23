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
<input type="hidden" name="content_type" id="content_type" value="video">

@endsection


@section('extra-script')

    <script> 

        $(document).on('click','.load_more_button',function(){
            var last_load = $('#last_load').val(); 
            $('#last_load').val(parseInt(last_load)-5);
            getPost(parseInt(last_load)-5,'','video');
        });
               
        $(document).ready(function(){
            var last_post_id = {{$last_id}}
            $('#last_load').val(last_post_id);
            $('#last_id').val(last_post_id);
            getPost(last_post_id,'init','video');
        });

    </script>
@endsection



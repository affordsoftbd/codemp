@extends('layouts.master')

@section('title', "বার্তা ||")

@section('content')


<a href="#" class="btn btn-outline-danger btn-rounded waves-effect" id="new_group_button"><i class="fa fa-plus pr-2"></i>নতুন গ্রুপ যোগ করুন</a>

@if(Request::url() === url('/').'/messages')
{!! Form::open(['url' => '/messages/', 'method'=>'get']) !!}
@else
{!! Form::open(['url' => '/messages/administrated/', 'method'=>'get']) !!}
@endif
	<div class="row mb-5">
	  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
	    <!-- Material input email -->
	    <div class="md-form">
	        <input type="text" name="search" class="form-control" placeholder="Enter group name">
	    </div>
	  </div>
	  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	    <div class="text-center mt-4">
	      {!! Form::button('<i class="fa fa-search"></i>', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
	    </div>
	  </div>
	</div>
{!! Form::close() !!}

<div class="row mb-5">
	<div class="col-md-1">
	 <img src="" class="img-fluid rounded-circle z-depth-0 image-thumbnail my-3">
	</div>
	<div class="col-md-11">
	  <div class="card">
	    <div class="card-body">
	      <strong>Group 1</strong>
	      <small class="pull-right">Lorem ipsome</small>
	      <br>
	      5 member(s)
	    </div>
	  </div> 
	</div>
</div>



<div class="modal fade" id="modalNewGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="alert alert-success" id="comment_success" style="display:none"></div>
            <div class="alert alert-danger" id="comment_error" style="display:none"></div>
            <form id="comment_form" class="login-form" method="post" action="">
                {{ csrf_field() }}  
                <input type="hidden" name="post_id" id="post_id" value="">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">নতুন গ্রুপ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form">
                        {!! Form::textarea('address', null, array('class'=>'md-textarea form-control no-resize auto-growth', 'rows'=>'1', 'name'=>'comment_text', 'id'=>'comment_text')) !!}
                        {!! Form::label('address', 'নাম') !!}
                    </div>
                    <div class="md-form">                    	
                        <select class="mdb-select" name="members[]" id="members">
                            <option value="" disabled selected>সদস্য</option>
                            @foreach($applicants as $applicant)
                                <option value="{{ $applicant->id }}">{{ $applicant->first_name." ".$applicant->last_name }}</option>
                            @endforeach                                            
                        </select>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    {{ Form::button('সাবমিট', ['type' => 'submit', 'class' => 'btn btn-danger mt-1 btn-md'] ) }}
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('extra-script')
    <script>   	

        $(document).ready(function(){
            $('#members').material_select();
        });

    	$(document).on('click','#new_group_button',function(){
    		$('#modalNewGroup').modal('show');
    	})
    </script>
@endsection



@extends('layouts.master')

@section('title', "বার্তা ||")

@section('content')

<h4 class="font-weight-bold green-text">গ্রুপ এর তালিকা</h4>
<small class="red-text">{{ empty(request()->get('keyword')) ? 'সকল' : 'আপনার অনুসন্ধানের উপর ভিত্তি করে' }} গ্রুপ</small>
<hr>

<a href="#" class="btn btn-outline-danger btn-rounded waves-effect" id="new_group_button"><i class="fa fa-plus pr-2"></i>নতুন গ্রুপ যোগ করুন</a>

<form method="get" action="">
	<div class="row mb-5">
	  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
	    <!-- Material input email -->
	    <div class="md-form">
	        <input type="text" name="keyword" class="form-control" value="{{ request()->get('keyword') }}" placeholder="গ্রুপ অনুসন্ধান">
	    </div>
	  </div>
	  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	    <div class="text-center mt-4">
	      {!! Form::button('<i class="fa fa-search"></i>', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
	    </div>
	  </div>
	</div>
</form>


<div class="row">
    @foreach($groups as $group)
    <div class="col-lg-4 mb-4">
        <!-- Card -->
        <div class="card card-cascade wider">

          <!-- Card image -->
          <div class="view view-cascade gradient-card-header green">

            <!-- Title -->
            <h2 class="card-header-title mb-3">{{ $group->group_name }}</h2>
            <!-- Text -->
            <p class="mb-0"><i class="fa fa-group fa-sm pr-2"></i>{{ count($group->members) }} member(s)</p>

          </div>

          <!-- Card content -->
          <div class="card-body card-body-cascade text-center">

            <!-- Text -->
            <p class="card-text"><i class="fa fa-calendar pr-2"></i>{{ date('d M Y', strtotime($group->created_at)) }}</p>
            <!-- Link -->
            <a href="#!" class="btn btn-light-green btn-sm" onclick="edit_group({{ $group->group_id }})"><i class="fa fa-edit fa-sm pr-2"></i></a>
            <a href="#!" class="orange-text d-flex flex-row-reverse p-2">
                {!! Form::open(['route' => ['group.delete', $group->group_id], 'method'=>'delete']) !!}
                    {!! Form::button('<i class="fa fa-trash"" aria-hidden="true"></i>', array('class' => 'btn btn-red btn-sm form_warning_sweet_alert', 'title'=>'আপনি কি নিশ্চিত?', 'text'=>'এই গ্রুপটি আর উদ্ধার করা যাবে না!', 'confirmButtonText'=>'হ্যাঁ, গ্রুপ টি মুছে দিন!', 'type'=>'submit')) !!}
                {!! Form::close() !!}
            </a>

          </div>
          <!-- Card content -->

        </div>
        <!-- Card -->
    </div>
    @endforeach
</div>



<div class="modal fade" id="modalNewGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="alert alert-success" id="group_success" style="display:none"></div>
            <div class="alert alert-danger" id="group_error" style="display:none"></div>
            <form id="group_form" class="login-form" method="post" action="">
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
                        <input type="text" name="group_name" id="group_name" class="form-control">
                        {!! Form::label('address', 'নাম') !!}
                    </div>
                    <div class="md-form">                    	
                        <select class="mdb-select" name="members[]" id="members" multiple>
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

<div class="modal fade" id="modalEditGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="alert alert-success" id="edit_group_success" style="display:none"></div>
            <div class="alert alert-danger" id="edit_group_error" style="display:none"></div>
            <form id="edit_group_form" class="login-form" method="post" action="">
                {{ csrf_field() }}  
                <input type="hidden" name="post_id" id="post_id" value="">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">গ্রুপ সম্পাদন</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form">
                        <input type="hidden" name="group_id" id="group_id">
                        <input type="text" name="group_name" id="edit_group_name" class="form-control">
                        {!! Form::label('address', 'নাম') !!}
                    </div>
                    <div class="md-form">                       
                        <select class="mdb-select" name="members[]" id="edit_members" multiple>
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
            $('#edit_members').material_select();
        });

    	$(document).on('click','#new_group_button',function(){
    		$('#modalNewGroup').modal('show');
    	});


        $(document).on('submit', '#group_form', function(event){
            event.preventDefault();
            var group_name = $('#group_name').val();
            var validate = '';

            if(group_name==''){
                validate = validate+"গ্রুপ নাম লিখুন";
            }

            if(validate==''){

                var formData = new FormData($('#group_form')[0]);
                var url = '{{ url('save_group') }}';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    async: false,
                    success: function (data) {
                        if(data.status == 200){
                            $('#group_success').show();
                            $('#group_error').hide();
                            $('#group_success').html(data.reason);

                            setTimeout(function(){
                                location.reload();
                            },2000)
                        }
                        else{
                            $('#group_success').hide();
                            $('#group_error').show();
                            $('#group_error').html(data.reason);
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
            else{
                $('#group_success').hide();
                $('#group_error').show();
                $('#group_error').html(validate);
            }
        });

        function edit_group(group_id){
            var url = '{{ url('edit_group') }}';
            $.ajax({
                type: "POST",
                url: url,
                data: {group_id:group_id,'_token':'{{ csrf_token() }}'},
                async: false,
                success: function (data) {
                    if(data.status == 200){
                        $('#group_id').val(data.group.group_id);
                        $('#edit_group_name').val(data.group.group_name);
                        var selectedOptions=data.members;

                        $('#edit_members').material_select('destroy');
                        $('#edit_members').val(selectedOptions);
                        $("#edit_members").material_select();

                        $('#modalEditGroup').modal('show');
                    }
                    else{
                        showNotification("এরর!", data, "#", "danger", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                    }
                }
            });            
        }


        $(document).on('submit', '#edit_group_form', function(event){
            event.preventDefault();
            var group_name = $('#edit_group_name').val();
            var validate = '';

            if(group_name==''){
                validate = validate+"দয়া করে গ্রুপ নাম লিখুন";
            }

            if(validate==''){

                var formData = new FormData($('#edit_group_form')[0]);
                var url = '{{ url('update_group') }}';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    async: false,
                    success: function (data) {
                        if(data.status == 200){
                            $('#edit_group_success').show();
                            $('#edit_group_error').hide();
                            $('#edit_group_success').html(data.reason);

                            setTimeout(function(){
                                location.reload();
                            },2000)
                        }
                        else{
                            $('#edit_group_success').hide();
                            $('#edit_group_error').show();
                            $('#edit_group_error').html(data.reason);
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
            else{
                $('#edit_group_success').hide();
                $('#edit_group_error').show();
                $('#edit_group_error').html(validate);
            }
        });


    </script>
@endsection



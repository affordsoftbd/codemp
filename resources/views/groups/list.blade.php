@extends('layouts.master')

@section('title', "গ্রুপ ||")

@section('extra-css')
<style>
.multiple-select-dropdown li [type=checkbox]+label {
    height: .98rem; 
    /*padding-bottom: 5px;*/
}
.column {
  float: left;
  width: 33.33%;
  padding: 5px;
}
</style>
@endsection

@section('content')

<h4 class="font-weight-bold green-text">গ্রুপ এর তালিকা</h4>
<small class="red-text">{{ empty(request()->get('keyword')) ? 'সকল' : 'আপনার অনুসন্ধানের উপর ভিত্তি করে' }} গ্রুপ এর তালিকা</small>
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

@foreach($groups as $group)

<!-- Small news -->
<div class="single-news my-4">
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <h5 class="font-weight-bold dark-grey-text">
                {{ $group->group_name }}
            </h5>
            <div class="d-flex justify-content-between">
              <div class="col-11 text-truncate pl-0">              
                <p class="dark-grey-text">
                    <i class="fa fa-group fa-sm pr-2"></i><strong>{{ count($group->members) }} member(s)</strong>
                </p>
                <p class="grey-text small"><i class="fa fa-calendar pr-2"></i>{{ date('d M Y', strtotime($group->created_at)) }}</p>
              </div>
            </div>
            {!! Form::open(['route' => ['group.delete', $group->group_id], 'method'=>'delete']) !!}
                <a href="#!" class="btn btn-light-green btn-sm" onclick="edit_group({{ $group->group_id }})"><i class="fa fa-edit fa-sm"></i></a>
                {!! Form::button('<i class="fa fa-trash"" aria-hidden="true"></i>', array('class' => 'btn btn-red btn-sm form_warning_sweet_alert', 'title'=>'আপনি কি নিশ্চিত?', 'text'=>'এই গ্রুপটি আর উদ্ধার করা যাবে না!', 'confirmButtonText'=>'হ্যাঁ, গ্রুপ টি মুছে দিন!', 'type'=>'submit')) !!}
            {!! Form::close() !!}
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
            @foreach($group->members as $member)
                <div class="column">
                    <img class="img-thumbnail" src="{{ file_exists($member->user->user_details_image_path) ? asset($member->user->user_details_image_path) : url('/').'/img/avatar.png' }}" alt="{{ $member->user->first_name }}" style="width: 70px">
                </div>
                @if( $loop->iteration > 15)
                    @break
                @endif
            @endforeach
            </div>
        </div>
    </div>
    <hr>
</div>
<!-- Small news -->

@endforeach


<div class="modal fade" id="modalNewGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                    <select class="mdb-select md-form" name="members[]" id="members" multiple searchable="এখানে অনুসন্ধান করুন..">
                        <option value="" disabled selected>সদস্য</option>
                        @foreach($applicants as $applicant)
                            <option value="{{ $applicant->id }}">{{ $applicant->first_name." ".$applicant->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    {{ Form::button('সাবমিট', ['type' => 'submit', 'class' => 'btn btn-danger mt-1 btn-md'] ) }}
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                        <input type="text" name="group_name" id="edit_group_name" class="form-control" value="edit_group_name">
                        {!! Form::label('address', 'নাম') !!}
                    </div>
                    <select class="mdb-select md-form" name="members[]" id="edit_members" multiple searchable="এখানে অনুসন্ধান করুন..">
                        <option value="" disabled selected>সদস্য</option>
                        @foreach($applicants as $applicant)
                            <option value="{{ $applicant->id }}">{{ $applicant->first_name." ".$applicant->last_name }}</option>
                        @endforeach   
                    </select>
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
                            $('#group_error').hide();
                            $('#group_success').show();
                            $('#group_success').html(data.reason);

                            setTimeout(function(){
                                location.reload();
                            },500)
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
                            },500)
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



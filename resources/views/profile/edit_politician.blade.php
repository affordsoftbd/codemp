@extends('layouts.master')

@section('title', "প্রোফাইল || রাজনীতিবিদ্ তথ্য হালনাগাদ ||")

@section('content')

<h3><i class="fa fa-edit fa-sm pr-2" aria-hidden="true"></i>রাজনীতিবিদ্ তথ্য হালনাগাদ</h3>
<small class="grey-text">শেষ হালনাগাদ হয়েছিল <strong>2018-09-29 20:31:58</strong></small>
<hr>
<div class="alert alert-success" id="success_message" style="display:none"></div>
<div class="alert alert-danger" id="error_message" style="display:none"></div>

<form id="user_form" method="post" action="">
    {{ csrf_field() }}
    <div class="row">
       <div class="col-sm-12">
            <!-- Phone number -->
            <div class="md-form">
                <input type="text" name="nid" id="nid" class="form-control" value="{{ $user->nid}}">
                <label for="nid">জাতীয় আইডি</label>
            </div>
        </div>
        <div class="col-sm-12">
            <!-- Choose Division -->
            <select class="mdb-select" name="division" id="division">
                <option value="" disabled selected>আপনার বিভাগ</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->division_id }}" @if($division->division_id == $user->division_id) selected @endif>{{ $division->division_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-4">
            <!-- Choose District -->
            <select class="mdb-select" name="district" id="district" searchable="এখানে অনুসন্ধান করুন">
                <option value="" disabled selected>আপনার জেলা</option>
                
            </select>
        </div>
        <div class="col-sm-4">
            <!-- Choose Thana -->
            <select class="mdb-select" name="thana" id="thana" searchable="এখানে অনুসন্ধান করুন">
                <option value="" disabled selected>আপনার থানা</option>
                <
            </select>
        </div>
        <div class="col-sm-4">
            <!-- Choose Zip -->
            <select class="mdb-select" name="zip" id="zip" searchable="এখানে অনুসন্ধান করুন">
                <option value="" disabled selected>আপনার জিপ</option>
                
            </select>
        </div>
        <div class="col-sm-12">
            <!-- Choose Role -->
            <select class="mdb-select" name="role_id" id="role_id">
                <option value="" disabled selected>আপনি কি হিসাবে নিবন্ধন করতে চান</option>
                @foreach($roles as $role)
                    <option value="{{ $role->role_id }}" @if($role->role_id == $user->role_id) selected @endif>{{ $role->role_name }}</option>
                @endforeach                
            </select>
        </div>
        <div class="col-sm-12">
            <!-- Choose Zip -->
            <select class="mdb-select" name="leader" id="leader" searchable="এখানে অনুসন্ধান করুন">
                <option value="" disabled selected>আপনার নেতা</option>
                
            </select>
        </div>
    </div>

    <!-- Sign up button -->
    <div class="text-center my-4">
        <button class="btn btn-danger btn-rounded waves-effect text-center" type="submit">হালনাগাদ</button>
    </div>
</form>

<a class="btn btn-success waves-effect btn-sm" href="{{ route('profile', Session::get('username')) }}"><i class="fa fa-arrow-circle-left fa-sm pr-2" aria-hidden="true"></i>প্রত্যাবর্তন</a>

@endsection

@section('extra-script')
    <script>
        $(document).ready(function() {
           $('#division').material_select();
           $('#district').material_select();
           $('#thana').material_select();
           $('#zip').material_select();
           $('#role_id').material_select();
           $('#leader').material_select();

           set_district('{{ $user->division_id }}','{{ $user->district_id }}');
           set_thana('{{ $user->district_id }}','{{ $user->thana_id }}');
           set_zip('{{ $user->thana_id }}','{{ $user->zip_id }}');
           set_leader('{{ $user->role_id }}','{{ $user->parent_id }}');
        });

        $(document).on('change','#division', function(){
            var division_id = $(this).val();
            set_district(division_id,'');
        });

        $(document).on('change','#district', function(){
            var district_id = $(this).val();
            set_thana(district_id,'');
        });

        $(document).on('change','#thana', function(){
            var thana_id = $(this).val();
            set_zip(thana_id,'');
        });

        $(document).on('change','#role_id', function(){
            var role_id = $(this).val();
            set_leader(role_id,'');
        });

        function set_district(division_id,district_id){   
            $.ajax({
                type: "POST",
                url: "{{ url('district_by_division') }}",
                data: { _token: "{{ csrf_token() }}",division_id:division_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                        $('#district').material_select('destroy');
                        $('#district').html(data.options);
                        $('#district').val(district_id);
                        $('#district').material_select();
                    }
                    else{
                        alert(data);
                    }
                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        }

        function set_thana(district_id,thana_id){
            $.ajax({
                type: "POST",
                url: "{{ url('thana_by_district') }}",
                data: { _token: "{{ csrf_token() }}",district_id:district_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                        $('#thana').material_select('destroy');
                        $('#thana').html(data.options);
                        $('#thana').val(thana_id);
                        $('#thana').material_select();
                    }
                    else{
                        alert(data);
                    }
                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        }

        function set_zip(thana_id,zip_id){
            $.ajax({
                type: "POST",
                url: "{{ url('zip_by_thana') }}",
                data: { _token: "{{ csrf_token() }}",thana_id:thana_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                        $('#zip').material_select('destroy');
                        $('#zip').html(data.options);
                        $('#zip').val(zip_id);
                        $('#zip').material_select();
                    }
                    else{
                        alert(data);
                    }
                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        }

        function set_leader(role_id,parent_id){   
            $.ajax({
                type: "POST",
                url: "{{ url('leader_by_role') }}",
                data: { _token: "{{ csrf_token() }}",role_id:role_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                        $('#leader').material_select('destroy');
                        $('#leader').html(data.options);
                        $('#leader').val(parent_id);
                        $('#leader').material_select();
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



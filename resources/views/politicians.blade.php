@extends('layouts.master')

@section('title', "নেতা/কর্মীগণ ||")

@section('content')

@if(request()->get('following')=='true')
  <button type="button" class="btn btn-dark-green btn-sm pull-right" onclick="show_all_leaders()">
      <i class="fa fa-exclamation-circle fa-sm pr-2"></i> সকল নেতাদের প্রদর্শনী করুন
  </button>
@else    
  <button type="button" class="btn btn-dark-green btn-sm pull-right" onclick="show_following_leaders()">
      <i class="fa fa-exclamation-circle fa-sm pr-2"></i> শুধুমাত্র ফলোইং নেতাদের প্রদর্শনী করুন
  </button>
@endif
<h4 class="font-weight-bold green-text">রাজনীতিজ্ঞদের তালিকা</h4>
<small class="red-text">মোট নেতা/কর্মীগণ: {{ count($leaders) }} জন</small>
<hr>

<form class="md-form" method="get" action="">
  <div class="row">
    <div class="col-sm-10">
      <div class="md-form">
        <input class="form-control" id="keyword" name="keyword" type="text" value="{{ request()->get('keyword')}}">
        <input name="following" type="hidden" value="{{ request()->get('following') }}">
        <label for="keyword">নেতা/কর্মী অনুসন্ধান করুন</label>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="text-center mt-4">
        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-search"></i></button>
      </div>
    </div>
  </div>
</form>
<form class="form-horizontal" id="user_form" method="get" action="">
     <div class="form-row">
        <div class="col-sm-3">
          <div class="md-form">

          <input class="form-control" name="keyword" type="hidden" value={{ request()->get('keyword')}}>
          <input class="form-control" name="following" type="hidden" value={{ request()->get('following')}}>
              <!-- Choose Division -->
              <select class="mdb-select" name="division" id="division">
                  <option value="" disabled selected>আপনার বিভাগ</option>
                  @foreach($divisions as $division)
                      <option value="{{ $division->division_id }}" @if( $division->division_id==request()->get('division')) selected @endif>{{ $division->division_name }}</option>
                  @endforeach
              </select>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="md-form">
              <!-- Choose District -->
              <select class="mdb-select" name="district" id="district" searchable="এখানে অনুসন্ধান করুন">
                  <option value="" disabled selected>আপনার জেলা</option>
              </select>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="md-form">
              <!-- Choose Thana -->
              <select class="mdb-select" name="thana" id="thana" searchable="এখানে অনুসন্ধান করুন">
                  <option value="" disabled selected>আপনার থানা</option>
              </select>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="md-form">
              <!-- Choose Zip -->
              <select class="mdb-select" name="zip" id="zip" searchable="এখানে অনুসন্ধান করুন">
                  <option value="" disabled selected>আপনার জিপ</option>
              </select>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-danger waves-effect text-center btn-sm" type="submit">সাজান</button>
          </div>
        </div>
      </div>
</form>

<div class="row my-5">
@foreach($leaders as $leader)
    <?php 
      $follower = \App\Models\Follower::where('leader_id',$leader->id)->where('follower_user_id',Session::get('user_id'))->first();
      $myLeader = \App\Models\MyLeader::where('leader_id',$leader->id)->where('worker_id',Session::get('user_id'))->first();
    ?>
    <div class="col-lg-4 mb-4">
        <!-- Card -->
        <div class="card card-personal">

          <!-- Card image-->
          <img src="{{ file_exists($leader->image_path) ? asset($leader->image_path) : url('/').'/img/avatar.png' }}" class="card-img-top" alt="Card image cap">
          <!-- Card image-->

          <!-- Card content -->
          <div class="card-body">
            <!-- Title-->
            <a href="{{ url('public_profile?user='.$leader->username) }}"><h4 class="card-title title-one">{{ $leader->first_name." ".$leader->last_name}}</h4></a>
            <p class="card-meta">অংশগ্রহন {{ date('Y',strtotime($leader->created_at))}}</p>
            <!-- Text -->
            <p class="card-text">
              @if(!empty($leader->division_name))
                <strong>{{ $leader->division_name }} > {{ $leader->district_name }} > {{ $leader->thana_name }} > {{ $leader->zip_code }}</strong> অধীনে 
              @endIf
              <strong>নেতা</strong> হিসেবে যোগদান করেছেন</p>
            @if(empty($myLeader))   
              <a href="#" class="btn btn-sm btn-green" onclick="send_request({{ $leader->id }})">
                <i class="fa fa-user-plus pr-2"></i>নেতা হিসেবে আবেদন পাঠান
              </a>    
            @else
              <a href="#" class="btn btn-sm btn-red" onclick="cancel_request({{ $leader->id }})">
                <i class="fa fa-user-times pr-2"></i>আবেদন বাতিল করুন
              </a>
            @endif
            <hr>
            <a class="card-meta"><span><i class="fa fa-user"></i>{{ count($leader->followers) }} জন অনুসারী</span></a> 
            <div class="btn-group mt-3" role="group" aria-label="Basic example">
              @if(empty($follower))
                <a href="#!" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="অনুসরণ" onclick="follow_leader({{ $leader->id }})"><i class="fa fa-check"></i></a>
              @else
                <!-- <a href="#!" class="btn btn-red btn-sm" data-toggle="tooltip" data-placement="right" title="অনুসরণ বাতিল" onclick="un_follow_leader({{ $leader->id }})"><i class="fa fa-close"></i></a> -->
                <a href="#!" class="btn btn-red btn-sm remove_follower_btn" data-toggle="tooltip" data-placement="right" title="অনুসরণ বাতিল" leader_id="{{ $leader->id }}"><i class="fa fa-close"></i></a>
              @endif         
                <a href="{{ url('/messages/create/?recipient='.$leader->id) }}" class="btn btn-light-green btn-sm" data-toggle="tooltip" data-placement="right" title="চ্যাট"><i class="fa fa-comments"></i></a>
                <a href="{{ url('public_profile?user='.$leader->username) }}" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="পরিলেখ"><i class="fa fa-user"></i></a>
            </div>
          </div>
          <!-- Card content -->

        </div>
        <!-- Card -->
    </div>
@endforeach
</div>

<!--Pagination-->
<nav aria-label="pagination example">
    <ul class="pagination pg-blue">

        <!--Arrow left-->
        {{ $leaders->render()}}
    </ul>
</nav>

@endsection

@section('extra-script')
    <script>
        $(document).ready(function() {
           $('#division').material_select();
           $('#district').material_select();
           $('#thana').material_select();
           $('#zip').material_select();

           set_district('{{ request()->get('division') }}','{{ request()->get('district') }}');
           set_thana('{{ request()->get('district') }}','{{ request()->get('thana') }}');
           set_zip('{{ request()->get('thana') }}','{{ request()->get('zip') }}');
        });

        function show_following_leaders(){
            window.location.href="{{ url('politicians')}}?following=true";
        }
        function show_all_leaders(){
            window.location.href="{{ url('politicians')}}";
        }

        function follow_leader(leader_id){
            $.ajax({
                type: "POST",
                url: "{{ route('follow_leader') }}",
                data: { _token: "{{ csrf_token() }}",leader_id:leader_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                      showNotification("সাফল্য!", 'নেতা সফলভাবে অনুসরণ', "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                      setTimeout(function(){
                          location.reload();
                      }, 2000);
                    }
                    else{
                        alert(data);
                    }
                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        }

        $('.remove_follower_btn').click(function(e){
            e.preventDefault();
            var leader_id = $(this).attr('leader_id');
            swal(

            {
              title: "আপনি এই নেতাকে অনুসরণ মুক্ত করতে চান?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#ff0000",
              confirmButtonText: "হ্যাঁ, এই নেতা অনুসরণ মুক্ত করুন",
              cancelButtonText: "বাতিল",
            },
            function( confirmed ) {
              if(confirmed){
                $.ajax({
                  type: "POST",
                  url: "{{ route('un_follow_leader') }}",
                  data: { _token: "{{ csrf_token() }}",leader_id:leader_id},
                  dataType: "json",
                  cache : false,
                  success: function(data){
                      if(data.status == 200){
                          showNotification("সাফল্য!", 'নেতা সফলভাবে অনুসরণ মুক্ত', "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                          setTimeout(function(){
                            location.reload();
                        }, 2000);
                      }
                      else{
                          alert(data);
                      }
                  } ,error: function(xhr, status, error) {
                      alert(error);
                  },
                });
              }
            }
          );
        })

        /*function un_follow_leader(leader_id){
            $.ajax({
                type: "POST",
                url: "{{ route('un_follow_leader') }}",
                data: { _token: "{{ csrf_token() }}",leader_id:leader_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                        showNotification("সাফল্য!", 'leader un-followed successfully', "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                        setTimeout(function(){
                          location.reload();
                      }, 2000);
                    }
                    else{
                        alert(data);
                    }
                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        }*/

        function send_request(leader_id){
            $.ajax({
                type: "POST",
                url: "{{ route('send_request') }}",
                data: { _token: "{{ csrf_token() }}",leader_id:leader_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                      showNotification("সাফল্য!", data.reason, "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                      
                      setTimeout(function(){
                          location.reload();
                      }, 2000);
                    }
                    else{
                        alert(data);
                    }
                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        }

        function cancel_request(leader_id){
            $.ajax({
                type: "POST",
                url: "{{ route('cancel_request') }}",
                data: { _token: "{{ csrf_token() }}",leader_id:leader_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                      showNotification("সাফল্য!", data.reason, "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                      
                      setTimeout(function(){
                          location.reload();
                      }, 2000);
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
@extends('layouts.master')

@section('title', "নেতা/কর্মীগণ ||")

@section('content')

<h4>রাজনীতিজ্ঞদের তালিকা</h4>
<p class="red-text">মোট নেতা/কর্মীগণ: {{ count($leaders) }} জন</p>
<hr>

@if(request()->get('following')=='true')
  <button type="button" class="btn btn-dark-green btn-sm pull-right" onclick="show_all_leaders()">
      <i class="fa fa-exclamation-circle fa-sm pr-2"></i> সকল নেতাদের প্রদর্শনী করুন
  </button>
@else    
  <button type="button" class="btn btn-dark-green btn-sm pull-right" onclick="show_following_leaders()">
      <i class="fa fa-exclamation-circle fa-sm pr-2"></i> শুধুমাত্র ফলোইং নেতাদের প্রদর্শনী করুন
  </button>
@endif

<form class="md-form" method="get" action="">
  <div class="row">
    <div class="col-sm-10">
      <div class="md-form">
        <input class="form-control" id="keyword" name="keyword" type="text" value={{ request()->get('keyword')}}>
          <input class="form-control" name="following" type="hidden" value={{ request()->get('following')}}>
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
</form>

<div class="row my-5">

  @foreach($leaders as $leader)
    <?php 
      $follower = \App\Models\Follower::where('leader_id',$leader->id)->where('follower_user_id',Session::get('user_id'))->first();
    ?>
    <div class="col-lg-4 mb-4">
        <!-- Card -->
        <div class="card card-personal">

          <!-- Card image-->

        @if($leader->image_path!='')
            <img src="{{ url('/').$leader->image_path}}" class="card-img-top" alt="Card image cap">
        @else
            <img src="{{ url('/').'/img/avatar.png'}}" class="card-img-top" alt="Card image cap">
        @endif
          <!-- Card image-->

          <!-- Card content -->
          <div class="card-body">
            <!-- Title-->
            <a><h4 class="card-title title-one">{{ $leader->first_name." ".$leader->last_name}}</h4></a>
            <p class="card-meta">অংশগ্রহন {{ date('Y',strtotime($leader->created_at))}}</p>
            <!-- Text -->
            <p class="card-text"><strong>{{ $leader->division_name}} > {{ $leader->district_name}} > {{ $leader->thana_name}} > {{ $leader->zip_code}}</strong> অধীনে <strong>নেতা</strong> হিসেবে যোগদান করেছেন</p>
            <hr>
            <a class="card-meta"><span><i class="fa fa-user"></i>{{ count($leader->followers) }} জন অনুসারী</span></a>
            <div class="btn-group mt-3" role="group" aria-label="Basic example">
              @if(empty($follower))
                <a href="#" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="অনুসরণ" onclick="follow_leader({{ $leader->id }})"><i class="fa fa-check"></i></a>
              @else
                <a href="#" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="অনানুসরণ" onclick="un_follow_leader({{ $leader->id }})"><i class="fa fa-close"></i></a>
              @endif      
                <a href="#" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="আপনার নেতা হিসেবে আবেদন পাঠান" onclick="send_request({{ $leader->id }})"><i class="fa fa-user-plus"></i></a>    
                <!--a href="#" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="আপনার নেতা হিসেবে আবেদন বাতিল করুন" onclick="cancel_request({{ $leader->id }})"><i class="fa fa-user-minus"></i></a-->        
                <a href="#" class="btn btn-light-green btn-sm" data-toggle="tooltip" data-placement="right" title="চ্যাট"><i class="fa fa-comments"></i></a>
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
                      show_success_message('leader followed successfully';
                      location.reload();
                    }
                    else{
                        alert(data);
                    }
                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        }

        function un_follow_leader(leader_id){
            $.ajax({
                type: "POST",
                url: "{{ route('un_follow_leader') }}",
                data: { _token: "{{ csrf_token() }}",leader_id:leader_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                        show_success_message('leader un-followed successfully');
                        location.reload();
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
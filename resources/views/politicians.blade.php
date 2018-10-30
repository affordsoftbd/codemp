@extends('layouts.master')

@section('title', "নেতা/কর্মীগণ ||")

@section('content')


<div class="row">  
  <div class="col-sm-6">
      <h4 class="red-text">মোট নেতা/কর্মীগণ: {{ count($leaders) }} জন</h4>
      <!--p class="grey-text">অনুসরণ: 5 জন</p-->
  </div>
  <div class="col-sm-6">
    @if(request()->get('following')=='true')
      <button type="button" class="btn btn-dark-green btn-sm pull-right" onclick="show_all_leaders()">
          <i class="fa fa-exclamation-circle fa-sm pr-2"></i> সকল নেতাদের প্রদর্শনী করুন
      </button>
    @else    
      <button type="button" class="btn btn-dark-green btn-sm pull-right" onclick="show_following_leaders()">
          <i class="fa fa-exclamation-circle fa-sm pr-2"></i> শুধুমাত্র ফলোইং নেতাদের প্রদর্শনী করুন
      </button>
    @endif
  </div>
</div>

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
                <a href="#" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="অনুসরণ" onclick="un_follow_leader({{ $leader->id }})"><i class="fa fa-close"></i></a>
              @endif                
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
                      alert('leader followed successfully');
                        //show_success_message(data.reason);
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
                      alert('leader un-followed successfully');
                        //show_success_message(data.reason);
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
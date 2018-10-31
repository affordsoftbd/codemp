@extends('layouts.master')

@section('title', "অনুসারী ||")

@section('content')

<h4 class="red-text">মোট অনুসারী: {{ count($followers)}} জন</h4>

<form class="md-form" method="get" action="">
  <div class="row">
    <div class="col-sm-10">
      <div class="md-form">
        <input class="form-control" id="keyword" name="keyword" type="text" value={{ request()->get('keyword')}}>
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
            <button class="btn btn-danger waves-effect text-center btn-sm" type="submit">সাজান</button>
          </div>
        </div>
</form>

<div class="row  my-5">
  @foreach($followers as $follower)
    <div class="col-lg-4 mb-4">
        <!-- Card -->
        <div class="card card-personal">

          <!-- Card image-->

        @if($follower->image_path!='')
            <img src="{{ url('/').$follower->image_path}}" class="card-img-top" alt="Card image cap">
        @else
            <img src="{{ url('/').'/img/avatar.png'}}" class="card-img-top" alt="Card image cap">
        @endif
          <!-- Card image-->

          <!-- Card content -->
          <div class="card-body">
            <!-- Title-->
            <a><h4 class="card-title title-one">{{ $follower->first_name." ".$follower->last_name}}</h4></a>
            <p class="card-meta">অংশগ্রহন {{ date('Y',strtotime($follower->created_at))}}</p>
            <!-- Text -->
            <p class="card-text"><strong>{{ $follower->division_name}} > {{ $follower->district_name}} > {{ $follower->thana_name}} > {{ $follower->zip_code}}</strong> অধীনে <strong>নেতা</strong> হিসেবে যোগদান করেছেন</p>
            <hr>
            <a class="card-meta"><span><i class="fa fa-user"></i>{{ count($follower->followers) }} জন অনুসারী</span></a>
            <div class="btn-group mt-3" role="group" aria-label="Basic example">
              <a href="#" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="অনুসরণ" onclick="remove_follower({{ $follower->id }})"><i class="fa fa-close"></i></a>               
              <a href="#" class="btn btn-light-green btn-sm" data-toggle="tooltip" data-placement="right" title="চ্যাট"><i class="fa fa-comments"></i></a>
              <a href="{{ url('public_profile?user='.$follower->username) }}" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="পরিলেখ"><i class="fa fa-user"></i></a>
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
        {{ $followers->render()}}
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
     </script>
@endsection
@extends('layouts.master')

@section('title', "অনুসারী ||")

@section('content')

<h4 class="font-weight-bold green-text">অনুসারীদের তালিকা</h4>
<small class="red-text">মোট অনুসারী: {{ count($followers)}} জন</small>
<hr>

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
  </div>
</form>

<div class="row my-5">
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
            <h4 class="card-title title-one">{{ $follower->first_name." ".$follower->last_name}}</h4>
            <p class="card-meta">অংশগ্রহন {{ date('Y',strtotime($follower->created_at))}}</p>
            <!-- Text -->
            <p class="card-text">
              @if(!empty($leader->division_name))
                <strong>{{ $leader->division_name }} > {{ $leader->district_name }} > {{ $leader->thana_name }} > {{ $leader->zip_code }}</strong> অধীনে 
              @endIf
              <strong>নেতা</strong> হিসেবে যোগদান করেছেন
            </p>
            <hr>
            <a class="card-meta"><span><i class="fa fa-user"></i>{{ count($follower->followers) }} জন অনুসারী</span></a>
            <div class="btn-group mt-3" role="group" aria-label="Basic example">
              <!-- <a href="#" class="btn btn-red btn-sm" data-toggle="tooltip" data-placement="right" title="অপসারণ" onclick="remove_follower({{ $follower->id }})"><i class="fa fa-close"></i></a>     -->
              <a href="#" class="btn btn-red btn-sm remove_follower_btn" data-toggle="tooltip" data-placement="right" title="অপসারণ" follower_id="{{ $follower->id }}"><i class="fa fa-close"></i></a>               
              <a href="{{ url('/messages/create/?recipient='.$follower->id) }}" class="btn btn-light-green btn-sm" data-toggle="tooltip" data-placement="right" title="চ্যাট"><i class="fa fa-comments"></i></a>
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

           set_district('{{ request()->get('division') }}','{{ request()->get('district') }}');
           set_thana('{{ request()->get('district') }}','{{ request()->get('thana') }}');
           set_zip('{{ request()->get('thana') }}','{{ request()->get('zip') }}');
        });

        $('.remove_follower_btn').click(function(e){
          e.preventDefault();
          var follower_id = $(this).attr('follower_id');
          swal(

          {
            title: "আপনি এই অনুসারীকে অপসারণ করতে চান?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ff0000",
            confirmButtonText: "হ্যাঁ, এই অনুসারী মুছে ফেলুন",
            cancelButtonText: "বাতিল",
          },
          function( confirmed ) {
            if(confirmed){
                // alert(follower_id);
                $.ajax({
                  type: "POST",
                  url: "{{ url('remove_follower') }}",
                  data: {follower_id:follower_id,_token: "{{ csrf_token() }}"},
                  dataType: "JSON",
                  cache : false,
                  beforeSend: function() {
                  },

                  success: function(data){
                      $('#warning-modal').modal('hide');
                      if(data.status == 200){
                          showNotification("সাকসেস!", data.reason, "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');

                          setTimeout(function(){
                              location.reload();
                          }, 2000);

                      }

                      else{
                          showNotification("এরর!", data.reason, "#", "danger", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                      }

                      setTimeout(function(){
                          location.reload();
                      }, 3000);

                  },

                  error: function(xhr, status, error) {

                      alert(error);

                  },

                });
              }
            }
            );
        })

        /*function remove_follower(follower_id){
            $('#item_id').val(follower_id);
            $('.text-danger').text('আপনি এই অনুসারীকে অপসারণ করতে চান?');
            $('#warning-modal').modal('show');
        }*/

        /*$(document).on('click','#warning_ok',function(){
          var follower_id = $('#item_id').val();
          $.ajax({
              type: "POST",
              url: "{{ url('remove_follower') }}",
              data: {follower_id:follower_id,_token: "{{ csrf_token() }}"},
              dataType: "JSON",
              cache : false,
              beforeSend: function() {
              },

              success: function(data){
                  $('#warning-modal').modal('hide');
                  if(data.status == 200){
                      showNotification("সাকসেস!", data.reason, "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');

                      setTimeout(function(){
                          location.reload();
                      }, 2000);

                  }

                  else{
                      showNotification("এরর!", data.reason, "#", "danger", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                  }

                  setTimeout(function(){
                      location.reload();
                  }, 3000);

              },

              error: function(xhr, status, error) {

                  alert(error);

              },

          });*/

      })

     </script>
@endsection
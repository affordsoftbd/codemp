@extends('layouts.master')

@section('title', "আবেদন ||")

@section('content')

<h4 class="font-weight-bold green-text">আবেদনকারীদের তালিকা</h4>
<small class="red-text">মোট আবেদন: {{ count($applicants)}}টি</small>
<hr>

<div class="row my-5">
  @foreach($applicants as $applicant)
    <div class="col-lg-4 mb-4">
        <!-- Card -->
        <div class="card card-personal profile_card">

          <!-- Card image-->
          <img src="{{ file_exists($applicant->image_path) ? asset($applicant->image_path) : url('/').'/img/avatar.png' }}" class="card-img-top" alt="Card image cap">
          <!-- Card image-->

          <!-- Card content -->
          <div class="card-body">
            <!-- Title-->
            <a href="{{ url('public_profile?user='.$applicant->username) }}"><h4 class="card-title title-one">{{ $applicant->first_name." ".$applicant->last_name}}</h4></a>
            <p class="card-meta">অংশগ্রহন {{ date('Y',strtotime($applicant->created_at))}}</p>
            <!-- Text -->
            <p class="card-text"><strong>
              @if(!empty($leader->division_name))
                <strong>{{ $leader->division_name }} > {{ $leader->district_name }} > {{ $leader->thana_name }} > {{ $leader->zip_code }}</strong> অধীনে 
              @endIf
              <strong>নেতা</strong> হিসেবে যোগদান করেছেন
            </p>
            <hr>
            <a class="card-meta"><span><i class="fa fa-user"></i>{{ count($applicant->applicants) }} জন অনুসারী</span></a>  
            <div class="btn-group mt-3" role="group" aria-label="Basic example">
              <a href="#" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="গ্রহণ করুন" onclick="accept_request({{ $applicant->my_leader_id }})"><i class="fa fa-check"></i></a>              
              <a href="{{ url('/messages/create/?recipient='.$applicant->id) }}" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="মুছে দিন" onclick="rject_request({{ $applicant->my_leader_id }})"><i class="fa fa-close"></i></a>
              <a href="{{ url('public_profile?user='.$applicant->username) }}" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="right" title="পরিলেখ"><i class="fa fa-user"></i></a>
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
            {{ $applicants->render()}}
        </ul>
    </nav>


@endsection

@section('extra-script')
    <script>

        function accept_request(request_id){
            $.ajax({
                type: "POST",
                url: "{{ route('accept_request') }}",
                data: { _token: "{{ csrf_token() }}",request_id:request_id},
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.status == 200){
                      showNotification("সাকসেস!", data.reason, "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                        
                      setTimeout(function(){
                          location.reload();
                      }, 3000);
                    }
                    else{
                        alert(data);
                    }
                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        }        

        function rject_request(request_id){
            $('#item_id').val(request_id);
            $('.text-danger').text('আপনি এই আবেদনকে অপসারণ করতে চান?');
            $('#warning-modal').modal('show');
        }

        $(document).on('click','#warning_ok',function(){
          var request_id = $('#item_id').val();
          $.ajax({
              type: "POST",
              url: "{{ url('reject_request') }}",
              data: {request_id:request_id,_token: "{{ csrf_token() }}"},
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

      })
     </script>
@endsection
<!DOCTYPE html>
<html lang="en">

  <!-- Header -->
  <head>
    @include('layouts.partials.meta')

    <!-- Favicon-->
    <link rel="icon" href="https://cdn.appstorm.net/mac.appstorm.net/files/2012/07/icon4.png"/"/>

    <title>@yield('title') আমার নেতা || আপনার নেতাদের সাথে সংযোগ স্থাপন করুন</title>

    <!-- Font Awesome -->
    {{ Html::style('https://use.fontawesome.com/releases/v5.5.0/css/all.css') }}

    <!-- Google Icons -->
    {{ Html::style('https://fonts.googleapis.com/icon?family=Material+Icons') }}

    <!-- Bootstrap core CSS -->
    {{ Html::style('css/bootstrap.min.css') }}
    
    @yield('extra-css')

    @include('layouts.partials.styles')

  </head>
  <!-- #ENDS# Header -->

  <body>
    
  	@include('layouts.partials.loader')
  	@include('layouts.partials.navigation')

    <div class="container home-container my-5">
        <div class="row justify-content-center">
            <div class="col-md-3 mb-3">
              @include('layouts.partials.sidemenu')
            </div>
            <div class="col-md-9">
              <!-- Content -->
              @yield('content')
              <!-- #ENDS# Content -->
            </div>
        </div>
    </div>



<!-- alert message START -->
<div class="modal fade alert" role="dialog" id="alert-modal" style="z-index: 99999">
    <div class="modal-dialog" style="width: 350px">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body text-center">
                <div id="alert-error-msg">
                    <div>
                        <i class="material-icons">error_outline</i>
                    </div>
                    <p class="text-danger"></p>
                </div>
                <div id="alert-success-msg">
                    <div>
                        <i class="material-icons">check</i>
                    </div>
                    <p class="text-success"></p>
                </div>
                <button class="btn btn-primary" data-dismiss="modal" id="alert-ok">ok</button>
            </div>
        </div>
    </div>
</div>
<!-- alert message End -->



<!-- warning message START -->
<div class="modal fade alert" role="dialog" id="warning-modal" style="z-index: 99999">
    <div class="modal-dialog" style="width: 350px">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body text-center">
                <div id="alert-error-msg">
                    <div>
                        <i class="material-icons">error_outline</i>
                    </div>
                    <p class="text-danger">
                        Are you sure you want to do this?
                    </p>
                    <input type="hidden" id="item_id">
                </div>
                <button class="btn btn-primary" id="warning_ok">Yes</button>
                <button class="btn btn-danger" data-dismiss="modal" id="alert-ok">No</button>
            </div>
        </div>
    </div>
</div>

<!-- alert message End -->

  	@include('layouts.partials.alerts')
    @include('layouts.partials.scrolltotop')

    <!-- Javascript -->

    <!-- Bootstrap core JavaScript -->
    {{Html::script('js/jquery.min.js')}}
    {{Html::script('js/jquery.form.js')}}

    <!-- Bootstrap tooltips -->
    {{Html::script('js/popper.min.js')}}

    <!-- Bootstrap core JavaScript -->
    {{Html::script('js/bootstrap.min.js')}}

    @include('layouts.partials.scripts')

    @yield('extra-script')

    <script>      

      function show_success_message($message){

          $('#alert-modal').modal('show');

          $('#alert-error-msg').hide();

          $('#alert-success-msg').show();

          $('#alert-success-msg p').html($message);

      }

      function show_error_message(message){

          $('#alert-modal').modal('show');

          $('#alert-error-msg').show();

          $('#alert-success-msg').hide();

          $('#alert-error-msg p').html(message);

      }

      $(document).ready(function(){
          set_new_request_count(); 
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


      function set_new_request_count(){   
          $.ajax({
              type: "POST",
              url: "{{ url('new_request_ajax') }}",
              data: { _token: "{{ csrf_token() }}"},
              dataType: "json",
              cache : false,
              success: function(data){
                  if(data.status == 200){
                    if(data.new_request !=0){
                      $('#request_count').show();
                      $('#request_count').html(data.new_request);
                    }
                    else{
                      $('#request_count').hide();
                      $('#request_count').html(0);
                    }
                  }
                  else{
                      
                  }
              } ,error: function(xhr, status, error) {
                  alert(error);
              },
          });
      }
    </script>

  </body>

</html>

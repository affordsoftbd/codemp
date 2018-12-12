/*==================== start of windows resize functions  ====================*/

$( window ).resize(function() {

    // Align footer on windows resize

  footerAlign();

    // Align drop down right on windows resize
  dropDownRight();

});

/*==================== end of windows resize functions  ====================*/

/*==================== start of document ready functions  ====================*/

$(document).ready(function(){

  time = 0;

    // Align footer

  footerAlign();

    // Align drop down right on page load

  dropDownRight();

    // Set TinyMce

  setTinyMce();

   // Get number of new messages

  numberOfNewMessages();


    // Get number of new notifications

  numberOfNewNotifications();

    // Dropdown for new messages

  $('#messages_navigation_menu').on('show.bs.dropdown', function () {
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
      }
    });
    $.ajax({
      url: $("#all_new_messages").data('url'),
      type: 'GET',
      dataType: 'JSON',
      beforeSend: function(){
        $("#all_new_messages").empty().append('<div class="text-center my-5"><i class="fa fa-spinner fa-spin"></i></div>');
      },
      success:function(response){
        $("#all_new_messages").empty();
        $("#new_messages_number").empty().append(response.length);
        if(response.length > 0){
          redirect = $("#all_new_messages").data('url');
          for(var i = 0; i<response.length; i++){
            $("#all_new_messages").append('<div class="media list_of_jquery_content mb-1"><a class="media-left waves-light" href="'+redirect+'/'+response[i]['subject_id']+'"><img class="rounded-circle" src="'+response[i]['image']+'" width="60" alt="'+response[i]['user']+'"></a><a class="media-body" href="'+redirect+'/'+response[i]['subject_id']+'"><h6 class="media-heading font-weight-bold green-text">'+response[i]['user']+'</h6><small>'+response[i]['date']+'</small><p>'+response[i]['message']+'</p></a></div><div class="dropdown-divider"></div>');
          }
        }
        else{
          $("#all_new_messages").empty().append('<div class="text-center my-5"><h5 class="font-weight-bold red-text">কোন নতুন বার্তা পাওয়া যায় নি!</h5></div>');
        }
      }
    });
  })

    // Dropdown for new notifications

  $('#notifications_navigation_menu').on('show.bs.dropdown', function () {
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
      }
    });
    $.ajax({
      url: $("#all_new_notifications").data('url'),
      type: 'GET',
      dataType: 'JSON',
      beforeSend: function(){
        $("#all_new_notifications").empty().append('<div class="text-center my-5"><i class="fa fa-spinner fa-spin"></i></div>');
      },
      success:function(response){
        $("#all_new_notifications").empty();
        $("#new_notification_number").empty().append(response.length);
        if(response.length > 0){
          $("#markasread").show();
          $('#marknotificationasread').prop('disabled', false).prop('checked', false); 
          if(response.length > 30){
            $("#all_new_notifications").append('<div class="media list_of_jquery_content mb-1"><a class="media-left waves-light" href="/notifications"><span class="badge badge-pill orange"><i class="fa fa-warning fa-2x" aria-hidden="true"></i></span></a><a class="media-body" href="/notifications"><h6 class="red-text small">আপনার  অত্যধিক অপঠিত বিজ্ঞপ্তি আছে! দেখতে এবং পরিচালনা করতে এখানে ক্লিক করুন!</h6></a></div><div class="dropdown-divider"></div>');
          }
          for(var i = 0; i<30; i++){
            $("#all_new_notifications").append('<div class="media list_of_jquery_content mb-1"><a class="media-left waves-light" href="'+response[i]['link']+'"><span class="badge badge-pill red"><i class="fa fa-'+response[i]['icon']+' fa-2x" aria-hidden="true"></i></span></a><a class="media-body" href="'+response[i]['link']+'"><h6 class="green-text">'+response[i]['text']+'</h6></a></div><div class="dropdown-divider"></div>');
          }
        }
        else{
          $("#all_new_notifications").empty().append('<div class="text-center my-5"><h5 class="font-weight-bold red-text">কোন নতুন বিজ্ঞপ্তি পাওয়া যায় নি!</h5></div>');
        }
      }
    });
  })

    // Clear read notifications

  $('#marknotificationasread').change(function() {
    if(this.checked) {
      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
        }
      });
      $.ajax({
        url: $("#markasread").data('url'),
        type: 'GET',
        beforeSend: function(){
          $("#marknotificationasread").prop('disabled', true);
        },
        success:function(){
          $("#markasread").hide();
          $("#new_notification_number").empty().append('0');
          showNotification("সাফল্য!", "বিজ্ঞপ্তিগুলো অক্ষিগত হিসাবে চিহ্নিত করা হয়েছে!", "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp'); 
        }
      });
    }
  });

    // Set Lightslider

  $('.lightSlider').each(function (index) {
    $(this).lightSlider({
        gallery: true,
        item: 1,
        loop: true,
        slideMargin: 0,
        thumbItem: 9,
        onBeforeSlide: function (el) {
            $('#counter' + index).text(el.getCurrentSlideCount());
        },
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '.lightgallery .lslide'
            });
        }
    });
  });

    // hide button to scroll to top  

  $("#scrollToTopButton").hide();
  
    //  Check to see if the window is top if not then display button

  $(window).scroll(function(){
    if ($(this).scrollTop() > 200) {
      $("#scrollToTopButton").fadeIn();
    } else {
      $("#scrollToTopButton").fadeOut();
    }
  });
  
    //  Click event to scroll to top

  $("#scrollToTopButton").click(function(){
    $('html, body').animate({scrollTop : 0},800);
    return false;
  });

    // Set when the loading screen will stop

  setTimeout(function () { $('.page-loader-wrapper').fadeOut(); }, 50);

    // Showing Notifications

  if ($(".info_messages").length) {
      $( ".info_messages" ).each(function() {
        notificationLoop(time, $(this), "#", "info", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
        time++;
      });
  } 
  if ($(".success_messages").length) {
      $( ".success_messages" ).each(function() {
        notificationLoop(time, $(this), "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
        time++;
      });
  } 
  if ($(".warning_messages").length) {
      $( ".warning_messages" ).each(function() {
        notificationLoop(time, $(this), "#", "warning", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
        time++;
      });
  } 
  if ($(".error_messages").length) {
      $( ".error_messages" ).each(function() {
        notificationLoop(time, $(this), "#", "danger", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
        time++;
      });
  } 

    //  Sweet alert for warning

  $('.form_warning_sweet_alert').on('click',function(e){
      e.preventDefault();
      var form = $(this).parents('form');
      var title = $(this).attr('title');
      var text = $(this).attr('text');
      var confirmButtonText = $(this).attr('confirmButtonText');
      swal({
          title: title,
          text: text,
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#ff0000",
          confirmButtonText: confirmButtonText,
          cancelButtonText: 'বাতিল',
          closeOnConfirm: false
      }, function(isConfirm){
          if (isConfirm) form.submit();
      });
  });

    // Prevent leaving page

  preventLeave();


    //  Show profile image preview

  $('.input_image').change(function() {
      readURL(this, $(this).index());
  });

    //  Refresh preview on modal close

  $('#updateimage').on('hidden.bs.modal', function (e) {
    $('input[name=image]').empty().val('');
    $('.file-path').empty().val('');
    $('.preview_input').attr('src', 'http://placehold.it/200');
  });

    //  Jquery form for uploading profile image and showing progress

  (function() {
    $('.upload_image').ajaxForm({
      beforeSend: function() {
      },
      uploadProgress: function() {
        $(".image_modal").empty().append("<div class='modal-body text-center mb-1'><h5 class='mt-1 mb-2'>Uploading Image</h5><div class='progress primary-color-dark'><div class='indeterminate'></div></div></div>");
      },
      success: function() {
        $(".image_modal").empty().append("<div class='modal-body text-center mb-1'><h5 class='mt-1 mb-2 light-green-text'><i class='fa fa-check-circle'></i> Image Uploaded</h5><p class='mt-1 mb-2 deep-orange-text'>Wait till return message...</p><div class='progress primary-color-dark'><div class='indeterminate'></div></div></div>").fadeIn("slow");        
      },
      error: function() {
       $(".image_modal").empty().append("<div class='modal-body text-center mb-1'><h5 class='mt-1 mb-2 red-text'><i class='fa fa-warning'></i> Image can't be Uploaded!</h5><p class='mt-1 mb-2 light-blue-text'>Something went wrong in the server. Wait till the page refreshes...</p><div class='progress primary-color-dark'><div class='indeterminate'></div></div></div>").fadeIn("slow");        
      },
      complete: function(xhr) {
        location.reload();
      }
    }); 
  })();


});

/*==================== end of document ready functions  ====================*/

/*==================== start of individual functions  ====================*/

// Function for getting new messages number

function numberOfNewMessages() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
    }
  });
  $.ajax({
    url: $("#new_messages_number").data('url'),
    type: 'GET',
    dataType: 'JSON',
    beforeSend: function(){
      $("#new_messages_number").empty().append('<i class="fa fa-spinner fa-spin"></i>');
    },
    success:function(response){
      $("#new_messages_number").empty().append(response.length);
    }
  });
}

// Function for getting new notifications number

function numberOfNewNotifications() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
    }
  });
  $.ajax({
    url: $("#new_notification_number").data('url'),
    type: 'GET',
    dataType: 'JSON',
    beforeSend: function(){
      $("#new_notification_number").empty().append('<i class="fa fa-spinner fa-spin"></i>');
    },
    success:function(response){
      $("#new_notification_number").empty().append(response.length);
    }
  });
}

// Function for showing image preview

function readURL(input, i) {
    i = i-1;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.preview_input').eq(i).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

  // Function for fixing dropdown menu right

function dropDownRight(){
  var width = $(window).width();
  if (width > 786) {
    $('.dropdown-wide').addClass('dropdown-menu-right');
  } else if (width < 786) {
    $('.dropdown-wide').removeClass('dropdown-menu-right');
  }
} 

  // Function for preventing page leave on form edit

function preventLeave(){
  var formHasChanged = false;
  var submitted = false;

  $('form[name="check_edit"]').on('change input', function() {
    formHasChanged = true;
  });
  
  window.onbeforeunload = function (e) {
    if (formHasChanged && !submitted) {
      var message = "You have not saved your changes.", e = e || window.event;
      if (e) {
          e.returnValue = message;
      }
      return message;
    }
  }
  
  $('form[name="check_edit"]').submit(function() {
       submitted = true;
  });
}

  // Function for aligning footer

function footerAlign() {
  $('footer').css('display', 'block');
  $('footer').css('height', 'auto');
  var footerHeight = $('footer').outerHeight();
  $('body').css('padding-bottom', footerHeight);
  $('footer').css('height', footerHeight);
}


  // Function for tinymce editor

function setTinyMce() {
    tinymce.init({
      theme: 'modern',
      mode : "specific_textareas",
      editor_selector : "editor",
      plugins: 'print preview autoresize searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
      toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
      image_advtab: true,
      autoresize_min_height: 100,
      autoresize_max_height: 800,
      templates: [
        { title: 'Test template 1', content: 'Test 1' },
        { title: 'Test template 2', content: 'Test 2' }
      ],
      content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'
      ]
     });
}

  // Function for looping notificaitons

function notificationLoop(time, data, redirect, colorName, placementFrom, placementAlign, offsetFrom, offsetAlign, animateEnter, animateExit){
  setTimeout(function () {   
    showNotification(data.find('h1').text(), data.find('p').text(), redirect, colorName, placementFrom, placementAlign, offsetFrom, offsetAlign, animateEnter, animateExit);                                       
  }, 1000 * time)
}

  // Function for showing notificaitons

function showNotification(title, text, redirect, colorName, placementFrom, placementAlign, offsetFrom, offsetAlign, animateEnter, animateExit) {
    if (title === null || text === '') { text = ''; }
    if (text === null || text === '') { text = ''; }
    if (colorName === null || colorName === '') { colorName = 'bg-black'; }
    if (redirect === null || redirect === '') { redirect = '#'; }
    if (animateEnter === null || animateEnter === '') { animateEnter = 'animated fadeInDown'; }
    if (animateExit === null || animateExit === '') { animateExit = 'animated fadeOutUp'; }
    var allowDismiss = true;

    $.notify({
      // options
      icon: 'glyphicon glyphicon-warning-sign',
      title: title,
      message: text,
      url: redirect,
      target: '_blank'
    },{
      // settings
      element: 'body',
      position: null,
      type: colorName,
      allow_dismiss: allowDismiss,
      newest_on_top: true,
      showProgressbar: false,
      placement: {
        from: "bottom",
        align: "left"
      },
      offset: {
        x: offsetFrom,
        y: offsetAlign
      },  
      spacing: 10,
      z_index: 1031,
      delay: 2000,
      timer: 1000,
      url_target: '_blank',
      mouse_over: null,
      animate: {
        enter: animateEnter,
        exit: animateExit
      },
      onShow: null,
      onShown: null,
      onClose: null,
      onClosed: null,
      icon_type: 'class',
      template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                  '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                  '<span data-notify="title">{1}</span>' +
                  '<br><span data-notify="message">{2}</span>' +
                  '<div class="progress" data-notify="progressbar">' +
                    '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                  '</div>' +
                  '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
    });
}

/*==================== end of individual functions  ====================*/

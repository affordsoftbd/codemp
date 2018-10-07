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
          confirmButtonColor: "#f80",
          confirmButtonText: confirmButtonText,
          closeOnConfirm: false
      }, function(isConfirm){
          if (isConfirm) form.submit();
      });
  });

    //  Show profile image preview

  $('.input_profile_image').change(function() {
      readURL(this, $(this).index());
  });

    //  Refresh preview on modal close

  $('#updateimage').on('hidden.bs.modal', function (e) {
    $('input[name=profile_image]').empty().val('');
    $('.file-path').empty().val('');
    $('.preview_profile_input').attr('src', 'http://placehold.it/200');
  });

    //  Jquery form for uploading profile image and showing progress

  (function() {
    $('.upload_profile_image').ajaxForm({
      beforeSend: function() {
      },
      uploadProgress: function() {
        $(".profile_image_modal").empty().append("<div class='modal-body text-center mb-1'><h5 class='mt-1 mb-2'>Uploading Image</h5><div class='progress primary-color-dark'><div class='indeterminate'></div></div></div>");
      },
      success: function() {
        $(".profile_image_modal").empty().append("<div class='modal-body text-center mb-1'><h5 class='mt-1 mb-2 light-green-text'><i class='fa fa-check-circle'></i> Image Uploaded</h5><p class='mt-1 mb-2 deep-orange-text'>Wait till the image is being saved...</p><div class='progress primary-color-dark'><div class='indeterminate'></div></div></div>").fadeIn("slow");        
      },
      error: function() {
       $(".profile_image_modal").empty().append("<div class='modal-body text-center mb-1'><h5 class='mt-1 mb-2 red-text'><i class='fa fa-warning'></i> Image can't be Uploaded!</h5><p class='mt-1 mb-2 light-blue-text'>Something went wrong in the server. Wait till the page refreshes...</p><div class='progress primary-color-dark'><div class='indeterminate'></div></div></div>").fadeIn("slow");        
      },
      complete: function(xhr) {
        location.reload();
      }
    }); 
  })();


});

/*==================== end of document ready functions  ====================*/

/*==================== start of individual functions  ====================*/

// Function for showing image preview

function readURL(input, i) {
    i = i-1;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.preview_profile_input').eq(i).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

  // Function for aligning footer

function footerAlign() {
  $('footer').css('display', 'block');
  $('footer').css('height', 'auto');
  var footerHeight = $('footer').outerHeight();
  $('body').css('padding-bottom', footerHeight);
  $('footer').css('height', footerHeight);
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

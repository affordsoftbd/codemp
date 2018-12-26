@extends('layouts.master')

@section('title', "ভিডিও ||")

@section('extra-css')

		<!-- Animation Css -->
	{{ Html::style('plugins/video-recorder/css/videojs.record.min.css') }}

	<style>
			/* change player background color */
		#myVideo {
			background-color: #9ab87a;
		}
	 </style>

@endsection

@section('content')

<h4 class="red-text">একটি নতুন ভিডিও তৈরি করুন</h4>
<hr>

<video id="myVideo" class="video-js vjs-default-skin">
  <p class="vjs-no-js">
    To view this video please enable JavaScript, or consider upgrading to a
    web browser that
    <a href="http://videojs.com/html5-video-support/" target="_blank">
      supports HTML5 video.
    </a>
  </p>
</video>

<a class="btn btn-success waves-effect btn-sm" href="{{ route('videos.index') }}"><i class="fa fa-arrow-circle-left fa-sm pr-2" aria-hidden="true"></i>প্রত্যাবর্তন</a>

@endsection

@section('extra-script')

		<!-- Record RTC Js -->
 	{{ Html::script('https://cdn.webrtc-experiment.com/RecordRTC.js') }}

 		<!-- Adapter Js -->
 	{{ Html::script('https://unpkg.com/webrtc-adapter/out/adapter.js') }}

 		<!-- Video Recorder Js -->
 	{{ Html::script('plugins/video-recorder/js/videojs.record.min.js') }}

 		<!-- Browser Workarounds Js -->
 	{{ Html::script('plugins/video-recorder/js/browser-workarounds.js') }}

 	<script>
		var options = {
		    controls: true,
		    width: 320,
		    height: 240,
		    plugins: {
		        record: {
		            audio: true,
		            video: true,
		            maxLength: 10,
		            debug: true
		        }
		    }
		};

		// apply some workarounds for certain browsers
		applyVideoWorkaround();

		var player = videojs('myVideo', options, function() {
		    // print version information at startup
		    var msg = 'Using video.js ' + videojs.VERSION +
		        ' with videojs-record ' + videojs.getPluginVersion('record') +
		        ' and recordrtc ' + RecordRTC.version;
		    videojs.log(msg);
		});

		// error handling
		player.on('deviceError', function() {
		    console.log('device error:', player.deviceErrorCode);
		});

		// user clicked the record button and started recording
		player.on('startRecord', function() {
		    console.log('started recording!');
		});

		// user completed recording and stream is available
		player.on('finishRecord', function() {
		    // the blob object contains the recorded data that
		    // can be downloaded by the user, stored on server etc.
		    console.log('finished recording: ', player.recordedData);
		});
	</script>

@endsection


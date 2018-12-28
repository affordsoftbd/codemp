@extends('layouts.master')

@section('title', "বার্তা হালনাগাদ ||")

@section('extra-css')

        <!-- Video Surfer Css -->
    {{ Html::style('//unpkg.com/videojs-wavesurfer/dist/css/videojs.wavesurfer.min.css') }}

        <!-- Video Recorder Css -->
    {{ Html::style('plugins/video-recorder/css/videojs.record.min.css') }}

    <style>
            /* change player background color */
        #myVideo {
            background-image: linear-gradient(-45deg, #ff1a1a, #ff6666);
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        #myAudio {
            background-image: linear-gradient(-45deg, #ff1a1a, #ff6666);
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .recorder {
            padding-top: 15px; 
            padding-bottom: 15px;
        }
    </style>

@endsection

@section('content')

<h4 class="red-text">বার্তা বিষয় হালনাগাদ করুন</h4>
<hr>

{!! Form::open(['method' => 'put', 'route' => ['messages.subject.update', $subject->id], 'class'=>'md-form', 'name' => 'check_edit']) !!}
    
    {!! Form::hidden('media_path', $subject->media_path) !!}

    <div class="md-form">
        {!! Form::textarea('subject_text', $subject->subject_text, array('class'=>'md-textarea form-control no-resize auto-growth', 'rows'=>'1', 'id'=>'subject_text')) !!}
        {!! Form::label('subject_text', 'বার্তা বিষয়') !!}
    </div>
    @if ($errors->has('subject_text'))
        <p class="red-text">{{ $errors->first('subject_text') }}</p>
    @endif

    <h6 class="font-weight-bold my-3">মিডিয়া যোগ করুন</h6>

    <!-- Media tabs -->
    <ul class="nav nav-tabs md-tabs nav-justified danger-color" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#panel555" role="tab">
        <i class="fa fa-video-camera pr-2"></i>ভিডিও</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panel666" role="tab">
        <i class="fa fa-microphone pr-2"></i>অডিও</a>
      </li>
    </ul>
    <!-- Media tabs -->

    <!-- Media panels -->
    <div class="tab-content">

      <!-- Video Panel -->
      <div class="tab-pane fade in show active" id="panel555" role="tabpanel">

        <div class="recorder success-color-dark z-depth-1-half border border-light rounded mb-0" align="center">
            <video id="myVideo" class="video-js vjs-default-skin">
              <p class="vjs-no-js">
                এই ভিডিওটি দেখতে দয়া করে জাভাস্ক্রিপ্ট সক্রিয় করুন, অথবা একটি আপগ্রেড বিবেচনা করুন ওয়েব ব্রাউজার যে
                <a href="http://videojs.com/html5-video-support/" target="_blank">
                  HTML5 ভিডিও সমর্থন করে.
                </a>
              </p>
            </video>
        </div>

      </div>
      <!-- Video Panel -->

      <!-- Audio Panel -->
      <div class="tab-pane fade" id="panel666" role="tabpanel">

        <div class="recorder success-color-dark z-depth-1-half border border-light rounded mb-0" align="center">
            <audio id="myAudio" class="video-js vjs-default-skin"></audio>
        </div>

      </div>
      <!-- Audio Panel -->

    </div>
    <!-- Media panels -->

    <div class="text-center my-4">
        {!! Form::button('<i class="fa fa-check pr-2"></i>হালনাগাদ', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
    </div>

{!! Form::close() !!}


<a class="btn btn-success waves-effect btn-sm" href="{{ route('messages.show', $subject->id) }}"><i class="fa fa-arrow-circle-left fa-sm pr-2" aria-hidden="true"></i>প্রত্যাবর্তন</a>


@endsection

@section('extra-script')

        <!-- Record RTC Js -->
    {{ Html::script('//cdn.webrtc-experiment.com/RecordRTC.js') }}

        <!-- Adapter Js -->
    {{ Html::script('//unpkg.com/webrtc-adapter/out/adapter.js') }}

        <!-- Webserver Js -->
    {{ Html::script('//unpkg.com/wavesurfer.js/dist/wavesurfer.min.js') }}

        <!-- Webserver Microphone  Js -->
    {{ Html::script('//unpkg.com/wavesurfer.js/dist/plugin/wavesurfer.microphone.min.js') }}

        <!-- Webserver Video Js -->
    {{ Html::script('//unpkg.com/videojs-wavesurfer/dist/videojs.wavesurfer.min.js') }}

        <!-- Video Recorder Js -->
    {{ Html::script('plugins/video-recorder/js/videojs.record.min.js') }}

        <!-- Browser Workarounds Js -->
    {{ Html::script('plugins/video-recorder/js/browser-workarounds.js') }}

    <script>
        var video_options = {
            controls: true,
            width: 280,
            height: 210,
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

        var video_player = videojs('myVideo', video_options, function() {
            // print version information at startup
            var msg = 'Using video.js ' + videojs.VERSION +
                ' with videojs-record ' + videojs.getPluginVersion('record') +
                ' and recordrtc ' + RecordRTC.version;
            videojs.log(msg);
        });

        // error handling
        video_player.on('deviceError', function() {
            console.log('device error:', video_player.deviceErrorCode);
            swal('ডিভাইস ত্রুটি', video_player.deviceErrorCode)
        });

        // user clicked the record button and started recording
        video_player.on('startRecord', function() {
            console.log('started recording!');
        });

        // user completed recording and stream is available
        video_player.on('finishRecord', function() {
            // the blob object contains the recorded data that
            // can be downloaded by the user, stored on server etc.
            console.log('finished recording: ', video_player.recordedData);

                // upload recorded data
            upload(video_player.recordedData);
        });

        var audio_player;
        var audio_options = {
            controls: true,
            width: 280,
            height: 210,
            plugins: {
                wavesurfer: {
                    src: 'live',
                    waveColor: '#36393b',
                    progressColor: 'black',
                    debug: true,
                    cursorWidth: 1,
                    msDisplayMax: 20,
                    hideScrollbar: true
                },
                record: {
                    audio: true,
                    video: false,
                    maxLength: 20,
                    debug: true
                }
            }
        };

            // apply some workarounds for certain browsers
        applyAudioWorkaround();

        if (isSafari) {
                // add start button for safari
            addStartButton();
        } else {
                // other browsers
            createPlayer();
        }

        function createPlayer(event) {
            if (isSafari) {
                if (event) {
                        // hide button on safari
                    event.target.style.display = 'none';
                }
                updateContext(audio_options);
            }
            // create player
            audio_player = videojs('myAudio', audio_options, function() {
                // print version information at startup
                var msg = 'Using video.js ' + videojs.VERSION +
                    ' with videojs-record ' + videojs.getPluginVersion('record') +
                    ', videojs-wavesurfer ' + videojs.getPluginVersion('wavesurfer') +
                    ', wavesurfer.js ' + WaveSurfer.VERSION + ' and recordrtc ' +
                    RecordRTC.version;
                videojs.log(msg);
            });

            // error handling
            audio_player.on('deviceError', function() {
                console.log('device error:', audio_player.deviceErrorCode);
                swal('ডিভাইস ত্রুটি', audio_player.deviceErrorCode);
            });

            // user clicked the record button and started recording
            audio_player.on('startRecord', function() {
                console.log('started recording!');
            });

            // user completed recording and stream is available
            audio_player.on('finishRecord', function() {
                // the blob object contains the recorded data that
                // can be downloaded by the user, stored on server etc.
                console.log('finished recording: ', audio_player.recordedData);

                    // upload recorded data
                upload(audio_player.recordedData);
            });
        }

            // Upload file to server
        function upload(blob) {
            var serverUrl = '/messages/video/record/save';
            var formData = new FormData();
            formData.append('file', blob, blob.name);
            console.log('upload recording ' + blob.name + ' to ' + serverUrl);
                // start upload
            fetch(serverUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                },
            }).then(
                (response) => response.json()
            ).then(
                (responseJSON) => {
                    console.log('Upload record complete '+responseJSON);
                    $('input[name=media_path]').val(responseJSON);
                    showNotification("সাফল্য!", "রেকর্ড মিডিয়া যোগ করা  হয়েছে ", "#", "success", "top", "right", 20, 20, 'animated fadeInDown', 'animated fadeOutUp');
                }
            ).catch(
                error => console.error('an upload error occurred!')
            );
        }
    </script>

@endsection



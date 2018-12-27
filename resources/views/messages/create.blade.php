@extends('layouts.master')

@section('title', "নতুন বার্তা ||")

@section('extra-css')

        <!-- Animation Css -->
    {{ Html::style('plugins/video-recorder/css/videojs.record.min.css') }}

    <style>
            /* change player background color */
        #myVideo {
            background-color: #b3b3b3;
        }
     </style>

@endsection

@section('content')

@section('content')

<h4 class="red-text">{{ !empty($recipient)? $recipient->first_name.' '.$recipient->last_name.' কে বার্তা পাঠান' : 'একটি নতুন বার্তা তৈরি করুন' }}</h4>
<hr>

{!! Form::open(['method' => 'post', 'route' => ['messages.subject.add'], 'class'=>'md-form login-form', 'name' => 'check_edit']) !!}
    @if(!empty($recipient))
        {!! Form::hidden('recipient', $recipient->id) !!}
    @endIf
    <div class="md-form">
        {!! Form::textarea('subject_text', null, array('class'=>'md-textarea form-control no-resize auto-growth', 'rows'=>'1', 'id'=>'subject_text')) !!}
        {!! Form::label('subject_text', 'বার্তা বিষয়') !!}
    </div>
    @if ($errors->has('subject_text'))
        <p class="red-text">{{ $errors->first('subject_text') }}</p>
    @endif

    <h6 class="font-weight-bold my-3">মিডিয়া যোগ করুন</h6>
    
<!-- Nav tabs -->
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
<!-- Nav tabs -->

<!-- Tab panels -->
<div class="tab-content">

  <!-- Panel 1 -->
  <div class="tab-pane fade in show active" id="panel555" role="tabpanel">

    <div class="video-record stylish-color" align="center" style="padding-top: 15px; padding-bottom: 15px;">
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
  <!-- Panel 1 -->

  <!-- Panel 2 -->
  <div class="tab-pane fade" id="panel666" role="tabpanel">

    <p class="pt-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta doloribus reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora, placeat ratione porro voluptate odit minima.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta doloribus reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora, placeat ratione porro voluptate odit minima.</p>

  </div>
  <!-- Panel 2 -->

</div>
<!-- Tab panels -->

    <h6 class="font-weight-bold my-3">বার্তা</h6>
    <div class="md-form">
        {!! Form::textarea('message_text', null, array('class'=>'editor')) !!}
    </div>
    @if ($errors->has('message_text'))
        <p class="red-text">{{ $errors->first('message_text') }}</p>
    @endif
    <div class="text-center my-4">
        {!! Form::button('<i class="fa fa-plus pr-2"></i>যোগ করুন', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
    </div>
{!! Form::close() !!}

<a class="btn btn-success waves-effect btn-sm" href="{{ route('messages.index') }}"><i class="fa fa-arrow-circle-left fa-sm pr-2" aria-hidden="true"></i>প্রত্যাবর্তন</a>


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

                // upload recorded data
            upload(player.recordedData);
        });

        function upload(blob) {
            var serverUrl = '/video/record/save';
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
                success => console.log('upload recording complete.')
            ).catch(
                error => console.error('an upload error occurred!')
            );
        }
    </script>

@endsection



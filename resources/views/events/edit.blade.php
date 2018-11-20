@extends('layouts.master')

@section('title', "ইভেন্টস হালনাগাদ ||")

@section('content')

<h4 class="red-text">ইভেন্ট হালনাগাদ করুন</h4>
<hr>

{!! Form::open(['method' => 'put', 'route' => ['events.update', $event->id], 'class'=>'md-form', 'name' => 'check_edit']) !!}

    {!! Form::hidden('user_id', \Request::session()->get('user_id')) !!}

    <div class="md-form">
        {!! Form::text('title', $event->title, array('class'=>'md-textarea form-control no-resize auto-growth', 'rows'=>'1', 'id'=>'title')) !!}
        {!! Form::label('title', 'ইভেন্ট শিরনাম') !!}
    </div>
    @if ($errors->has('title'))
        <p class="red-text">{{ $errors->first('title') }}</p>
    @endif
    <div class="md-form">
      {!! Form::text('event_date', date('l d F Y - H:i', strtotime($event->event_date)), array('class' =>'form-control datetimepicker', 'id'=>'event_date')) !!}
      {!! Form::label('event_date', 'ইভেন্ট তারিখ এবং সময়') !!}
    </div>
    @if($errors->has('event_date'))
        <p class="red-text">{{ $errors->first('event_date') }}</p>
    @endif
    <h6 class="font-weight-bold my-3">বিস্তারিত</h6>
    <div class="md-form">
        {!! Form::textarea('details', $event->details, array('class'=>'editor')) !!}
    </div>
    @if ($errors->has('details'))
        <p class="red-text">{{ $errors->first('details') }}</p>
    @endif
    <div class="text-center my-4">
        {!! Form::button('<i class="fa fa-plus pr-2"></i>যোগ করুন', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
    </div>
{!! Form::close() !!}


<a class="btn btn-success waves-effect btn-sm" href="{{ route('events.show', $event->id) }}"><i class="fa fa-arrow-circle-left fa-sm pr-2" aria-hidden="true"></i>প্রত্যাবর্তন</a>


@endsection

@section('extra-script')

@if(!empty(old('event_date')))
    <div id="format_date" style="display: none;">{{ date('l d F Y - H:i', strtotime(old('event_date'))) }}</div>
@endif

<script type="text/javascript">
    if($("#format_date").length != 0)
    {
        $("input[name=event_date]").val($('#format_date').text());
    }
</script>

@endsection
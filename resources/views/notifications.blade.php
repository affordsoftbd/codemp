@extends('layouts.master')

@section('title', "সমস্ত বিজ্ঞপ্তিগুলি ||")

@section('content')

<h4 class="font-weight-bold green-text">বিজ্ঞপ্তি</h4>
<small class="red-text">এখানে আপনি প্রাপ্ত সমস্ত বিজ্ঞপ্তিগুলোর তালিকা!</small>
<hr>

@foreach($notifications as $notification)
  <a href="{{ $notification->data['link'] }}" target="_blank">
    <div class="card mb-5">
      <div class="card-body green">
        <div class="row">
          <div class="col-lg-1">
            <span class="badge badge-pill red"><i class="fa fa-{{ $notification->data['icon'] }} fa-2x" aria-hidden="true"></i></span>
          </div>
          <div class="col-lg-11">
            <p class="white-text">{{ $notification->data['text'] }}</p>
            <small class="white-text">{{ date('l, d F Y', strtotime($notification->created_at)) }}</small>
          </div>
        </div>
      </div>
    </div>
  </a>
@endforeach

<!-- Pagination -->
<nav aria-label="Page navigation example" class="table-responsive">
    <ul class="pagination pg-blue justify-content-end">
      <ul class="pagination pg-blue">
          {{ $notifications->links() }}                 
      </ul>
    </ul>
</nav>

@endsection
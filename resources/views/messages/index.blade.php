@extends('layouts.master')

@section('title', "বার্তা ||")

@section('content')


<h2>{{ empty($search) ? 'List of ' : 'Search' }} Participated Messages</h2>
<p>Following are the list of messages {{ empty($search) ? 'you have participated in' : 'based on your search' }}.</p>

@if(empty($search))
<a href="{{ route('messages.create') }}" class="btn btn-outline-danger btn-rounded waves-effect"><i class="fa fa-plus pr-2"></i>নতুন বার্তা যোগ করুন</a>
@else
  <a class="btn btn-sm btn-dark-green" href="{{ route('messages.index') }}"><i class="fa fa-refresh fa-sm pr-2"" aria-hidden="true"></i> রিফ্রেশ তালিকা</a>
@endif

{!! Form::open(['url' => '/messages', 'method'=>'get']) !!}
	<div class="row mb-5">
	  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
	    <!-- Material input email -->
	    <div class="md-form">
	        {!! Form::text('search', $search, ['class'=>'form-control', 'id'=>'search']) !!}
	        {!! Form::label('search', 'বার্তা অনুসন্ধান') !!}
	    </div>
	  </div>
	  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	    <div class="text-center mt-4">
	      {!! Form::button('<i class="fa fa-search"></i>', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
	    </div>
	  </div>
	</div>
{!! Form::close() !!}

@foreach($subjects as $subject)
	<a href="{{ route('messages.show', $subject->id) }}" target="_blank">
	  <div class="row mb-5">
	    <div class="col-lg-1">
	     <img src="http://via.placeholder.com/450" class="img-fluid rounded-circle z-depth-0">
	    </div>
	    <div class="col-lg-11">
	      <div class="card">
	        <div class="card-body {{ $subject->receipents->first()->user->id == $user->id ? 'green'  : 'red' }} white-text">
	          {{ $subject->subject }} 
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
        {{ $subjects->links() }}                 
    </ul>
  </ul>
</nav>

@endsection



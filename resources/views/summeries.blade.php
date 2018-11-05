@extends('layouts.master')

@section('title', "সংক্ষিপ্তসার ||")

@section('content')

	<a href="#" target="_blank">
	  <div class="row mb-5">
	    <div class="col-lg-1">
	     <img src="" class="img-fluid rounded-circle z-depth-0">
	    </div>
	    <div class="col-lg-11">
	      <div class="card">
	        <div class="card-body green white-text">
	          New Messages:  
	        </div>
	      </div> 
	    </div>
	  </div>
	</a>

	<a href="{{ route('followers') }}" target="_blank">
	  <div class="row mb-5">
	    <div class="col-lg-1">
	     <img src="" class="img-fluid rounded-circle z-depth-0">
	    </div>
	    <div class="col-lg-11">
	      <div class="card">
	        <div class="card-body green white-text">
	          Total Followers: {{ count($followers)}}
	        </div>
	      </div> 
	    </div>
	  </div>
	</a>

	<a href="{{ route('politicians') }}" target="_blank">
	  <div class="row mb-5">
	    <div class="col-lg-1">
	     <img src="" class="img-fluid rounded-circle z-depth-0">
	    </div>
	    <div class="col-lg-11">
	      <div class="card">
	        <div class="card-body green white-text">
	          New Applicants: {{ count($new_applicants)}}
	        </div>
	      </div> 
	    </div>
	  </div>
	</a>

	<a href="{{ route('politicians') }}" target="_blank">
	  <div class="row mb-5">
	    <div class="col-lg-1">
	     <img src="" class="img-fluid rounded-circle z-depth-0">
	    </div>
	    <div class="col-lg-11">
	      <div class="card">
	        <div class="card-body green white-text">
	          Total Applicants: {{ count($all_applicants)}}
	        </div>
	      </div> 
	    </div>
	  </div>
	</a>

@endsection



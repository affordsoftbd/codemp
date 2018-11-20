@extends('layouts.master')

@section('title', "সংক্ষিপ্তসার ||")

@section('content')

	<div class="row">
		<div class="col-lg-6">
			<div class="card mb-3">
		        <div class="card-body light-green white-text">
		        	<h1 class="font-weight-bold my-5 text-center">
		        		<i class="fa fa fa-flag fa-sm pr-2"></i>
		          		<small>কর্মচারীর সংখ্যা: {{ count($workers)}}</small>
		        	</h1>  
		        </div>
		    </div>
		</div>
		<div class="col-lg-6">
			<div class="card mb-3">
		        <div class="card-body red white-text">
		        	<h1 class="font-weight-bold my-5 text-center">
		          		<i class="fa fa-user-circle fa-sm pr-2"></i>
		          		<small>অনুসারীর সংখ্যা: {{ count($followers)}}</small>
		      		</h1>
		        </div>
		    </div>
		</div>
		<div class="col-lg-6">
			<div class="card mb-3">
		        <div class="card-body deep-orange white-text">
		        	<h1 class="font-weight-bold my-5 text-center">
		        		<i class="fa fa-user-plus fa-sm pr-2"></i>
		        		<small>নতুন আবেদনকারী: {{ count($new_applicants)}}</small>
		      		</h1>
		        </div>
		    </div>
		</div>
		<div class="col-lg-6">
			<div class="card mb-3">
		        <div class="card-body green white-text">
		        	<h1 class="font-weight-bold my-5 text-center">
		        		<i class="fa fa-group fa-sm pr-2"></i>
		          		<small>আবেদনকারীর সংখ্যা: {{ count($all_applicants)}}</small>  
		      		</h1>
		        </div>
		    </div>
		</div>
	</div>

@endsection



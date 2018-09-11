@extends('layouts.master')

@section('title', "ফিড || ")

@section('content')

<h4>What's on your mind?</h4><hr>
{!! Form::open() !!}	
    <div class="md-form">
    	{!! Form::textarea('additional_details', null, array('class'=>'editor')) !!}
    </div>
    <div class="text-center my-4">
    	{!! Form::button('Update Status', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm pull-right')) !!}
    </div>
{!! Form::close() !!}

 <div class="clearfix"></div>


<div class="card my-3">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        You are logged in!
    </div>
</div>
<div class="card my-3">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        You are logged in!
    </div>
</div>
<div class="card my-3">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        You are logged in!
    </div>
</div>
<div class="card my-3">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        You are logged in!
    </div>
</div>
<div class="card my-3">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        You are logged in!
    </div>
</div>
@endsection



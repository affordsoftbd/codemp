<div class="row">
    <div class="col-xl-8 col-lg-6 col-md-6">
		<h1>
			{{ $user->first_name." ".$user->last_name}}
		</h1>
		<small class="grey-text"><strong>সিলেট > মোগগ্রারা সদর > সোনারগাঁও উপজেলা</strong> অধীনে <strong>নেতা</strong> হিসেবে যোগদান করেছেন</small>
		<hr>
		<p class="red-text font-weight-bold">
			<i class="fa fa-envelope prefix grey-text fa-sm pr-2"></i>
			{{ $user->email}}
		</p>
		<p class="red-text font-weight-bold">
			<i class="fa fa-phone prefix grey-text fa-sm pr-2"></i>
			{{ $user->phone}}
		</p>
		<p class="red-text font-weight-bold">
			<i class="fa fa-address-card prefix grey-text fa-sm pr-2"></i>
			{{ $user->address}}
		</p>
		<div class="btn-group my-4" role="group" aria-label="Basic example">
		    <a type="button" href="{{ route('profile.edit', $user->username) }}" class="btn btn-light-green btn-sm"><i class="fa fa-edit fa-sm pr-2" aria-hidden="true"></i>প্রোফাইল হালনাগাদ</a>
		    <a type="button" href="{{ route('profile.edit', $user->username) }}" class="btn btn-light-green btn-sm"><i class="fa fa-edit fa-sm pr-2" aria-hidden="true"></i>পাসওয়ার্ড  হালনাগাদ</a>
		    <a type="button" href="javascript:void(0)" class="btn btn-dark-green btn-sm"><i class="fa fa-bank fa-sm pr-2" aria-hidden="true"></i>অর্থাদি</a>
		</div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6">
		<!-- Card -->
		<div class="card card-personal">

			<!-- Card image-->			
			@if($user->image_path!='')
	            <img class="card-img-top" src="{{ url('/').$user->image_path}}" alt="Card image cap">
	        @else
	            <img class="card-img-top"  src="{{ url('/').'/img/avatar.png'}}" alt="Card image cap">
	        @endif
			<!-- Card image-->

			<!-- Card content -->
			<div class="card-body">
			  <p class="card-meta">অংশগ্রহন {{ date('d F Y',strtotime($user->created_at))}}</p>
			  <hr>
			  <a class="card-meta"><span><i class="fa fa-user"></i>{{ count($followers)}} অনুগামিগণ</span></a>
			</div>
			<!-- Card content -->

		</div>
		<!-- Card -->
    </div>
</div>
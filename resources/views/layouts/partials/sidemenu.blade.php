<div class="list-group sticky-top">
    <a href="{{ route('home') }}" class="list-group-item list-group-item-action waves-effect {{ Route::is('home')? 'active':'' }}">
        <i class="fa fa-rss fa-sm pr-2"></i>ফিড
    </a>
    <a href="{{ route('news') }}" class="list-group-item list-group-item-action waves-effect {{ Route::is('news*')? 'active':'' }}">
        <i class="fa fa-newspaper-o fa-sm pr-2"></i>খবর
    </a>
    <!-- <a href="#" class="list-group-item list-group-item-action waves-effect">
        <i class="fa fa-question-circle fa-sm pr-2"></i>প্রশ্নাবলি
    </a> -->
    <!-- <a href="#" class="list-group-item list-group-item-action waves-effect">
    	<i class="fa fa-video-camera fa-sm pr-2"></i>ভিডিও চ্যাট
	</a> -->
    <a href="#" class="list-group-item list-group-item-action waves-effect">
        <i class="fa fa-calendar fa-sm pr-2"></i>ইভেন্টস
    </a>
    <a href="{{ route('messages.index') }}" class="list-group-item list-group-item-action {{ Route::is('messages*')? 'active':'' }} waves-effect">
        <i class="fa fa-envelope fa-sm pr-2"></i>বার্তা
    </a>
    <a href="#" class="list-group-item list-group-item-action waves-effect">
        <i class="fa fa-dashboard fa-sm pr-2"></i>সংক্ষিপ্তসার
    </a>
    <a href="{{ route('profile', Session::get('username')) }}" class="list-group-item list-group-item-action {{Route::is('profile*')? 'active':''}} waves-effect">
        <i class="fa fa-user fa-sm pr-2"></i>প্রোফাইল
    </a>
    <a href="{{ route('politicians') }}" class="list-group-item list-group-item-action waves-effect {{ Route::is('politicians*')? 'active':'' }}">
        <i class="fa fa-certificate fa-sm pr-2"></i>নেতা/কর্মীগণ
    </a>
    <a href="{{ route('requests') }}" class="list-group-item list-group-item-action waves-effect {{ Route::is('requests*')? 'active':'' }}">
        <i class="fa fa-user-plus fa-sm pr-2"></i>আবেদন <span style="display:none" class="new_count" id="request_count">0</span> 
    </a>
    <a href="{{ route('followers') }}" class="list-group-item list-group-item-action waves-effect {{ Route::is('followers*')? 'active':'' }}">
        <i class="fa fa-group fa-sm pr-2"></i>অনুসারী
    </a>
</div>
<div class="list-group sticky-top">
    <a href="{{ route('home') }}" class="list-group-item list-group-item-action waves-effect {{ Route::is('home')? 'active':'' }}">
        <i class="fa fa-rss fa-sm pr-2"></i>ফিড
    </a>
    <a href="{{ route('news') }}" class="list-group-item list-group-item-action waves-effect {{ Route::is('news*')? 'active':'' }}">
        <i class="fa fa-newspaper-o fa-sm pr-2"></i>খবর
    </a>
    <a href="{{ route('events.index') }}" class="list-group-item list-group-item-action {{ Route::is('events*')? 'active':'' }} waves-effect">
        <i class="fa fa-calendar fa-sm pr-2"></i>ইভেন্টস
    </a>
    <a href="{{ route('messages.index') }}" class="list-group-item list-group-item-action {{ Route::is('messages*')? 'active':'' }} waves-effect">
        <i class="fa fa-envelope fa-sm pr-2"></i>বার্তা
    </a>
    <a href="{{ route('summeries') }}" class="list-group-item list-group-item-action {{Route::is('summeries*')? 'active':''}} waves-effect">
        <i class="fa fa-dashboard fa-sm pr-2"></i>সংক্ষিপ্তসার
    </a>
    <a href="{{ route('profile', Session::get('username')) }}" class="list-group-item list-group-item-action {{Route::is('profile*')? 'active':''}} waves-effect">
        <i class="fa fa-user fa-sm pr-2"></i>প্রোফাইল
    </a>
    <a href="{{ route('politicians') }}" class="list-group-item list-group-item-action waves-effect {{ Route::is('politicians*')? 'active':'' }}">
        <i class="fa fa-certificate fa-sm pr-2"></i>নেতা/কর্মীগণ
    </a>
    <a href="{{ route('requests') }}" class="list-group-item list-group-item-action justify-content-between align-items-center waves-effect {{ Route::is('requests*')? 'active':'' }}">
        <i class="fa fa-user-plus fa-sm pr-2"></i>আবেদনকারী
        <span class="badge badge-danger badge-pill new_count" style="display:none" id="request_count">0</span>
    </a>
    <a href="{{ route('followers') }}" class="list-group-item list-group-item-action waves-effect {{ Route::is('followers*')? 'active':'' }}">
        <i class="fa fa-user-circle fa-sm pr-2"></i>অনুসারী
    </a>
    <a href="{{ route('group') }}" class="list-group-item list-group-item-action waves-effect {{ Route::is('group*')? 'active':'' }}">
        <i class="fa fa-group fa-sm pr-2"></i>গ্রুপ সমূহ
    </a>
</div>
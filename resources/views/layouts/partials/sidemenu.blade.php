<div class="list-group sticky-top">
    <a href="{{ route('home') }}" class="list-group-item list-group-item-action waves-effect {{ Route::is('home')? 'active':'' }}">
        <i class="fa fa-rss fa-sm pr-2"></i>ফিড
    </a>
    <a href="#" class="list-group-item list-group-item-action waves-effect">
    	<i class="fa fa-group fa-sm pr-2"></i>গ্রুপ
	</a>
	<a href="#" class="list-group-item list-group-item-action waves-effect">
        <i class="fa fa-dashboard fa-sm pr-2"></i>পরিষদ্
    </a>
    <a href="#" class="list-group-item list-group-item-action waves-effect">
        <i class="fa fa-question-circle fa-sm pr-2"></i>প্রশ্নাবলি
    </a>
	<a href="#" class="list-group-item list-group-item-action waves-effect">
        <i class="fa fa-envelope fa-sm pr-2"></i>বার্তা
    </a>
    <a href="#" class="list-group-item list-group-item-action waves-effect">
    	<i class="fa fa-video-camera fa-sm pr-2"></i>ভিডিও চ্যাট
	</a>
    <a href="{{ route('profile', Session::get('username')) }}" class="list-group-item list-group-item-action {{Route::is('profile*')? 'active':''}} waves-effect">
        <i class="fa fa-user fa-sm pr-2"></i>প্রোফাইল
    </a>
    <a href="#" class="list-group-item list-group-item-action waves-effect">
        <i class="fa fa-user-circle fa-sm pr-2"></i>অনুসারী
    </a>
</div>
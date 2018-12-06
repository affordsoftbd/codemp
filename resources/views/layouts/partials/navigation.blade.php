<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark green fixed-top">
    <div class="container">
    <a class="navbar-brand font-weight-bold" href="{{ route('home') }}">
        <span class="yellow-text"><i class="fa fa-certificate fa-sm pr-2" aria-hidden="true"></i></span>আমারনেতা
    </a>

    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

        <form class="form-inline mr-auto" method="get" action="{{ route('politicians') }}">
            <div class="md-form my-0">
                <input class="form-control mr-sm-2" type="text" name="keyword" placeholder="খুজুন" aria-label="Search">
                <button type="submit" class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>

        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item {{ Route::is('home')? 'active':'' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fa fa-rss pr-1"></i>
                    ফিড
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item dropdown" id="notifications_navigation_menu">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span id="new_notification_number" data-url="{{ route('notifications.new') }}">0</span>
                  <i class="fa fa-bell"></i>
                </a>
                <!-- Notification Dropdown -->
                <div class="dropdown-menu dropdown-menu-right dropdown-wide dropdown-success">
                    <p class="text-center h6">বিজ্ঞপ্তিগুলি</p>
                    <div class="dropdown-divider"></div>
                    <div id="all_new_notifications" data-url="{{ route('notifications.new') }}"></div>
                    <a class="dropdown-item text-center" href="{{ route('notifications.index') }}">সকল বিজ্ঞপ্তি প্রদর্শন</a>
                </div>
                <!-- Notification Dropdown -->
            </li> 
            <li class="nav-item dropdown" id="messages_navigation_menu">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="new_messages_number" data-url="{{ route('messages.new') }}">0</span>
                    <i class="fa fa-envelope"></i>
                </a>
                <!-- Messages Dropdown -->
                <div class="dropdown-menu dropdown-wide dropdown-success">
                  <p class="text-center h6">বার্তা</p>
                  <div class="dropdown-divider"></div>
                  <div id="all_new_messages" data-url="{{ route('messages.new') }}"></div>
                  <a class="dropdown-item text-center" href="{{ route('messages.index') }}">সকল বার্তা প্রদর্শন</a>
                </div>
            </li>

            <!-- Dropdown -->
            <li class="nav-item avatar dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ file_exists(Session::get('image_path')) ? asset(Session::get('image_path')) : url('/').'/img/avatar.png' }}" class="img-fluid rounded-circle z-depth-0">
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-success" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('summeries') }}"><i class="fa fa-dashboard fa-sm pr-2"></i>সংক্ষিপ্তসার</a>
                    <a class="dropdown-item" href="{{ route('profile', Session::get('username')) }}"><i class="fa fa-user fa-sm pr-2"></i>প্রোফাইল</a>
                    <a class="dropdown-item" href="{{ url('logout')}}"><i class="fa fa-sign-out fa-sm pr-2"></i>প্রস্থান</a>
                </div>
            </li>

        </ul>
        <!-- Links -->
    </div>
    <!-- Collapsible content -->
    </div>
</nav>
<!--/.Navbar-->
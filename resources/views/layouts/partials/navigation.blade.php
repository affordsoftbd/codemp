<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark green fixed-top">
    <div class="container">
    <a class="navbar-brand" href="#">
        <img src="https://adminpanelproject.000webhostapp.com/amarneta/img/icons/favicon.png" height="30" alt="">
    </a>

    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

        <form class="form-inline mr-auto">
            <div class="md-form my-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
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
                  <span id="new_notification_number">0</span>
                  <i class="fa fa-bell"></i>
                </a>
                <!-- Notification Dropdown -->
                <div class="dropdown-menu dropdown-menu-right dropdown-wide dropdown-success">
                    <p class="text-center h6">বিজ্ঞপ্তিগুলি</p>
                    <div class="dropdown-divider"></div>
                    <div id="all_new_notifications"></div>
                    <a class="dropdown-item text-center" href="javascript:void(0)">সমস্ত বিজ্ঞপ্তিগুলি</a>
                </div>
                <!-- Notification Dropdown -->
            </li> 
            <li class="nav-item dropdown" id="messages_navigation_menu">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="new_messages_number">0</span>
                    <i class="fa fa-envelope"></i>
                </a>
                <!-- Messages Dropdown -->
                <div class="dropdown-menu dropdown-wide dropdown-success">
                  <p class="text-center h6">বার্তা</p>
                  <div class="dropdown-divider"></div>
                  <div id="all_new_messages"></div>
                  <a class="dropdown-item" href="javascript:void(0)">সব বার্তা প্রদর্শন করতে এখানে ক্লিক করুন</a>
                </div>
            </li>

            <!-- Dropdown -->
            <li class="nav-item avatar dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-2.jpg" class="img-fluid rounded-circle z-depth-0">
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-success" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('profile', 'amarneta_user') }}"><i class="fa fa-user fa-sm pr-2"></i>প্রোফাইল</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-cog fa-sm pr-2"></i>সেটিংস</a>
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
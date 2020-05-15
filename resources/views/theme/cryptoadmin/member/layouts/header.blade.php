<header class="main-header">
    <a href="" class="logo">
        <!-- mini logo -->
        <div class="logo-mini">
            <span class="light-logo"><img src="{{asset('theme/cyptoadmin/images/logo-light.png')}}" alt="logo"></span>
            <span class="dark-logo"><img src="{{asset('theme/cyptoadmin/images/logo-dark.png')}}" alt="logo"></span>
        </div>
        <!-- logo-->
        <div class="logo-lg">
            <span class="light-logo"><img src="{{asset('theme/cyptoadmin/images/logo-light-text.png')}}" alt="logo"></span>
            <span class="dark-logo"><img src="{{asset('theme/cyptoadmin/images/logo-dark-text.png')}}" alt="logo"></span>
        </div>
    </a>
    <nav class="navbar navbar-static-top">
        <div>
            <a href="#" data-provide="fullscreen" class="sidebar-toggle" title="Full Screen">
                <i class="mdi mdi-crop-free"></i>
            </a>
        </div>

        <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
                <li class="search-bar">
                
                    <div class="lookup lookup-circle lookup-right">
                        <input type="text" name="search">
                    </div>
                </li>
                <!-- Messages -->
                <li class="dropdown">
                    <a class="dropdown-toggle" href="{{route('login')}}"  title="{{__('default.info.login')}}">
                        <i class="mdi mdi-login-variant"></i>
                    </a>
                </li>
            </ul>
        </div>


    </nav>
</header>

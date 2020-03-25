<!-- Notifications -->
<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Notifications">
        <i class="mdi mdi-test-tube"></i>
    </a>
    <ul class="dropdown-menu animated bounceIn">

        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu sm-scrol">
                <li>
                    <a href="/">
                        <i class="fa fa-users text-info"></i>User
                        @if(Auth::guard('web')->check())
                            <span class="badge badge-pill badge-success">On</span>
                        @else
                            <span class="badge badge-pill badge-default">off</span>
                        @endif

                    </a>
                </li>
                <li>
                    <a href="{{route('member.login')}}">
                        <i class="fa fa-users text-primary"></i>Member
                        @if(Auth::guard('member')->check())
                            <span class="badge badge-pill badge-success">On</span>
                        @else
                            <span class="badge badge-pill badge-default">off</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.login')}}">
                        <i class="fa fa-user-circle text-danger"></i>Admin
                        @if(Auth::guard('admin')->check())
                            <span class="badge badge-pill badge-success">On</span>
                        @else
                            <span class="badge badge-pill badge-default">off</span>
                        @endif
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</li>
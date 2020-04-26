<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="../index.html">
                    <!-- logo for regular state and mobile devices -->
                    <h3><b>Crypto</b>Admin</h3>
                </a>
            </div>
            <div class="profile-pic">
                <img src="{{Auth::guard('admin')->user()->avatar}}" alt="user">
                <div class="profile-info"><h5 class="mt-15">{{Auth::guard('admin')->user()->name}}</h5>
                    <div class="text-center d-inline-block">
                        <a href="" class="link" data-toggle="tooltip" title="" data-original-title="Settings"><i class="ion ion-gear-b"></i></a>
                        <a href="" class="link px-15" data-toggle="tooltip" title="" data-original-title="Email"><i class="ion ion-android-mail"></i></a>
                        <a href="" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ion ion-power"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="header nav-small-cap">PERSONAL</li>
            <li class="treeview">
                <a href="#">
                    <i class="ti-user"></i>
                    <span>監測</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.logViewer.index')}}"><i class="ti-more"></i>Logs</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="ti-user"></i>
                    <span>會員</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.adminUser.index')}}"><i class="ti-more"></i>User - 清單</a></li>
                    <li><a href="{{route('admin.adminMember.index')}}"><i class="ti-more"></i>Member - 清單</a></li>
                    <li><a href="{{route('admin.adminStaff.index')}}"><i class="ti-more"></i>Staff - 清單</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="ti-user"></i>
                    <span>權限系統</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.adminRole.index')}}"><i class="ti-more"></i>Role - 角色</a></li>
                    <li><a href="{{route('admin.adminPermission.index')}}"><i class="ti-more"></i>Permission - 權限</a></li>
                    <li><a href="{{route('admin.adminStaffRolePermission.index')}}"><i class="ti-more"></i>Staff - 指派權限</a></li>
                    
                </ul>
            </li>
        </ul>
    </section>
</aside>

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="/">
                    <!-- logo for regular state and mobile devices -->
                    <h3><b>Crypto</b>Admin</h3>
                </a>
            </div>
            <div class="profile-pic">
                <img src="{{Auth::guard('staff')->user()->avatar}}" alt="user">
                <div class="profile-info"><h5 class="mt-15">{{Auth::guard('staff')->user()->name}}</h5>
                    <div class="text-center d-inline-block">
                        <a href="" class="link" data-toggle="tooltip" title="" data-original-title="Settings"><i class="ion ion-gear-b"></i></a>
                        <a href="" class="link px-15" data-toggle="tooltip" title="" data-original-title="Email"><i class="ion ion-android-mail"></i></a>
                        <a href="" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ion ion-power"></i></a>
                    </div>
                </div>
            </div>
        </div>
    
        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-vcard "></i>
                    <span>人事資料維護</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('staff.staff.index')}}"><i class="ti-more"></i>員工基本資料</a></li>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cubes"></i>
                    <span>生產設定</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('staff.mhMold.index')}}"><i class="ti-more"></i>模具基本基料</a></li>
                </ul>
            </li>
        </ul>
        
        <ul class="sidebar-menu" data-widget="tree">

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-clipboard"></i>
                    <span>生管資料維護</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('staff.staffExcelLike.index')}}"><i class="ti-more"></i>報表維護</a></li>
                </ul>
            </li>
        </ul>
        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span>報表</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('staff.reportMHOrder.analysis')}}"><i class="ti-more"></i>訂單報表</a></li>
                    <li><a href="{{route('staff.reportMHMold.analysis')}}"><i class="ti-more"></i>模具報表</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-line-chart"></i>
                    <span>成本模組</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                   
                    <li><a href="{{route('staff.staffExcelView.costSPLabor')}}"><i class="ti-more"></i>SP 人工計算</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>

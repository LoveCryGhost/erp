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
                <img src="{{Auth::guard('member')->user()->avatar}}" alt="user">
                <div class="profile-info"><h5 class="mt-15">{{Auth::guard('member')->user()->name}}</h5>
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

            <li class="treeview">
                <a href="#">
                    <i class="ti-cup"></i>
                    <span>供應商模組</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('member.supplierGroup.index')}}"><i class="ti-more"></i>供應商群組</a></li>
                    <li><a href="{{route('member.supplier.index')}}"><i class="ti-more"></i>供應商</a></li>
                    <li><a href="#"><i class="ti-more"></i>供應商聯絡人</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="ti-cup"></i>
                    <span>產品模組</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('member.attribute.index')}}"><i class="ti-more"></i>產品屬性</a></li>
                    <li><a href="{{route('member.type.index')}}"><i class="ti-more"></i>產品類型</a></li>
                    <li><a href="{{route('member.product.index')}}"><i class="ti-more"></i>產品</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="ti-cup"></i>
                    <span>Shopee爬蟲模組</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('member.crawlertask.index')}}"><i class="ti-more"></i>Shoppee任務</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
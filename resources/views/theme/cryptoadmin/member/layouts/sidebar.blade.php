<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="/">
                    <!-- logo for regular state and mobile devices -->
                    <h3><b>{{__('member/sidebar.title')}}</b></h3>
                </a>
            </div>
            <div class="profile-pic">
                <img src="{{Auth::guard('member')->user()->avatar}}" alt="user">
                <div class="profile-info"><h5 class="mt-15">{{Auth::guard('member')->user()->name}}</h5>
                    <div class="text-center d-inline-block">
                        <a href="" class="link" data-toggle="tooltip" title="" data-original-title="{{__('default.info.setting')}}"><i class="ion ion-gear-b"></i></a>
                        <a href="" class="link px-15" data-toggle="tooltip" title="" data-original-title="{{__('default.info.email')}}"><i class="ion ion-android-mail"></i></a>
                        <a href="" class="link" data-toggle="tooltip" title="" data-original-title="{{__('default.info.logout')}}"><i class="ion ion-power"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            
            @can('member.supplier.index')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-chain"></i>
                    <span>{{__('member/sidebar.supplier.ul')}}</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('member.supplierGroup.index')}}"><i class="ti-more"></i>{{__('member/sidebar.supplier.supplierGroup')}}</a></li>
                    <li><a href="{{route('member.supplier.index')}}"><i class="ti-more"></i>{{__('member/sidebar.supplier.supplier')}}</a></li>
                    <li><a href="#"><i class="ti-more"></i>{{__('member/sidebar.supplier.supplierContact')}}</a></li>
                </ul>
            </li>
            @endcan
    
            @can('member.product.index')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cubes"></i>
                    <span>{{__('member/sidebar.product.ul')}}</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('member.attribute.index')}}"><i class="ti-more"></i>{{__('member/sidebar.product.attribute')}}</a></li>
                    <li><a href="{{route('member.type.index')}}"><i class="ti-more"></i>{{__('member/sidebar.product.type')}}</a></li>
                    <li><a href="{{route('member.product.index')}}"><i class="ti-more"></i>{{__('member/sidebar.product.product')}}</a></li>
                </ul>
            </li>
            @endcan

            @can('member.crawlerTask.index')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bug"></i>
                    <span>{{__('member/sidebar.shopee.ul')}}</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('member.crawlerTask.index')}}"><i class="ti-more"></i>{{__('member/sidebar.shopee.task')}}</a></li>
                </ul>
            </li>
            @endcan

            @can('member.reportSKU.crawlerItemAanalysis')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bar-chart"></i>
                        <span>{{__('member/sidebar.report.ul')}}</span>
                        <span class="pull-right-container">
                  <i class="fa fa-angle-right pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('member.reportSKU.crawlerItemAanalysis')}}"><i class="ti-more"></i>{{__('member/sidebar.report.reportSKU.crawlerItemAnalysis')}}</a></li>
                    </ul>
                </li>
            @endcan

        </ul>
    </section>
</aside>

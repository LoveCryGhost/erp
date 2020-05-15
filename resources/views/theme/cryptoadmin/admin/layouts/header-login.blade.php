<header class="main-header">
    <a href="/" class="logo">
        <!-- mini logo -->
        <div class="logo-mini">
            <span class="light-logo"><img src="{{asset('theme/cryptoadmin/images/logo-light.png')}}" alt="logo"></span>
            <span class="dark-logo"><img src="{{asset('theme/cryptoadmin/images/logo-dark.png')}}" alt="logo"></span>
        </div>
        <!-- logo-->
        <div class="logo-lg">
            <span class="light-logo"><img src="{{asset('theme/cryptoadmin/images/logo-light-text.png')}}" alt="logo"></span>
            <span class="dark-logo"><img src="{{asset('theme/cryptoadmin/images/logo-dark-text.png')}}" alt="logo"></span>
        </div>
    </a>
    <nav class="navbar navbar-static-top">
        <div class="text-middle">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <i class="ti-align-left"></i>
            </a>
            <a href="#" data-provide="fullscreen" class="sidebar-toggle" title="Full Screen">
                <i class="mdi mdi-crop-free"></i>
            </a>
    
            @php
                $countries = ['tw', 'th', 'id'];
                $crawlerCategory =  new App\Models\CrawlerCategory();
                $crawlerTask =  new App\Models\CrawlerTask();
                $crawlerItem =  new App\Models\CrawlerItem();
                $crawlerCategory_total = [];
                $crawlerCategory_total_updated = [];
                $crawlerTask_total = [];
                $crawlerTask_total_updated = [];
                $crawlerItem_total = [];
                $crawlerItem_total_updated = [];
                foreach($countries = ['tw', 'th', 'id'] as $country){
                    $crawlerCategory_total[$country] = $crawlerCategory->where('local',$country)->count();
                    $crawlerCategory_total_updated[$country] =  $crawlerCategory->where('local', $country)->whereDate('updated_at','=',(new Carbon\Carbon())->today())->whereNotNull('updated_at')->count();
                    $crawlerTask_total[$country] = $crawlerTask->where('local', $country)->count();
                    $crawlerTask_total_updated[$country] = $crawlerTask->where('local',$country)->whereDate('updated_at','=',(new Carbon\Carbon())->today())->whereNotNull('updated_at')->count();
                    $crawlerItem_total[$country] = $crawlerItem->where('local',$country)->count();
                    $crawlerItem_total_updated[$country] = $crawlerItem->where('local',$country)->whereDate('updated_at','=',(new Carbon\Carbon())->today())->whereNotNull('updated_at')->count();
                }
                
            @endphp
            <div class="pull-left">
                <table class="itable fontsize-1 m-0 p-0  font-size-1">
                    <thead>
                        <tr>
                            <th>國家</th>
                            <th>Category</th>
                            <th>Task</th>
                            <th>Item</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(current(explode('.', request()->getHost())) == "test")
                            @foreach($countries as $country)
                                <tr>
                                    <td>{{$country}}</td>
                                    <td>
                                        @if($crawlerCategory_total[$country]>0)
                                            {{$crawlerCategory_total_updated[$country]}} / {{$crawlerCategory_total[$country]}}
                                        @endif
                                        <a href="http://test.mherp.test/run/crawlerCategoryJob"><i class="btn btn-sm btn-primary fa fa-refresh"></i></a>
                                    </td>
                                    <td>
                                        @if($crawlerTask_total[$country]>0)
                                            {{$crawlerTask_total_updated[$country]}} / {{$crawlerTask_total[$country]}}
                                        @endif
                                        <a href="http://test.mherp.test/run/crawlerTaskJob"><i class="btn btn-sm btn-primary fa fa-refresh"></i></a>
                                    </td>
                                    <td>
                                        @if($crawlerItem_total[$country]>0)
                                            {{$crawlerItem_total_updated[$country]}}/ {{$crawlerItem_total[$country]}} ({{ number_format( ($crawlerItem_total_updated[$country]/$crawlerItem_total[$country])*100 , 2,".",',')}}%)
                                        @endif
                                        <a href="http://test.mherp.test/run/crawlerItemJob"><i class="btn btn-sm btn-primary fa fa-refresh"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @foreach($countries as $country)
                                <tr>
                                    <td>{{$country}}</td>
                                    <td>
                                        @if($crawlerCategory_total[$country]>0)
                                            {{$crawlerCategory_total_updated[$country]}} / {{$crawlerCategory_total[$country]}}
                                        @endif
                                        <a href="http://{{$country}}.cc-shop.com.cn/run/crawlerCategoryJob"><i class="btn btn-sm btn-primary fa fa-refresh"></i></a>
                                    </td>
                                    <td>
                                        @if($crawlerTask_total[$country]>0)
                                            {{$crawlerTask_total_updated[$country]}} / {{$crawlerTask_total[$country]}}
                                        @endif
                                        <a href="http://{{$country}}.cc-shop.com.cn/run/crawlerTaskJob"><i class="btn btn-sm btn-primary fa fa-refresh"></i></a>
                                    </td>
                                    <td>
                                        @if($crawlerItem_total[$country]>0)
                                            {{$crawlerItem_total_updated[$country]}}/ {{$crawlerItem_total[$country]}} ({{ number_format( ($crawlerItem_total_updated[$country]/$crawlerItem_total[$country])*100 , 2,".",',')}}%)
                                        @endif
                                        <a href="http://{{$country}}.cc-shop.com.cn/run/crawlerItemJob"><i class="btn btn-sm btn-primary fa fa-refresh"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                       
                    </tbody>
                </table>
            </div>
            <div class="pull-left">
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-fill">
                    全1
                </button>
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-fill-2">
                    全2
                </button>
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-lg">
                    大
                </button>
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-md">
                    中
                </button>
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-left">
                    左
                </button>
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-right">
                    右
                </button>
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-center">
                    央
                </button>
            </div>
        </div>

        

        <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
                <li class="search-bar">
                    <div class="lookup lookup-circle lookup-right">
                        <input type="text" name="search">
                    </div>
                </li>

                {{--消息通知--}}
                @include(config('theme.admin.header-notifications'))

                {{--使用者資料--}}
                @include(config('theme.admin.header-admin-profiles'))
            </ul>
        </div>
    </nav>
</header>

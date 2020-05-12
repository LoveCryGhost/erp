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
                $crawlerCategory =  new App\Models\CrawlerCategory();
                $crawlerTask =  new App\Models\CrawlerTask();
                $crawlerItem =  new App\Models\CrawlerItem();
                
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
                        <tr>
                            <td>TW</td>
                            <td>{{$crawlerCategory->where('local','tw')->count()}}</td>
                            <td>{{$crawlerTask->where('local','tw')->count()}}</td>
                            <td>{{$crawlerItem->where('local','tw')->count()}}</td>
                        </tr>
                        <tr>
                            <td>ID</td>
                            <td>{{$crawlerCategory->where('local','id')->count()}}</td>
                            <td>{{$crawlerTask->where('local','id')->count()}}</td>
                            <td>{{$crawlerItem->where('local','id')->count()}}</td>
                        </tr>
                        <tr>
                            <td>TH</td>
                            <td>{{$crawlerCategory->where('local','th')->count()}}</td>
                            <td>{{$crawlerTask->where('local','th')->count()}}</td>
                            <td>{{$crawlerItem->where('local','th')->count()}}</td>
                        </tr>
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

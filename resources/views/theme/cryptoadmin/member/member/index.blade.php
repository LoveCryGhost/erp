@extends(config('theme.member.member-app'))

@section('title','代理商後台')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                {{__('default.info.dashboard')}}
            </h3>
        </div>


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    
                        <div class="box-header with-border">
                            <h4 class="box-title"></h4>
                        </div>
                        <div class="box-body">
                            <div class="infinite-scroll">
                                <div class="row">
                                    @foreach($crawlerTasks as $crawlerTask)
                                        <div class="col-md-6 col-lg-2">
                                            <div class="box pull-up bg-hexagons-dark">
                                                <div class="box-bodym text-center">
                                                    <div>{{($crawlerTasks->currentPage()-1)*($crawlerTasks->perPage()) + $loop->iteration}}</div><br>
                                                    <a href="#">
                                                        <img src="https://cf.{{$shopeeUrl[$crawlerTask->crawlerCategory2->local]}}/file/{{url($crawlerTask->crawlerCategory2->image)}}_tn"
                                                             style="width:80px;"/>
                                                    </a>
                                            
                                                    <h5 class="mt-3 mb-1"><a class="hover-primary" href="#">{{$crawlerTask->crawlerCategory2->display_name}}</a></h5>
                                        
                                                </div>
                                        
                                                <div class="flexbox flex-justified bt-1 border-light bg-lightest text-center py-10">
                                                    <a class="text-muted" href="#">
                                                        <i class="fa fa-shopping-bag font-size-30"></i><br>
                                                        {{$crawlerTask->crawlerItems->count()}}
                                                    </a>
                                                    <a class="text-muted" href="#">
                                                        <i class="ion-ios-people-outline font-size-30"></i><br>
                                                        1457 Followers
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{--点击加载下一页的按钮--}}
                                    <div class="text-center">
                                        {{--判断到最后一页就终止, 否则 jscroll 又会从第一页开始一直循环加载--}}
                                        @if( $crawlerTasks->currentPage() == $crawlerTasks->lastPage())
                                            <span class="text-center text-muted">{{__('default.index.lazzyload_no_more_records')}}</span>
                                        @else
                                            {{-- 这里调用 paginator 对象的 nextPageUrl() 方法, 以获得下一页的路由 --}}
                                            <a class="jscroll-next btn btn-outline-secondary btn-block rounded-pill" href="{{ $crawlerTasks->appends($filters)->nextPageUrl() }}">
                                                {{__('default.index.lazzyload_more_records')}}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                            </div>
                        </div>
                </div>
            </div>
        </section>
    </div>
@stop

@section('js')
    @parent
    <script src="{{asset('js/jscroll.min.js')}}"></script>
    <script type="text/javascript">
        $(function() {
            $('.infinite-scroll').jscroll({
                // 当滚动到底部时,自动加载下一页
                autoTrigger: true,
                // 限制自动加载, 仅限前两页, 后面就要用户点击才加载
                autoTriggerUntil: 10,
                // 设置加载下一页缓冲时的图片
                loadingHtml: '<div class="text-center"><img class="center-block" src="{{asset('images/default/icons/loading.gif')}}" alt="Loading..." /><div>',
                padding: 0,
                nextSelector: 'a.jscroll-next:last',
                contentSelector: '.infinite-scroll',
                callback:function() {
                    float_image(className="item-image", x=90, y=-10)
                }
            });
        });
    </script>
@endsection


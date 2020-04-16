@extends(config('theme.staff.staff-app'))

@section('title','MH - 訂單列表')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                Blank pagexx
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Sample Page</li>
                <li class="breadcrumb-item active">Blank page</li>
            </ol>
        </div>


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Title</h4>
                        </div>
                        <div class="box-body">
                            {{--CrawlerItem 爬蟲項目--}}
                            <div class="infinite-scroll">
                                @foreach($shoes_orders as $shoes_order)
                                    <div class="media-heading item-div pull-up">
                                        <div class="row">
                                            <div class="col">
                                                {{$shoes_order->mh_order_code}}
                                            </div>
                                        </div>

                                    </div>
                                @endforeach

                                {{--点击加载下一页的按钮--}}
                                <div class="text-center">
                                    {{--判断到最后一页就终止, 否则 jscroll 又会从第一页开始一直循环加载--}}
                                    @if( $shoes_orders->currentPage() == $shoes_orders->lastPage())
                                        <span class="text-center text-muted">没有更多了</span>
                                    @else
                                        {{-- 这里调用 paginator 对象的 nextPageUrl() 方法, 以获得下一页的路由 --}}
                                        <a class="jscroll-next btn btn-outline-secondary btn-block rounded-pill" href="{{ $shoes_orders->appends($filters)->nextPageUrl() }}">
                                            加载更多....
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->

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
                autoTriggerUntil: 3,
                // 设置加载下一页缓冲时的图片
                loadingHtml: '<div class="text-center"><img class="center-block" src="{{asset('images/default/icons/loading.gif')}}" alt="Loading..." /><div>',
                padding: 0,
                nextSelector: 'a.jscroll-next:last',
                contentSelector: 'div.infinite-scroll',
                callback:function() {
                    float_image(className="item-image", x=90, y=-10)
                }
            });
        });
    </script>
@endsection

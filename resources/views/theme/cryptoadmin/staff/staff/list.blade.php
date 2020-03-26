@extends(config('theme.staff.staff-app'))

@section('title','員工列表')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                員工列表
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
                        <div class="col-xl-12 col-lg-12 text-right mb-5">
                            <a class="btn btn-warning" href="{{route('staff.staff.create')}}" ><i class="fa fa-plus"></i></a>
                        </div>
                    {{--瀑布方式加載--}}
                        <div class="infinite-scroll">
                            @foreach($staffs as $staff)
                                <div class="media-heading item-div pull-up">
                                    <div class="row">
                                        <div class="col-md-1">
                                            [{{($staffs->currentPage()-1)*($staffs->perPage()) + $loop->iteration}}]<br>
                                            <div class="pull-right">ssss{{$staff->staff_code}}</div>
                                        </div>
                                        <div class="col-md-1">
                                            <img src="{{$staff->avatar==null? asset('images/default/avatars/avatar.jpg'): asset($staff->avatar)}}" class="staff-list-img"><br>
                                        </div>
                                        <div class="col-md-3">
                                            {{$staff->name}}<br>
                                            @if($staff->staffDepartments->last()->parent==null)
                                                {{$staff->staffDepartments->last()->name}} -
                                            @else
                                                {{$staff->staffDepartments->last()->parent->name}} - {{$staff->staffDepartments->last()->name}}
                                            @endif

                                        </div>
                                        <div class="col-md-3">
                                            {{$staff->phone1}} / {{$staff->address_fix}}<br>
                                            {{$staff->phone2}} / {{$staff->address_current}}
                                        </div>
                                        <div class="col-md-2">
                                            日職時間: {{date('Y/m/d', strtotime($staff->join_at))}} ({{$staff->join_at==null? "": $staff->join_at->diffForHumans()}})
                                        </div>
                                        <div class="col">
                                            <a class="btn btn-success btn-sm" href="{{route('staff.staff.edit', ['staff' => $staff->id])}}">
                                                <i class="fa fa-pencil"> Edit</i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{--点击加载下一页的按钮--}}
                            <div class="text-center">
                                {{--判断到最后一页就终止, 否则 jscroll 又会从第一页开始一直循环加载--}}
                                @if( $staffs->currentPage() == $staffs->lastPage())
                                    <span class="text-center text-muted">没有更多了</span>
                                @else
                                    {{-- 这里调用 paginator 对象的 nextPageUrl() 方法, 以获得下一页的路由 --}}
                                    <a class="jscroll-next btn btn-outline-secondary btn-block rounded-pill" href="{{ $staffs->appends($filters)->nextPageUrl() }}">
                                        加载更多....
                                    </a>
                                @endif
                            </div>
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
                autoTriggerUntil: 10-1,
                // 设置加载下一页缓冲时的图片
                loadingHtml: '<div class="text-center"><img class="center-block" src="{{asset('images/default/icons/loading.gif')}}" alt="Loading..." /><div>',
                padding: 0,
                nextSelector: 'a.jscroll-next:last',
                contentSelector: 'div.infinite-scroll',
            });
        });
    </script>
@endsection

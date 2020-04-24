@extends(config('theme.staff.staff-app'))

@section('title','員工列表')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                會員列表
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="#">staffs</a></li>
                <li class="breadcrumb-item active">staffs List</li>
            </ol>
        </div>
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="infinite-scroll">
                                <table class="itable">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>頭像</th>
                                        <th>部門</th>
                                        <th>姓名</th>
                                        <th>性別</th>
                                        <th>工號</th>
                                        <th>電話</th>
                                        <th>入職時間</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($staffs as $staff)
                                        <tr>
                                            <td class="text-center">
                                                {{($staffs->currentPage()-1)*($staffs->perPage()) + $loop->iteration}}
                                            </td>
                                            <td>
                                                <a class="avatar avatar-lg status-success" href="#">
                                                    <img src="{{$staff->avatar}}">
                                                </a>
                                            </td>
                                            <td>{{$staff->name}}</td>
                                            <td>{{$staff->email}}</td>
                                            <td>{{$staff->sex}}</td>
                                            <td>{{$staff->staff_code}}</td>
                                            
                                            <td>
                                                {{$staff->tel1}}<br>
                                                {{$staff->phone1}}
                                            </td>
                                            <td>{{$staff->join_at}}</td>
                                            <td>
                                                <a class="btn btn-warning" href="{{route('admin.adminStaff.edit', ['adminStaff'=> $staff->id])}}"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
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
                autoTriggerUntil: 2,
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



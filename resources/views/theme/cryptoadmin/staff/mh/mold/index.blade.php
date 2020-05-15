@extends(config('theme.staff.staff-app'))

@section('title','模具列表')

@section('content')
    <div class="container-full">
      
        
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
                                        <th>部門</th>
                                        <th>型體</th>
                                        <th>保管廠商</th>
                                        <th>size</th>
                                        <th>數量</th>
                                        <th>序號</th>
                                        <th>雙數</th>
                                        <th>操作時間</th>
                                        <th>回轉數</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shoesMolds as $shoesMold)
                                        <tr>
                                            <td class="text-center">
                                                {{($shoesMolds->currentPage()-1)*($shoesMolds->perPage()) + $loop->iteration}}
                                            </td>
                                            <td>{{$shoesMold->department->name}}</td>
                                            <td>{{$shoesMold->mold_type}}</td>
                                            <td>{{$shoesMold->keep_vendor}}</td>
                                            <td>{{$shoesMold->size}}</td>
                                            <td>{{$shoesMold->qty}}</td>
                                            <td>{{$shoesMold->series}}</td>
                                            <td>{{$shoesMold->pairs}}</td>
                                            <td>{{$shoesMold->operation_time}}</td>
                                            <td>{{$shoesMold->cycle_time}}</td>
                                            <td>
                                                <a class="btn btn-warning" href="{{route('staff.mhMold.edit', ['mhMold'=> $shoesMold->mold_id])}}"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger" href="javascript:void(0);" onclick="$(this).find('form').submit();" >
                                                    <i class="fa fa-trash"></i>
                                                    <form action="{{route('staff.mhMold.destroy', $shoesMold->mold_id)}}" method="post" class="m-b-0">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                    </form>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{--点击加载下一页的按钮--}}
                                <div class="text-center">
                                    {{--判断到最后一页就终止, 否则 jscroll 又会从第一页开始一直循环加载--}}
                                    @if( $shoesMolds->currentPage() == $shoesMolds->lastPage())
                                        <span class="text-center text-muted">没有更多了</span>
                                    @else
                                        {{-- 这里调用 paginator 对象的 nextPageUrl() 方法, 以获得下一页的路由 --}}
                                        <a class="jscroll-next btn btn-outline-secondary btn-block rounded-pill" href="{{ $shoesMolds->appends($filters)->nextPageUrl() }}">
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



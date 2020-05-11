@extends(config('theme.member.member-app'))

@section('title',__('member/crawlerTask.title'))

@section('content-header','')
@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                {{__('member/crawlerTask.index.title')}}
            </h3>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="box">
                {{--搜尋--}}
                <div class="box-header">
                    <div class="row">
                        <div class="col">
                            <form class="form-control m-b-0 bg-color-lightblue">
                                <div class="row">
                                    <label class="col-sm-1 col-form-label">{{__('member/crawlerTask.index.search.barcode')}}</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="id_code" placeholder="{{__('member/crawlerTask.index.search.barcode')}}" value="{{request()->id_code}}">
                                    </div>
                                    <label class="col-sm-1 col-form-label">{{__('member/crawlerTask.index.search.taskName')}}</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="ct_name" placeholder="{{__('member/crawlerTask.index.search.taskName')}}" value="{{request()->ct_name}}">
                                    </div>
                                    <label class="col-sm-1 col-form-label">{{__('member/crawlerTask.index.search.domain_name')}}</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="domain_name" placeholder="{{__('member/crawlerTask.index.search.domain_name')}}" value="{{request()->domain_name}}">
                                    </div>
                                    <label class="col-sm-1 col-form-label">{{__('member/crawlerTask.index.search.description')}}</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="description" placeholder="{{__('member/crawlerTask.index.search.description')}}" value="{{request()->description}}">
                                    </div>
                                </div>
                                
                    
                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{route('member.crawlerTask.index')}}" class="form-control btn btn-sm btn-primary">{{__('member/crawlerTask.index.search.reset')}}</a>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="form-control btn btn-sm btn-primary" name="submit['submit_get']" value="submit_get">{{__('member/crawlerTask.index.search.submit')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    
                <div class="box-body">
                    <div class="col-xl-12 col-lg-12 text-right">
                        
                        @include(config('theme.member.btn.index.crud'))
                        @if(auth('admin')->check() && auth('admin')->user()->hasAnyRole('admin'))
                            {{--TW--}}
                            <a class="btn btn-sm btn-success" href="http://tw.cc-shop.com.cn/run/crawlerCategoryJob">tw-Category</a>
                            <a class="btn btn-sm btn-primary" href="http://tw.cc-shop.com.cn/run/crawlerTaskJob">tw-Task</a>
                            <a class="btn btn-sm btn-success" href="http://tw.cc-shop.com.cn/run/crawlerItemJob">tw-Item</a>
                            <a class="btn btn-sm btn-success" href="http://tw.cc-shop.com.cn/run/crawlerShopJob">tw-Shop</a>
    
                            {{--Id--}}
                            <a class="btn btn-sm btn-primary" href="http://id.cc-shop.com.cn/run/crawlerCategoryJob">id-Category</a>
                            <a class="btn btn-sm btn-primary" href="http://id.cc-shop.com.cn/run/crawlerTaskJob">id-Task</a>
                            <a class="btn btn-sm btn-primary" href="http://id.cc-shop.com.cn/run/crawlerItemJob">id-Item</a>
                            <a class="btn btn-sm btn-primary" href="http://id.cc-shop.com.cn/run/crawlerShopJob">id-Shop</a>
        
                            {{--Th--}}
                            
                            <a class="btn btn-sm btn-danger" href="http://th.cc-shop.com.cn/run/crawlerCategoryJob">th-Category</a>
                            <a class="btn btn-sm btn-primary" href="http://th.cc-shop.com.cn/run/crawlerTaskJob">th-Task</a>
                            <a class="btn btn-sm btn-danger" href="http://th.cc-shop.com.cn/run/crawlerItemJob">th-Item</a>
                            <a class="btn btn-sm btn-danger" href="http://th.cc-shop.com.cn/run/crawlerShopJob">th-Shop</a>
                        
                            <form action="{{route('member.crawlerTask.refresh')}}" method="post" class="m-b-0"
                                  style="display: inline-block;"
                                  onsubmit="return confirm('{{__('member/crawlerTask.index.search.reload_task')}}');">
                                @csrf
                                @method('post')
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <div class="infinite-scroll">
                            <table class="itable">
                                <thead>
                                    <tr>
                                        <th>{{__('member/crawlerTask.index.table.no')}}</th>
                                        <th>{{__('member/crawlerTask.index.table.barcode')}}</th>
                                        <th>{{__('member/crawlerTask.index.table.taskName')}}</th>
                                        <th>{{__('member/crawlerTask.index.table.domain_name')}}</th>
                                        <th>{{__('member/crawlerTask.index.table.description')}}</th>
                                        <th>{{__('member/crawlerTask.index.table.is_active')}}</th>
                                        <th>{{__('member/crawlerTask.index.table.information')}}</th>
                                        <th>{{__('member/crawlerTask.index.table.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($crawlerTasks as $crawlerTask)
                                    <tr>
                                        <td class="w-20 text-center">{{($crawlerTasks->currentPage()-1)*($crawlerTasks->perPage()) + $loop->iteration}}</td>
                                        <td>{{$crawlerTask->id_code}}</td>
                                        <td class="w-200">
                                            <p class="mb-0">
                                                <a href="#"><strong>{{$crawlerTask->ct_name}}</strong></a><br>
                                            </p>
                                        </td>
                                        <td class="text-left">
                                            {{__('member/crawlerTask.index.table.pages')}}：{{$crawlerTask->pages}}<br>
                                            {{__('member/crawlerTask.index.table.domain')}}：{{$crawlerTask->domain_name}}<br>
                                            {{__('member/crawlerTask.index.table.sortBy')}}：{{$crawlerTask->sort_by}}
                    
                                        </td>
                                        <td>
                                            @if(strlen(str_replace(" ","",$crawlerTask->description))>0)
                                                <i class="btn btn-secondary fa fa-pencil"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" class="permission_check" name="is_active" id="is_active_{{$crawlerTask->ct_id}}"
                                                   {{$crawlerTask->is_active===1? "checked": ""}} disabled>
                                            <label for="is_active_{{$crawlerTask->ct_id}}" class="text-dark p-0 m-0"></label>
                                        </td>
                                        <td>
                                            <p class="mb-0 text-left">
                                                <small>{{__('member/crawlerTask.index.table.created_by')}} : {{$crawlerTask->member->name}}</small><br>
                                                <small>{{__('member/crawlerTask.index.table.updated_at')}}  : {{$crawlerTask->updated_at==null? "": $crawlerTask->updated_at->diffForHumans()}}</small>
                                            </p>
                                        </td>
                                        <td>
                                            <a class="btn btn-warning btn-sm"
                                                    href="{{route('member.crawlerTask.edit',[ $crawlerTask->ct_id])}}">
                                                <i class="fa fa-edit mr-5"></i>{{__('member/crawlerTask.index.table.edit')}}</a>
    
                                            <form action="{{route('member.crawlerTask.destroy', [ $crawlerTask->ct_id])}}" method="post"
                                                  style="display: inline-block;"
                                                  onsubmit="return confirm('{{__('member/crawlerTask.index.table.delete_confirm')}}');">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-secondary btn-sm">
                                                    <i class="fa fa-trash mr-5"></i>{{__('member/crawlerTask.index.table.delete')}}
                                                </button>
                                            </form>
                                            <a class="btn btn-primary btn-sm" target="_blank"
                                               href="{{route('member.crawlerItem.index',['crawlerTask' => $crawlerTask->ct_id, 'is_active' =>  $crawlerTask->is_active])}}">
                                                <i class="fa fa-external-link"></i> {{__('member/crawlerTask.index.table.show_items')}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
        
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


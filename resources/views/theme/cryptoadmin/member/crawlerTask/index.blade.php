@extends(config('theme.member.member-app'))

@section('title','Shopee任務 - 列表')

@section('content-header','')
@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                Shopee任務 - 列表
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="#">Members</a></li>
                <li class="breadcrumb-item active">Members List</li>
            </ol>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="col-xl-12 col-lg-12 text-right mb-5">
                                @include(config('theme.member.btn.index.crud'))
                                <form action="{{route('member.crawler.refresh')}}" method="post"
                                      style="display: inline-block;"
                                      onsubmit="return confirm('您确定要重新爬蟲吗？');">
                                    @csrf
                                    @method('post')
                                    <button type="submit" class="btn btn-secondary">
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr class="">
                                        <th>排序</th>
                                        <th>Barcode</th>
                                        <th>任務名稱</th>
                                        <th>區域</th>
                                        <th>描述</th>
                                        <th>啟用</th>
                                        <th>訊息</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($crawlerTasks as $crawlerTask)
                                        <tr>
                                            <td class="w-20 text-center">{{$loop->iteration}}</td>
                                            <td>{{$crawlerTask->id_code}}</td>
                                            <td class="w-200">
                                                <p class="mb-0">
                                                    <a href="#"><strong>{{$crawlerTask->ct_name}}</strong></a><br>
                                                </p>
                                            </td>
                                            <td>頁數：{{$crawlerTask->pages}}<br>
                                                網域：{{$crawlerTask->domain_name}}<br>
                                                搜尋方式：{{$crawlerTask->sort_by}}

                                            </td>
                                            <td>
                                                @if(strlen(str_replace(" ","",$crawlerTask->description))>0)
                                                    <i class="btn btn-secondary fa fa-pencil"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="checkbox" class="bt-switch" name="is_active"  value="1" {{$crawlerTask->is_active===1? "checked": ""}}
                                                data-label-width="100%"
                                                       data-label-text="啟用"
                                                       data-on-text="On"    data-on-color="primary"
                                                       data-off-text="Off"  data-off-color="danger"/>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <small>修改人 : {{$crawlerTask->member->name}}</small><br>
                                                    <small>最後更新 : {{$crawlerTask->updated_at==null? "": $crawlerTask->updated_at->diffForHumans()}}</small>
                                                </p>
                                            </td>
                                            <td>
                                                @include(config('theme.member.btn.index.table_tr'),['id' => $crawlerTask->ct_id])
                                                <a class="btn btn-primary btn-sm" target="_blank"
                                                   href="{{route('member.crawleritem.index',['crawlerTask' => $crawlerTask->ct_id, 'is_active' =>  $crawlerTask->is_active])}}">
                                                    <i class="fa fa-external-link"></i> 商品</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class=""> {{$crawlerTasks->links("pagination::bootstrap-4")}}</div>
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
    <script type="text/javascript">
        $(function(){
            active_switch(switch_class='bt-switch', options=[]);
        })
    </script>
@endsection




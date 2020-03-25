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
                        {{--CrawlerTask 爬蟲任務--}}
                        <div class="">
                            <form action="{{route('member.crawleritem.save_cralwertask_info', ['crawlerTask'=>request()->crawlerTask, 'is_active'=> request()->is_active])}}" method="post">
                                @csrf
                                <table class="table table-primary table-bordered table-striped">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>任務信息</td>
                                        <td>
                                            任務名稱：{{$crawlerTask->ct_name}}<br>
                                            網域:{{$crawlerTask->domain_name}}<br>
                                            搜尋頁數:{{$crawlerTask->pages}}<br>
                                        </td>
                                        <td>
                                            網址:<a href="{{$crawlerTask->url}}" target="_blank">顯示Shopee頁面</a><br>
                                            創建者:{{$crawlerTask->member->name}}
                                        </td>
                                        <td>
                                            類別:{{$crawlerTask->cat}}<br>
                                            搜索方式:{{$crawlerTask->sort_by}}<br>
                                            國家:{{$crawlerTask->local}}
                                        </td>
                                        <td>
                                            <input type="checkbox" class="crawlertask" id="crawlertask-bt-switch" value="1" {{request()->is_active==1? "checked" : ""}}
                                            data-label-width="100%"
                                                   data-label-text="啟用" data-size="mini"
                                                   data-on-text="On"    data-on-color="primary"
                                                   data-off-text="Off"  data-off-color="danger"
                                                   data-crawlertask-id="{{$crawlerTask->ct_id}}"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <textarea class="form-control" type="text" name="description" placeholder="描述" >{{$crawlerTask->description}}</textarea>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-secondary">儲存訊息</button>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </form>
                        </div>

                        {{--CrawlerItem 爬蟲項目--}}
                        <div class="infinite-scroll">
                            @foreach($crawlerItems as $crawlerItem)
                                <div class="media-heading item-div pull-up">
                                    <div class="row">
                                        <div class="col-md-1">
                                            [{{($crawlerItems->currentPage()-1)*($crawlerItems->perPage()) + $loop->iteration}}]<br>
                                            <div class="font-size-40 text-right">{{$crawlerItem->pivot->sort_order+1}}</div>
                                        </div>
                                        <div class="col-md-1">
                                            @if(request()->is_active==0)
                                                <div class="checkbox">
                                                    <input type="checkbox" class="item-is-active" id="item-is-active-{{$crawlerItem->ci_id}}" onchange="toggle_crawler_item({{$crawlerItem->ci_id}});" data-ctrlitem-id="{{$crawlerItem->ci_id}}">
                                                    <label for="item-is-active-{{$crawlerItem->ci_id}}" class="text-dark">顯示</label>
                                                </div>
                                            @else
                                                <div class="checkbox">
                                                    <input type="checkbox" class="item-is-active" id="item-is-active-{{$crawlerItem->ci_id}}" onchange="toggle_crawler_item({{$crawlerItem->ci_id}});" data-ctrlitem-id="{{$crawlerItem->ci_id}}">
                                                    <label for="item-is-active-{{$crawlerItem->ci_id}}" class="text-dark">隱藏</label>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-1">
                                            @if($crawlerItem->images==null)
                                                <img src="{{asset('images/default/avatars/avatar.jpg')}}" class="item-image"><br>
                                            @else
                                                <img src="https://cf.{{$crawlerTask->domain_name}}/file/{{$crawlerItem->images}}_tn" class="item-image"><br>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <a>{{ $crawlerItem->name }}</a><br>
                                            <a class="btn btn-sm btn-info" target="_blank"
                                               href="https://{{$crawlerTask->domain_name}}/{{$crawlerItem->name==null? "waiting-upload-data":$crawlerItem->name}}-i.{{$crawlerItem->shopid}}.{{$crawlerItem->itemid}}" ><i class="fa fa-external-link"></i></a>
                                            <a class="btn btn-sm btn-info" target="_blank"
                                               href="https://{{$crawlerTask->domain_name}}/shop/{{$crawlerItem->shopid}}" ><i class="fa fa-shopping-bag"></i></a>
                                        </div>
                                        <div class="col-md-1">
                                            {{number_format($crawlerItem->crawlerItemSKUs->min('price')/10, 0,".",",")}}
                                        </div>
                                        <div class="col-md-1">
                                            {{number_format($crawlerItem->crawlerItemSKUs->max('price')/10, 0,".",",")}}
                                        </div>
                                        <div class="col-md-3">
                                            <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-left"
                                               onclick="show_crawler_item_skus(this, php_inject={{json_encode(['models' => ['crawlerItem' => $crawlerItem]])}})">SKU-明細</a><br>
                                            月銷量 : {{number_format($crawlerItem->sold,0,".",",")}}<br>
                                            歷史銷量 : {{number_format($crawlerItem->historical_sold,0,".",",")}}<br>
                                            最後更新時間 : {{$crawlerItem->updated_at!=null? $crawlerItem->updated_at->diffForHumans() : ""}}<br>
                                            <div class="text-right">{{now()}} - {{$crawlerItem->updated_at}}</div>
                                        </div>

                                    </div>

                                </div>
                            @endforeach

                            {{--点击加载下一页的按钮--}}
                            <div class="text-center">
                                {{--判断到最后一页就终止, 否则 jscroll 又会从第一页开始一直循环加载--}}
                                @if( $crawlerItems->currentPage() == $crawlerItems->lastPage())
                                    <span class="text-center text-muted">没有更多了</span>
                                @else
                                    {{-- 这里调用 paginator 对象的 nextPageUrl() 方法, 以获得下一页的路由 --}}
                                    <a class="jscroll-next btn btn-outline-secondary btn-block rounded-pill" href="{{ $crawlerItems->appends($filters)->nextPageUrl() }}">
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
</div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/jscroll.min.js')}}"></script>
<script type="text/javascript">
$(function() {
    $('.infinite-scroll').jscroll({
        // 当滚动到底部时,自动加载下一页
        autoTrigger: true,
        // 限制自动加载, 仅限前两页, 后面就要用户点击才加载
        autoTriggerUntil: 0,
        // 设置加载下一页缓冲时的图片
        loadingHtml: '<div class="text-center"><img class="center-block" src="{{asset('images/default/icons/loading.gif')}}" alt="Loading..." /><div>',
        padding: 0,
        nextSelector: 'a.jscroll-next:last',
        contentSelector: 'div.infinite-scroll',
        callback:function() {
            float_image(className="item-image", x=90, y=-10)
        }
    });

    $(".crawlertask").bootstrapSwitch({
        'size': 'mini',
        'onSwitchChange': function(event, state){
            toggle_crawler_items_reload($(this), state);
        },
    }).bootstrapSwitch('toggleState',true);
    float_image(className="item-image", x=90, y=0)


});

function show_crawler_item_skus(_this, php_inject) {
    $.ajaxSetup(active_ajax_header());
    $.ajax({
        type: 'get',
        url: '{{route('member.crawleritemsku.index')}}?ci_id='+php_inject.models.crawlerItem.ci_id,
        data: '',
        async: true,
        crossDomain: true,
        contentType: false,
        processData: false,
        success: function(data) {
            $('#modal-left .modal-title').html('SKUs - 列表');
            $('#modal-left .modal-body').html(data.view)
        },
        error: function(data) {
        }
    });
}

function toggle_crawler_items_reload(_this, _TF) {
    if(_TF===true){
        window.location.replace("{{route('member.crawleritem.index')}}?crawlerTask=" + _this.data('crawlertask-id') + "&is_active=1");
    }else{
        window.location.replace("{{route('member.crawleritem.index')}}?crawlerTask=" + _this.data('crawlertask-id') + "&is_active=0");
    }
}


function toggle_crawler_item(ci_id) {
    $.ajaxSetup(active_ajax_header());
    $.ajax({
        type: 'post',
        url: '{{route('member.crawleritem.toggle')}}?ci_id='+ci_id,
        data: '',
        async: true,
        crossDomain: true,
        contentType: false,
        processData: false,
        success: function(data) {

        },
        error: function(data) {
        }
    });
}


</script>
@endsection

@extends(config('theme.member.member-app'))

@section('title',__('member/crawlerItem.title'))

@section('content-header','')

@section('content')
<div class="container-full">
    <div class="content-header">
        <h3>
            {{__('member/crawlerItem.index.title')}}
        </h3>
{{--        <ol class="breadcrumb">--}}
{{--            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>--}}
{{--            <li class="breadcrumb-item"><a href="#">Members</a></li>--}}
{{--            <li class="breadcrumb-item active">Members List</li>--}}
{{--        </ol>--}}
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col">
                                <form class="form-control bg-color-lightblue" action="{{route('member.crawlerItem.saveCralwerTaskInfo', ['crawlerTask'=>request()->crawlerTask, 'is_active'=> request()->is_active])}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{__('member/crawlerItem.index.search.taskName')}}：{{$crawlerTask->ct_name}}<br>
                                            {{__('member/crawlerItem.index.search.domain_name')}}：{{$crawlerTask->domain_name}}<br>
                                            {{__('member/crawlerItem.index.search.pages')}}：{{$crawlerTask->pages}}<br>
                                        </div>
                                        <div class="col-md-3">
                                            {{__('member/crawlerItem.index.search.url')}}：<a href="{{$crawlerTask->url}}" class="btn btn-sm btn-primary" target="_blank">{{__('member/crawlerItem.index.search.show_task_in_shopee')}}</a><br>
                                            {{__('member/crawlerItem.index.search.created_by')}}：{{$crawlerTask->member->name}}
                                        </div>
                                        <div class="col-md-3">
                                            {{__('member/crawlerItem.index.search.category')}}：{{$crawlerTask->cat}}<br>
                                            {{__('member/crawlerItem.index.search.sortBy')}}：{{$crawlerTask->sort_by}}<br>
                                            {{__('member/crawlerItem.index.search.coutnry')}}：{{$crawlerTask->local}}
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" class="crawlertask" id="crawlertask-bt-switch" value="1" {{request()->is_active==1? "checked" : ""}}
                                            data-label-width="100%"
                                                   data-label-text="{{__('member/crawlerItem.index.search.active')}}" data-size="mini"
                                                   data-on-text="On"    data-on-color="primary"
                                                   data-off-text="Off"  data-off-color="danger"
                                                   data-crawlertask-id="{{$crawlerTask->ct_id}}"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 m-b-5">
                                            <textarea class="form-control" type="text" name="description" placeholder="{{__('member/crawlerItem.index.search.description')}}" >{{$crawlerTask->description}}</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary form-control">{{__('member/crawlerItem.index.search.save')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        {{--CrawlerItem 爬蟲項目--}}
                        <div class="infinite-scroll">
                            @foreach($crawlerItems as $crawlerItem)
                                <div class="media-heading item-div pull-up">
                                    <div class="row">
                                        <div class="col-md-1">
                                            [{{($crawlerItems->currentPage()-1)*($crawlerItems->perPage()) + $loop->iteration}}]<br>
                                            <div class="font-size-40 text-right">{{$crawlerItem->pivot->sort_order}}</div>
                                        </div>
                                        <div class="col-md-1">
                                            @if(request()->is_active==0)
                                                <div class="checkbox">
                                                    <input type="checkbox" class="item-is-active" id="item-is-active-{{$crawlerItem->pivot->ct_i_id}}" onchange="toggle_crawler_item(this, php_inject={{json_encode([ 'ct_id'=> $crawlerTask->ct_id, 'ci_id' =>$crawlerItem->ci_id, 'ct_i_id' => $crawlerItem->pivot->ct_i_id])}});" data-ct_i_id="{{$crawlerItem->pivot->ct_i_id}}">
                                                    <label for="item-is-active-{{$crawlerItem->pivot->ct_i_id}}" class="text-dark">{{__('member/crawlerItem.index.table.show')}}</label>
                                                </div>
                                            @else
                                                <div class="checkbox">
                                                    <input type="checkbox" class="item-is-active" id="item-is-active-{{$crawlerItem->pivot->ct_i_id}}" onchange="toggle_crawler_item(this, php_inject={{json_encode([ 'ct_id'=> $crawlerTask->ct_id, 'ci_id' =>$crawlerItem->ci_id, 'ct_i_id' => $crawlerItem->pivot->ct_i_id])}});" data-ctrlitem-id="{{$crawlerItem->pivot->ct_i_id}}">
                                                    <label for="item-is-active-{{$crawlerItem->pivot->ct_i_id}}" class="text-dark">{{__('member/crawlerItem.index.table.hide')}}</label>
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
                                               href="https://{{$crawlerTask->domain_name}}/{{$crawlerItem->name==null? "waiting-upload-data":$crawlerItem->name}}-i.{{$crawlerItem->shopid}}.{{$crawlerItem->itemid}}" >
                                                <i class="fa fa-external-link"></i> {{$crawlerItem->itemid}}</a>
                                            <a class="btn btn-sm btn-info" target="_blank"
                                               href="https://{{$crawlerTask->domain_name}}/shop/{{$crawlerItem->shopid}}" >
                                                <i class="fa fa-shopping-bag"></i> {{$crawlerItem->crawlerShop? $crawlerItem->crawlerShop->username : ""}}</a>
                                        </div>
                                        <div class="col-md-1">
                                            {{number_format($crawlerItem->crawlerItemSKUs->min('price')/10, 0,".",",")}}
                                        </div>
                                        <div class="col-md-1">
                                            {{number_format($crawlerItem->crawlerItemSKUs->max('price')/10, 0,".",",")}}
                                        </div>
                                        <div class="col-md-3">
                                            <div>
                                                <div><a class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-left"
                                                                           onclick="show_crawler_item_skus(this, php_inject={{json_encode(['models' => ['crawlerItem' => $crawlerItem]])}})"> {{__('member/crawlerItem.index.table.sku_detail')}}</a></div>
                                                <div class="float-right">{{$crawlerItem->updated_at}}</div>
                                            </div>
                                            <div>
                                                {{__('member/crawlerItem.index.table.information.monthly_sale')}} : {{number_format($crawlerItem->sold,0,".",",")}}<br>
                                                {{__('member/crawlerItem.index.table.information.historic_sale')}} : {{number_format($crawlerItem->historical_sold,0,".",",")}}<br>
                                                {{__('member/crawlerItem.index.table.updated_at')}} : {{$crawlerItem->updated_at!=null? $crawlerItem->updated_at->diffForHumans() : ""}}<br>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                
                            @endforeach

                            {{--点击加载下一页的按钮--}}
                            <div class="text-center">
                                {{--判断到最后一页就终止, 否则 jscroll 又会从第一页开始一直循环加载--}}
                                @if( $crawlerItems->currentPage() == $crawlerItems->lastPage())
                                    <span class="text-center text-muted">{{__('default.index.lazzyload_no_more_records')}}</span>
                                @else
                                    {{-- 这里调用 paginator 对象的 nextPageUrl() 方法, 以获得下一页的路由 --}}
                                    <a class="jscroll-next btn btn-outline-secondary btn-block rounded-pill" href="{{ $crawlerItems->appends($filters)->nextPageUrl() }}">
                                        {{__('default.index.lazzyload_more_records')}}
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
            url: '{{route('member.crawlerItem-crawlerItemSku.index')}}?ci_id='+php_inject.models.crawlerItem.ci_id+'&ct_i_id='+php_inject.models.crawlerItem.pivot.ct_i_id,
            data: '',
            async: true,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#modal-left .modal-title').html('{{__('member/crawlerItem.sku_detail.title')}}');
                $('#modal-left .modal-body').html(data.view)
            },
            error: function(data) {
            }
        });
    }

    function toggle_crawler_items_reload(_this, _TF) {
        if(_TF===true){
            window.location.replace("{{route('member.crawlerItem.index')}}?crawlerTask=" + _this.data('crawlertask-id') + "&is_active=1");
        }else{
            window.location.replace("{{route('member.crawlerItem.index')}}?crawlerTask=" + _this.data('crawlertask-id') + "&is_active=0");
        }
    }


    function toggle_crawler_item(_this, php_inject) {
        $.ajaxSetup(active_ajax_header());
        var formData = new FormData();
        formData.append('ct_i_id', php_inject.ct_i_id);
        formData.append('ci_id', php_inject.ci_id);
        formData.append('ct_id', php_inject.ct_id);
    
        $.ajax({
            type: 'post',
            url: '{{route('member.crawlerItem.toggle')}}',
            data: formData,
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

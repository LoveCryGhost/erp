<div class="box box-solid box-inverse box-dark">
    <div class="box-header  p-5">
        <h5 class="box-title m-0">{{__('member/crawlerItem.sku_detail.title')}}</h5>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
            <div class="col-md-12">
                @can('member.reportSKU.crawlerItemAanalysis')
                    {{__('member/crawlerItem.sku_detail.selectProduct')}}：
                    <select name="p_id" onchange="product_select_change(this, php_inject={{json_encode(['models'])}})">
                        <option>Select...</option>
                        @foreach($products as $product)
                            <option value="{{$product->p_id}}" {{Session::get('member_crawlerItem_product_id')==$product->p_id? "selected":""}}>{{$product->p_name}}</option>
                        @endforeach
                    </select>
                @endcan
            </div>
            <div class="col-md-6">
                <table class="table table-hover table-bordered table-primary font-size-10">
                    <thead>
                        <tr class="text-center">
                            <th>{{__('member/crawlerItem.sku_detail.table.no')}}</th>
                            <th>{{__('member/crawlerItem.sku_detail.table.name')}}</th>
                            <th>{{__('member/crawlerItem.sku_detail.table.price')}}</th>
                            <th>{{__('member/crawlerItem.sku_detail.table.stock')}}</th>
                            <th>{{__('member/crawlerItem.sku_detail.table.weekly_sale')}}</th>
                            <th>{{__('member/crawlerItem.sku_detail.table.monthly_sale')}}</th>
                            <th>{{__('member/crawlerItem.sku_detail.table.historic_sale')}}</th>
                            <th>{{__('member/crawlerItem.sku_detail.table.historic_sale_percentage')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $daySales7 = 0;
                            $daySales7_total = 0;
                            $daySales30 = 0;
                            $daySales30_total = 0;
                        @endphp
                        @foreach($crawlerItem->crawlerItemSKUs as $crawlerItemSKU)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                @can('member.reportSKU.crawlerItemAanalysis')
                                    @php
                                        $qty = $crawlerItemSKU->sku_count();
                                    @endphp
                                    <a class="pointer"
                                       data-toggle="modal" data-target="#modal-right"
                                       onclick="crawler_item_sku_click(this, php_inject={{json_encode([
                                                'ct_i_id' => isset($data['ct_i_id'])? $data['ct_i_id']:0,
                                                'itemid' => $crawlerItemSKU->itemid,
                                                'shopid' => $crawlerItemSKU->shopid,
                                                'modelid' => $crawlerItemSKU->modelid])}})">
                                        {!! $qty>0? "<span class='btn btn-success btn-circle btn-xs'>".$qty."</span>":"" !!}{{$crawlerItemSKU->name}}
                                    </a>
                                @else
                                    <a>
                                        {{$crawlerItemSKU->name}}
                                    </a>
                                @endif
                            </td>
                            <td class="text-right">{{number_format($crawlerItemSKU->price/10,0,".",",")}}</td>
                            <td class="text-right">{{number_format($crawlerItemSKU->stock, 0, ".", ",")}}</td>
                                @php
                                    $daySales7 = $crawlerItemSKU->nDaysSales(7);
                                    $daySales30 = $crawlerItemSKU->nDaysSales(30);
                                    $daySales7_total+= $daySales7;
                                    $daySales30_total+= $daySales30;
                                @endphp
                            <td class="text-right">{{$daySales7}}</td>
                            <td class="text-right">{{$daySales30}}</td>
                            <td class="text-right">{{number_format($crawlerItemSKU->sold, 0, "", ",")}}</td>
                            
                            {{--解決-分母等於0 問題--}}
                            @if($crawlerItem->crawlerItemSKUs->sum('sold')!=0)
                                <td class="text-right">{{number_format(($crawlerItemSKU->sold/$crawlerItem->crawlerItemSKUs->sum('sold'))*100, 0, ".", ",")}}%</td>
                            @else
                                <td class="text-right">0 %</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-right">{{number_format($crawlerItem->crawlerItemSKUs->sum('stock'), 0, "", ",")}}</th>
                            <th class="text-right">{{$daySales7_total}}</th>
                            <th class="text-right">{{$daySales30_total}}</th>
                            <th class="text-right">{{number_format($crawlerItem->crawlerItemSKUs->sum('sold'), 0, "", ",")}}</th>
                            <th class="text-right">100%</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                        <div class="chart">
                            <div id="crawlerItemSKUs" style="height: 500px;"></div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#modal-left').unbind('hidden.bs.modal').on('hidden.bs.modal', function () {
        $('#modal-left .modal-body').html('');
    });

    var chart = AmCharts.makeChart("crawlerItemSKUs", {
        "type": "serial",
        "theme": "dark",
        "handDrawn": true,
        "handDrawScatter": 3,
        "legend": {
            "useGraphSettings": true,
            "markerSize": 12,
            "valueWidth": 0,
            "verticalGap": 0
        },
        "dataProvider": {!! collect($amCharProvider)!!},
        "valueAxes": [{
            "minorGridAlpha": 0.08,
            "minorGridEnabled": true,
            "position": "top",
            "axisAlpha": 0,
            "minimum": 0
        }],
        "startDuration": 1,
        "graphs": [{
                "balloonText": "<span style='font-size:13px;'>[[category]] 的[[title]] :<b>[[value]]</b></span>",
                "title": "{{__('member/crawlerItem.sku_detail.sale_qty')}}",
                "type": "column",
                "fillAlphas": 0.8,
                "valueField": "sold"
            }],
        "rotate": true,
        "categoryField": "sku_name",
        "categoryAxis": {
            "gridPosition": "start"
        },
        "export": {
            "enabled": false
        }

    });

    function product_select_change(_this, php_inject) {
        $('#modal-right .modal-body').html("");
        $('#modal-right .modal-title').html("");
        $.ajaxSetup(active_ajax_header());
        $.ajax({
            type: 'post',
            url: '{{route('member.crawlerItem-crawlerItemSku.putProductId')}}?product_id='+$(_this).val(),
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

    function crawler_item_sku_click(_this, php_inject ) {
        $('#modal-right .modal-body').html("");
        $('#modal-right .title').html("");
        $.ajaxSetup(active_ajax_header());
        var formData = new FormData();
        formData.append('ct_i_id', php_inject.ct_i_id);
        formData.append('itemid', php_inject.itemid);
        formData.append('shopid', php_inject.shopid);
        formData.append('modelid', php_inject.modelid);
        $.ajax({
            type: 'post',
            url: '{{route('member.crawlerItem-crawlerItemSku.showProductSkus')}}',
            data: formData,
            async: true,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#modal-right .modal-title').html('{{__('member/crawlerItem.sku_detail.product.title')}}');
                $('#modal-right .modal-body').html(data.view);
            },
            error: function(data) {
            }
        });
    }
</script>

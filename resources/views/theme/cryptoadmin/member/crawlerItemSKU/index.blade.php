<div class="box box-solid box-inverse box-dark">
    <div class="box-header  p-5">
        <h5 class="box-title m-0">產品SKU - 供應商列表</h5>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
            <div class="col-md-6">
                <table class="table-hover table-bordered table-primary font-size-10">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>名稱</th>
                            <th>售價</th>
                            <th>庫存</th>
                            <th>週銷量</th>
                            <th>月銷量</th>
                            <th>歷史銷量</th>
                            <th>歷史銷量(%)</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $daySales7 =0;
                            $daySales7_total=0;
                            $daySales30 =0;
                            $daySales30_total=0
                        @endphp
                        @foreach($crawlerItem->crawlerItemSKUs as $crawlerItemSKU)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$crawlerItemSKU->name}}</td>
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
                            <td class="text-right">{{number_format(($crawlerItemSKU->sold/$crawlerItem->crawlerItemSKUs->sum('sold'))*100, 0, ".", ",")}}%</td>

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
    a  = [{
        "year": 2005,
        "income": 23.5,
        "expenses": 18.1
    }, {
        "year": 2006,
        "income": 26.2,
        "expenses": 22.8
    }, {
        "year": 2007,
        "income": 30.1,
        "expenses": 23.9
    }, {
        "year": 2008,
        "income": 29.5,
        "expenses": 25.1
    }, {
        "year": 2009,
        "income": 24.6,
        "expenses": 25
    }];

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
            "axisAlpha": 0
        }],
        "startDuration": 1,
        "graphs": [{
            "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b></span>",
            "title": "銷量",
            "type": "column",
            "fillAlphas": 0.8,

            "valueField": "sold"
        }
        // , {
        //     "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b></span>",
        //     "bullet": "round",
        //     "bulletBorderAlpha": 1,
        //     "bulletColor": "#FFFFFF",
        //     "useLineColorForBulletBorder": true,
        //     "fillAlphas": 0,
        //     "lineThickness": 2,
        //     "lineAlpha": 1,
        //     "bulletSize": 7,
        //     "title": "Expenses",
        //     "valueField": "expenses"
        // }
        ],
        "rotate": true,
        "categoryField": "year",
        "categoryAxis": {
            "gridPosition": "start"
        },
        "export": {
            "enabled": true
        }

    });

</script>

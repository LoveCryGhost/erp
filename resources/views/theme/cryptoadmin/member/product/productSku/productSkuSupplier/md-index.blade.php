<div class="box box-solid box-inverse box-dark">
    <div class="box-header  p-5">
        <h5 class="box-title m-0">產品SKU - 供應商列表</h5>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 text-right">
                <a class="btn btn-warning" data-toggle="modal" data-target="#modal-lg"
                        onclick="event.preventDefault();
                        md_product_sku_supplier_create(this, php_inject={{json_encode(['models' => ['sku' => $sku]])}});">
                <i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <img src="{{$sku->thumbnail? asset($sku->thumbnail) : '/images/default/products/product.jpg'}}" style="width: 100px;">
            </div>
            <div class="col-md-10">
                <table class="table table-bordered">
                    <tbody>
                    <tr class="m-0"><td>Barcode</td><td>{{$sku->id_code}}</td></tr>
                    <tr class="m-0"><td>啟用</td>
                        <td>
                            <input type="checkbox" class="bt-switch" name="is_active" id="is_active" value="1" {{$sku->is_active==1? "checked":""}}
                            data-label-width="100%"
                                   data-label-text="啟用" data-size="min"
                                   data-on-text="On"    data-on-color="primary"
                                   data-off-text="Off"  data-off-color="danger"/>
                        </td>
                    </tr>
                    <tr class="m-0"><td>售價</td><td>{{$sku->price}}</td></tr>
                    <tr class="m-0"><td>SKU名稱</td><td>{{$sku->sku_name}}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-hover" id="tbl-product-sku-supplier">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>排序</th>
                            <th>圖片</th>
                            <th>名稱</th>
                            <th>啟用</th>
                            <th>報價錢</th>
                            <th>連結</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($sku->skuSuppliers)>0)
                            @foreach($sku->skuSuppliers as $skuSupplier)
                               <tr data-ss-id="{{$skuSupplier->pivot->ss_id}}">
                                   <td>
                                        <span class="handle" style="cursor: move;">
                                            <i class="fa fa-ellipsis-v"></i>
                                            <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                   </td>
                                   <td>{{$loop->iteration}}</td>
                                   <td>
                                       <img src="{{$skuSupplier->name_card? asset($skuSupplier->name_card): "/images/default/products/product.jpg"}}" style="width: 70px;">
                                   </td>
                                   <td>
                                       {{$skuSupplier->s_name}}
                                       <input type="text" hidden name="sku_suppliers[s_id]" value="{{$skuSupplier->s_id}}">
                                   </td>
                                   <td>
                                       <input type="checkbox" class="bt-switch"  value="1" {{$skuSupplier->is_active==1? "checked":""}}
                                            data-label-width="100%"
                                            data-label-text="啟用" data-size="min"
                                            data-on-text="On"    data-on-color="primary"
                                            data-off-text="Off"  data-off-color="danger"/>
                                   </td>
                                   <td>{{$skuSupplier->pivot->price}}</td>
                                   <td>
                                       <a class="btn btn-sm btn-primary" href="{{$skuSupplier->pivot->url}}" target="_blank"><i class="fa fa-link"></i></a>
                                   </td>
                                   <td>
                                       <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-lg"
                                          onclick="event.preventDefault(); md_product_sku_supplier_edit(this, php_inject={{json_encode(['models' => [ 'sku' => $sku, 'skuSupplier' => $skuSupplier]])}});">
                                           <i class="fa fa-edit mr-5"></i>編輯
                                       </a>
                                   </td>
                               </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{--{{$product->skus(10)->links()}}--}}
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    $(function(){
        //排序表格
        active_table_sortable(table_id="tbl-product-sku-supplier", eq_order_index=1, options={});
        //Switch
        active_switch(switch_class='bt-switch', options=[]);
    });


    function md_product_sku_supplier_edit(_this,  php_inject) {
        $.ajaxSetup(active_ajax_header());
        $.ajax({
            type: 'get',
            url: '{{route('member.product-sku-supplier.index')}}/'+
                php_inject.models.skuSupplier.s_id+'/edit?sku_id='+php_inject.models.sku.sku_id,
            data: '',
            async: true,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#modal-lg .modal-title').html('SKU供應商 - 編輯');
                $('#modal-lg .modal-body').html(data.view);
            },
            error: function(data) {
            }
        });
    }

    function md_product_sku_supplier_create(_this,  php_inject) {
        $.ajaxSetup(active_ajax_header());
        $.ajax({
            type: 'get',
            url: '{{route('member.product-sku-supplier.index')}}/create?sku_id=' + php_inject.models.sku.sku_id,
            data: '',
            async: true,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#modal-lg .modal-title').html('SKU供應商 - 新增');
                $('#modal-lg .modal-body').html(data.view);
            },
            error: function(data) {
            }
        });
    }
</script>

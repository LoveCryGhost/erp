<div class="box box-solid">
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
            <div class="col-2">
                <img CLASS="img-350 rounded" src="{{$sku->thumbnail? asset($sku->thumbnail) : '/images/default/products/product.jpg'}}" >
            </div>
            <div class="col-10">
                <table class="itable">
                    <tbody>
                        <tr class="m-0">
                            <td>{{__('default.index.table.barcode')}}</td>
                            <td>{{$sku->id_code}}</td>
                        </tr>
                        <tr class="m-0">
                            <td>{{__('default.index.table.is_active')}}</td>
                            <td>
                                <input type="checkbox" class="permission_check" name="is_active" id="is_active"
                                       {{$sku->is_active===1? "checked": ""}} disabled>
                                <label for="is_active" class="p-0 m-0"></label>
                            </td>
                        </tr>
                        <tr class="m-0">
                            <td>{{__('member/product.productSupplier.index.sellPrice')}}</td><td>{{$sku->price}}</td>
                        </tr>
                        <tr class="m-0">
                            <td>{{__('member/product.productSupplier.index.skuName')}}</td><td>{{$sku->sku_name}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="itable table m-b-0">
                                    <thead>
                                    <tr>
                                        @foreach($sku->product->type->attributes as $attribute)
                                            <td>{{$attribute->a_name}}</td>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @foreach($sku->skuAttributes as $attribute)
                                            <td>{{$attribute->a_value}}</td>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                <table class="itable table m-t-10" id="tbl-product-sku-supplier">
                    <thead>
                    <tr>
                        <th>{{__('default.index.table.no')}}.</th>
                        <th>{{__('default.index.table.sort_order')}}</th>
                        <th>{{__('default.index.table.image')}}</th>
                        <th>{{__('default.index.table.name')}}</th>
                        <th>{{__('default.index.table.is_active')}}</th>
                        <th>{!!__('member/product.productSupplier.index.purchasePrice')!!}</th>
                        <th>{{__('default.index.table.url')}}</th>
                        <th>{{__('default.index.table.crud')}}</th>
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
                                    <img class="img-70 rounded" src="{{$skuSupplier->name_card? asset($skuSupplier->name_card): "/images/default/products/product.jpg"}}">
                                </td>
                                <td>
                                    {{$skuSupplier->s_name}}
                                    <input type="text" hidden name="sku_suppliers[s_id]" value="{{$skuSupplier->s_id}}">
                                </td>
                                <td>
                                    <input type="checkbox" class="permission_check" name="is_active" id="is_active_{{$skuSupplier->ss_id}}"
                                       {{$skuSupplier->pivot->is_active==1? "checked": ""}} disabled >
                                    <label for="is_active_{{$skuSupplier->ss_id}}" class="p-0 m-0"></label>
                                </td>
                                <td>{{$skuSupplier->pivot->price}}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{$skuSupplier->pivot->url}}" target="_blank"><i class="fa fa-link"></i></a>
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-lg"
                                       onclick="event.preventDefault(); md_product_sku_supplier_edit(this, php_inject={{json_encode(['models' => [ 'sku' => $sku, 'skuSupplier' => $skuSupplier]])}});">
                                        <i class="fa fa-edit mr-5"></i>{{__('default.index.table.edit')}}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
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

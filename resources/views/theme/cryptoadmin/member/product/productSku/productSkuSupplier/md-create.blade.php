<div class="box box-solid">
    <div class="box-body">
        @include(config('theme.admin.view').'layouts.modal-errors')
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-primary"
                   onclick="event.preventDefault();
                           md_product_sku_supplier_store(this, php_inject={{json_encode(['models'=>['sku' => $sku]])}});">
                    <i class="fa fa-save"></i></a>
            </div>
            <div class="col-2">
                <div class="form-group row">
                    <div class=" img-preview-frame text-center" >
                        <label for="sku_thumbnail">
                            <img id="sku_thumbnail_img" class="rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{$sku->thumbnail? asset($sku->thumbnail):asset('images/default/products/product.jpg')}}" width="200px">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-10">
                @include(config('theme.member.view').'layouts.errors')
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
            <div class="col-md-12">
                <div class="form-group">
                    <h5>{{__('member/product.productSupplier.edit.supplierName')}}</h5>
                    <select class="select2_item form-control" name="sku_supplier" id="sku_supplier" style="z-index: 9999;">
                        <option value="">Select...</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{$supplier->s_id}}" data-md-id="{{$supplier->s_id}}">{{$supplier->id_code}} - {{$supplier->s_name}}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="form-group">
                    <h5>{{__('default.edit.is_active')}}</h5>
                    <div class="controls">
                        <input type="checkbox"  class="permission_check" name="is_active" value="1" id="is_active_sku_supplier_pivot">
                        <label for="is_active_sku_supplier_pivot" class="text-dark p-0 m-0"></label>
                    </div>
                </div>
                
                <div class="form-group">
                    <h5>{{__('member/product.productSupplier.index.purchasePrice')}}</h5>
                    <div class="controls">
                        <input class="form-control" type="text" name="price" id="price" placeholder="price"
                               value="{{old('price')}}">
                    </div>
                </div>
    
                <div class="form-group">
                    <h5>{{__('default.index.table.url')}}</h5>
                    <div class="controls">
                        <input class="form-control" type="text" name="url" id="url" placeholder="url"
                               value="{{old('url')}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(function () {
        //Select2
        active_select2(select2_class="select2_item", options={});
        //排序表格
        active_table_sortable(table_id="tbl-product-sku-supplier", eq_order_index=1, options={});
        //Switch
        //active_switch(switch_class='bt-switch', options=[]);

        //檢查是否有重複的Attribute & 並將其設定成Disable
        $('#tbl-product-sku-supplier tbody tr').each(function () {
            select_a_id_val = $(this).children('td:eq(3)').find('input').val();
            $(".select2_item[id=sku_supplier] option[value='"+select_a_id_val+"']").attr('disabled', 'disabled').append(' -- (已被選擇)');
        });
    });

    function md_product_sku_supplier_store(_this,  php_inject) {
        s_id = $('#sku_supplier').find(':selected').data('md-id');
        //先判別更改的是否等於原先設定 或是 空值
        if(s_id === "" || s_id === undefined){
            //關閉modal
            clean_close_modal(modal_id="modal-lg");
            return false;
        }

        var formData = new FormData();
        formData.append('s_id', s_id);
        formData.append('is_active', $('#is_active_sku_supplier_pivot').is(":checked"));
        formData.append('sku_id', php_inject.models.sku.sku_id);
        formData.append('url', $('#url').val());
        formData.append('price', $('#price').val());

        $.ajaxSetup(active_ajax_header());
        $.ajax({
            type: 'post',
            url: '{{route('member.product-sku-supplier.index')}}?sku_id='+php_inject.models.sku.sku_id,
            data: formData,
            async: true,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {

                //搜尋sku_supplier
                sku_supplier = data.models.sku.sku_suppliers.find(function (sku_supplier, index, array) {
                    return sku_supplier.pivot.s_id ==  data.models.skuSupplier.s_id &&  sku_supplier.pivot.sku_id == data.models.sku.sku_id  ;
                });

                //關閉modal
                clean_close_modal(modal_id="modal-lg");

                //顯示到modal left
                cursor_move = '<span class="handle" style="cursor: move;">' +
                    '                                        <i class="fa fa-ellipsis-v"></i>' +
                    '                                        <i class="fa fa-ellipsis-v"></i>' +
                    '                                  </span>';

                url_path = "{{asset('/')}}";
                if (sku_supplier.name_card != null) {
                    img_supplier = '<img src="' + url_path + sku_supplier.name_card + '" style="width:70px;">';
                } else {
                    img_supplier = '<img src="' + url_path + '/images/default/products/product.jpg" style="width:70px;">';
                }
                s_name = sku_supplier.s_name;

                switch_btn_checked = "";
                if (sku_supplier.is_active === 1) {
                    switch_btn_checked = "checked";
                }
                switch_btn = '<input type="checkbox"  class="permission_check" name="is_active" value="1" id="is_active_sku_supplier_pivot" '+switch_btn_checked+' disabled>' +
                        '                        <label for="is_active_sku_supplier_pivot" class="text-dark p-0 m-0"></label>';

                price = sku_supplier.pivot.price;
                url = '<a class="btn btn-sm btn-primary" href="' + sku_supplier.pivot.url + '" target="_blank"><i class="fa fa-link"></i></a>';

                models = {"models":{"sku":data.models.sku, "skuSupplier": data.models.skuSupplier}};
                crud = '<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-lg"' +
                    '                                          onclick="event.preventDefault(); md_product_sku_supplier_edit(this, php_inject=models);">' +
                    '                                           <i class="fa fa-edit mr-5">{{__('default.index.table.edit')}}</i>' +
                    '                                       </a>';
                html = '<tr data-ss-id="' + sku_supplier.pivot.ss_id + '"><td>' + cursor_move + '</td><td></td><td>' + img_supplier + '</td><td>' + s_name + '</td><td>' + switch_btn + '</td><td>' + price + '</td><td>' + url + '</td><td>' + crud + '</td></tr>';
                tr = $('#tbl-product-sku-supplier tbody').append(html);

                //排序
                $('#tbl-product-sku-supplier tbody tr').each(function ($index) {
                    input_a_id = $(this).children('td:eq(2)').find('input').attr('name', 'sku_suppliers[s_id]');
                    $(this).children('td:eq(1)').html($index + 1);
                })

                //Switch
                active_switch(switch_class = 'bt-switch', options = []);
            },
            error: function(data) {
                master_detail_errors(_this, data);
            }
        });
    }
</script>

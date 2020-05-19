<div class="box box-solid">
    <div class="box-body">
        @include(config('theme.admin.view').'layouts.modal-errors')
        <div class="row">
            <div class="col-10">
                @include(config('theme.member.view').'layouts.errors')
    
                <div class="form-group">
                    <h5>{{__('member/supplierGroup.edit.is_active')}}</h5>
                    <div class="controls">
                        <input type="checkbox"  class="permission_check" name="is_active" value=1 id="is_active_{{$sku->id_coode}}"
                                {{$sku->is_active==1? "checked":""}} >
                        <label for="is_active_{{$sku->id_coode}}" class="text-dark p-0 m-0"></label>
                    </div>
                </div>
                
                <div class="form-group">
                    <h5>{{__('default.index.table.barcode')}}</h5>
                    <div class="controls">
                        <input class="form-control" type="text" placeholder="{{__('default.index.table.barcode')}}"  value="{{$sku->id_code}}" disabled>
                    </div>
                </div>
    
                <div class="form-group">
                    <h5>{{__('member/product.productSKU.edit.price')}}</h5>
                    <div class="controls">
                        <input class="form-control" type="text" name="price" id="price"  placeholder="售價"  value="{{$sku->price}}">
                    </div>
                </div>

                <div class="form-group">
                    <h5>{{__('member/product.productSKU.edit.SKUName')}}</h5>
                    <div class="controls">
                        <input class="form-control" type="text" name="sku_name" id="sku_name" placeholder="sku_name"  value="{{$sku->sku_name}}">
                    </div>
                </div>
    
             
                @foreach($sku->skuAttributes as $skuAttribute)
        
                    <div class="form-group">
                        <h5>{{$skuAttribute->attribute->a_name}}</h5>
                        <div class="controls">
                            <input class="form-control attributes" type="text" name="sku_attributes[{{$skuAttribute->a_id}}]" placeholder=""  value="{{$skuAttribute->a_value}}">
                        </div>
                    </div>
                @endforeach
    
                <div class="form-group">
                    <a href="#" class="btn btn-success form-control"
                       onclick="event.preventDefault();
                               md_product_sku_update(this, php_inject={{json_encode([ 'models' => ['sku' => $sku]])}});">
                        <i class="fa fa-save"></i> {{__('default.edit.save')}}</a>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group row">
                    <div class=" img-preview-frame text-center" >
                        <input type="file" name="sku_thumbnail" id="sku_thumbnail"  onchange="showPreview(this,['sku_thumbnail_img'])" style="display: none;"/>
                        <label for="sku_thumbnail">
                            <img id="sku_thumbnail_img" class="rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{$sku->thumbnail? asset($sku->thumbnail):asset('images/default/products/product.jpg')}}" width="200px">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        //Switch
        active_switch(switch_class='bt-switch', options=[]);
    });

    function md_product_sku_update(_this,  php_inject){
        var formData = new FormData();
        formData.append('_method', 'put');
        formData.append('sku_id', php_inject.models.sku.sku_id);
        formData.append('thumbnail', $('#sku_thumbnail')[0].files[0]);
        formData.append('is_active', $('#is_active_{{$sku->id_coode}}').prop('checked'));
        formData.append('sku_name', $('#sku_name').val());
        //數性值
        $(".attributes").each(function(){
            //取得元素
            input_el = $(this);
            //將值綁定到Form中
            formData.append(input_el.attr('name'), input_el.val());
        });
        formData.append('price', $('#price').val());

        $.ajaxSetup(active_ajax_header());
        $.ajax({
            type: 'post',
            url: '{{route('member.product-sku.index')}}/'+ php_inject.models.sku.sku_id,
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

                //關閉modal
                clean_close_modal(modal_id="modal-lg");

                //新增增加的
                cursor_move = '<span class="handle" style="cursor: move;">' +
                    '                                        <i class="fa fa-ellipsis-v"></i>' +
                    '                                        <i class="fa fa-ellipsis-v"></i>' +
                    '                                  </span>';
                id_code = data.models.sku.id_code ;

                url = '{{asset('/')}}';
                if(data.models.sku.thumbnail!=null){
                    sku_thumbnial = '<img src="'+url+data.models.sku.thumbnail+'" class="product-sku-thumbnail">';
                }else{
                    sku_thumbnial = '<img src="'+url+'images/default/products/product.jpg'+'" class="product-sku-thumbnail">';
                }

                sku_name = data.models.sku.sku_name;
                price = data.models.sku.price;

                switch_btn_checked="";
                if(data.models.sku.is_active==1) {
                    switch_btn_checked = "checked";
                }
    
                switch_btn = '<input type="checkbox" class="permission_check" name="is_active" id="is_active_'+id_code+'"'+
                            switch_btn_checked + ' disabled>'+
                            '<label for="is_active_'+id_code+'" class="p-0 m-0"></label>';
                
                attr ="";
                $.each(data.models.sku.sku_attributes, function( index, item ) {
                    attr= attr + '<td>'+ null_to_empty(item.a_value) +'</td>';
                });

                models = {"models":{"sku": data.models.sku}};
                models_product = {"models":{"product": data.models.product}};

                crud_btn = '<a  class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-lg"'+
                    'onclick="event.preventDefault();'+
                    'md_product_sku_edit(this, php_inject=models)">'+
                    '<i class="fa fa-edit mr-5"></i>{{__("default.index.table.edit")}}</a> ';

                crud_btn = crud_btn + '<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-left"' +
                '                                                onclick="event.preventDefault();' +
                '                                                md_product_sku_supplier_index(this, php_inject=models_product);">' +
                '                                        <i class="fa fa-plus mr-5">{{__("member/product.productSKU.index.table.supplier")}}</i></a>';
                html='<tr data-md-id="'+data.models.sku.sku_id+'"><td>'+cursor_move+'</td><td></td><td>'+sku_name+'</td><td>'+sku_thumbnial+'</td><td>'+switch_btn+'</td>'+attr+'<td>'+price+'</td><td>'+crud_btn+'</td></tr>';


                //輸出
                tr = $('#tbl-product-sku tbody tr[data-md-id='+data.models.sku.sku_id+']');
                tr.after(html);
                //移除
                tr.remove();

                //Table重新排序
                active_table_tr_reorder_nth(table_id="tbl-product-sku", eq_order_index=1);
                //Switch
                active_switch(switch_class='bt-switch', options=[]);
            },
            error: function(data) {
                master_detail_errors(_this, data);
            }
        });
    }
</script>

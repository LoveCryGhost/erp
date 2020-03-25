<div class="box box-solid box-inverse box-dark">
    <div class="box-body">
        @include(config('theme.admin.view').'layouts.modal-errors')
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-primary"
                   onclick="event.preventDefault();
                           md_product_sku_store(this, php_inject={{json_encode(['models' => ["product" => $product]])}});">
                    <i class="fa fa-save"></i></a>
            </div>
            <div class="col-10">
                @include(config('theme.member.view').'layouts.errors')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Barcode</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="自動生成"  value="自動生成" disabled>
                    </div>



                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">啟用</label>
                    <div class="col-sm-10">
                        <input type="checkbox" class="bt-switch" name="is_active" id="is_active" value="1" {{old('is_active')==1? "checked":""}}
                        data-label-width="100%"
                               data-label-text="啟用" data-size="min"
                               data-on-text="On"    data-on-color="primary"
                               data-off-text="Off"  data-off-color="danger"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">售價</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="price" id="price"  placeholder="售價"  value="{{old('price')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">SKU名稱</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="sku_name" id="sku_name" placeholder="sku_name"  value="{{old('sku_name')}}">
                    </div>
                </div>
                @foreach($product->type->attributes as $attribute)
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{$attribute->a_name}}</label>
                        <div class="col-sm-10">
                            <input class="form-control attributes" type="text" name="sku_attributes[{{$attribute->a_id}}]" placeholder=""  value="{{old('skus['.$attribute->a_id.']')}}">
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col-2">
                <div class="form-group row">
                    <div class=" img-preview-frame text-center" >
                        <input type="file" name="thumbnail" id="thumbnail"  onchange="showPreview(this,['avatar_img'])" style="display: none;"/>
                        <label for="thumbnail">
                            <img id="avatar_img" class="rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{$product->thumbnail? asset($product->thumbnail):asset('images/default/products/product.jpg')}}" width="200px">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/images.js')}}"></script>
<!-- Form validator JavaScript -->
<script type="text/javascript">

    $(function(){
        //Switch
        active_switch(switch_class='bt-switch', options=[]);
    });
    function md_product_sku_store(_this,  php_inject){
        var formData = new FormData();
        formData.append('p_id', php_inject.models.product.p_id);
        formData.append('thumbnail', $('#thumbnail')[0].files[0]);
        formData.append('is_active', $('#is_active').prop('checked'));
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
            url: '{{route('member.product-sku.store')}}',
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
                    '      <i class="fa fa-ellipsis-v"></i>' +
                    '      <i class="fa fa-ellipsis-v"></i>' +
                    '</span>';
                id_code = data.models.sku.id_code;
                url = '{{asset('/')}}';
                if(data.models.sku.thumbnail!=null){
                    sku_thumbnial = '<img src="'+url+data.models.sku.thumbnail+'" class="product-sku-thumbnail">';
                }else{
                    sku_thumbnial = '<img src="'+url+'images/default/products/product.jpg'+'" class="product-sku-thumbnail">';
                }


                sku_name = data.models.sku.sku_name;
                price = data.models.sku.price;
                // console.log(data.rows.sku_attributes, data.rows.sku_attributes[0].a_value);

                switch_btn_checked="";
                if(data.models.sku.is_active==1) {
                    switch_btn_checked = "checked";
                }
                switch_btn = '<input type="checkbox" class="bt-switch" name="is_active"  value="1" '+switch_btn_checked +
                                '   data-label-width="100%"' +
                                '   data-label-text="啟用"' +
                                '   data-on-text="On"    data-on-color="primary"\n' +
                                '   data-off-text="Off"  data-off-color="danger"/>';

                attr ="";
                $.each(data.models.sku.sku_attributes, function( index, item ) {
                    attr= attr + '<td>'+ null_to_empty(item.a_value)+'</td>';
                });

                models = {"models":{"sku": data.models.sku}};
                models_product = {"models":{"product": data.models.product}};
                crud_btn = '<a  class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-lg"'+
                    'onclick="event.preventDefault();'+
                    'md_product_sku_edit(this, php_inject=models)">'+
                    '<i class="fa fa-edit mr-5"></i>編輯</a> ';

                crud_btn = crud_btn + '<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-left"' +
                    '                                                onclick="event.preventDefault();' +
                    '                                                md_product_sku_supplier_index(this, php_inject=models_product);">' +
                    '                                        <i class="fa fa-plus mr-5">供應商</i></a>';
                html='<tr data-md-id="'+data.models.sku.sku_id+'"><td>'+cursor_move+'</td><td>'+switch_btn+'</td><td>'+sku_name+'</td><td>'+sku_thumbnial+'</td><td>'+switch_btn+'</td>'+attr+'<td>'+price+'</td><td>'+crud_btn+'</td></tr>';
                $('#tbl-product-sku tbody').append(html);

                //Table重新排序
                active_table_tr_reorder_nth(table_id="tbl-product-sku", eq_order_index=1);
                active_switch(switch_class='bt-switch', options=[]);
            },
            error: function(data) {
                master_detail_errors(_this, data);
            }
        });
    }
</script>

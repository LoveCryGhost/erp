<div class="box box-solid box-inverse box-dark">
    <div class="box-header  p-5">
        <h5 class="box-title m-0">{{__('member/product.productSKU.index.title')}}</h5>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modal-lg"
                   onclick="event.preventDefault();
                           md_product_sku_create(this, php_inject={{json_encode(['models'=>[ 'product' => $product]])}});">
                    <i class="fa fa-plus"></i></a>
            </div>
            <div class="col-12">
                <table class="itable table" id="tbl-product-sku">
                    <thead>
                    <tr>
                        <th>{{__('default.index.table.no')}}</th>
                        <th>{{__('default.index.table.sort_order')}}</th>
                        <th>{{__('default.index.table.name')}}</th>
                        <th>{{__('default.index.table.image')}}</th>
                        <th>{{__('default.index.table.is_active')}}</th>
                        @foreach($product->type->attributes as $attribute)
                            <th>{{$attribute->a_name}}</th>
                        @endforeach
                        <th>{{__('member/product.productSKU.index.table.price')}}</th>
                        <th>{{__('default.index.table.crud')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(isset($product))
                            @foreach($product->skus(10) as $sku)
                                <tr class="handle" data-md-id="{{$sku->sku_id}}">
                                    <td>
                                            <span class="handle" style="cursor: move;">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                          </span>
                                    </td>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$sku->sku_name}}<br>
                                        {{$sku->id_code}}
                                    </td>
                                    <td>
                                        <img src="{{$sku->thumbnail!==null? asset($sku->thumbnail):asset('images/default/products/product.jpg')}}" class="product-sku-thumbnail"
                                            onclick="show_product_thumbnails(this,php_inject={{json_encode(['product_thumbnail_path' => $sku->thumbnail!==null? asset($sku->thumbnail):asset('images/default/products/product.jpg')])}})"
                                             data-toggle="modal" data-target="#modal-md"
                                        >
                                    </td>
                                    <td>
                                        <input type="checkbox" class="permission_check" name="is_active" id="is_active"
                                               {{$sku->is_active===1? "checked": ""}} disabled>
                                        <label for="is_active" class="p-0 m-0"></label>
                                    </td>
                                    @foreach($sku->skuAttributes as $attribute)
                                    <td>{{$attribute->a_value}}</td>
                                    @endforeach
                                    <td>{{$sku->price}}</td>
                                    <td>
                                        <a  class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-lg"
                                            onclick="event.preventDefault();
                                                    md_product_sku_edit(this, php_inject={{json_encode(['models'  => ['sku' => $sku] ])}});">
                                            <i class="fa fa-edit mr-5"></i> {{__('default.index.table.edit')}}</a>
                                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-left"
                                                onclick="event.preventDefault();
                                                md_product_sku_supplier_index(this, php_inject={{json_encode([ 'models' => ['sku'=> $sku]])}});">
                                        <i class="fa fa-plus mr-5"></i> {{__('member/product.productSKU.index.table.supplier')}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{$product->skus(10)->links()}}
            </div>
        </div>

    </div>
</div>

@section('js')
    @parent
    @yield('js')

    <script type="text/javascript">
        $(function () {
            //排序表格
            active_table_sortable(table_id="tbl-product-sku", eq_order_index=1, options={});
            //Switch
            active_switch(switch_class='bt-switch', options=[]);
        });

        function md_product_sku_create(_this,  php_inject){
            $('#modal-lg .modal-body').html('');
            $.ajaxSetup(active_ajax_header());
            $.ajax({
                type: 'get',
                url: '{{route('member.product-sku.create')}}?p_id=' + php_inject.models.product.p_id,
                data: '',
                async: true,
                crossDomain: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#modal-lg .modal-title').html("{{__('member/product.productSKU.create.title')}}");
                    $('#modal-lg .modal-body').html(data.view)
                },
                error: function(data) {
                }
            });
        }

        function md_product_sku_edit(_this,  php_inject){
            $('#modal-lg .modal-body').html('');
            $.ajaxSetup(active_ajax_header());
            $.ajax({
                type: 'get',
                url: '{{route('member.product-sku.index')}}/'+php_inject.models.sku.sku_id+'/edit',
                data: '',
                async: true,
                crossDomain: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#modal-lg .modal-title').html("{{__('member/product.productSKU.edit.title')}}");
                    $('#modal-lg .modal-body').html(data.view);
                },
                error: function(data) {
                }
            });
        }

        function md_product_sku_supplier_index(_this,  php_inject) {
            $.ajaxSetup(active_ajax_header());
            $.ajax({
                type: 'get',
                url: '{{route('member.product-sku-supplier.index')}}?sku_id='+php_inject.models.sku.sku_id,
                data: '',
                async: true,
                crossDomain: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#modal-left .modal-title').html('供應商 - 列表');
                    $('#modal-left .modal-body').html(data.view);
                },
                error: function(data) {
                }
            });
        }
    </script>

    <script type="text/javascript">
        function show_product_thumbnails(_this, php_inject) {
            product_thumbnail_path = php_inject.product_thumbnail_path;
            modal_body =  $('#modal-md .modal-body').html('');
            src = product_thumbnail_path;
            img_html = "<img src="+src+">";
            $('#modal-md .modal-body').append(img_html)
        }
    </script>
@endsection

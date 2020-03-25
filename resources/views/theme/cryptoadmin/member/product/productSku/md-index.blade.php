<div class="box box-solid box-inverse box-dark">
    <div class="box-header  p-5">
        <h5 class="box-title m-0">產品SKU</h5>
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
                <table class="table table-bordered table-hover" id="tbl-product-sku">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>排序</th>
                        <th>名稱</th>
                        <th>圖片</th>
                        <th>啟用</th>
                        @foreach($product->type->attributes as $attribute)
                            <th>{{$attribute->a_name}}</th>
                        @endforeach
                        <th>價錢</th>
                        <th>操作</th>
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
                                        <img src="{{$sku->thumbnail!==null? asset($sku->thumbnail):asset('images/default/products/product.jpg')}} " class="product-sku-thumbnail">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="bt-switch"  value="1" {{$product->is_active==1? "checked":""}}
                                        data-label-width="100%"
                                               data-label-text="啟用" data-size="min"
                                               data-on-text="On"    data-on-color="primary"
                                               data-off-text="Off"  data-off-color="danger"/>
                                    </td>
                                    @foreach($sku->skuAttributes as $attribute)
                                    <td>{{$attribute->a_value}}</td>
                                    @endforeach
                                    <td>{{$sku->price}}</td>
                                    <td>
{{--                                        @include('theme.cryptoadmin.member.layouts.btn-md-index-table_tr', ['route_name'=> 'member.product-sku', 'm_id' => $sku->sku_id])--}}
                                        <a  class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-lg"
                                            onclick="event.preventDefault();
                                                    md_product_sku_edit(this, php_inject={{json_encode(['models'  => ['sku' => $sku] ])}});">
                                            <i class="fa fa-edit mr-5"></i>編輯</a>
                                        <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-left"
                                                onclick="event.preventDefault();
                                                md_product_sku_supplier_index(this, php_inject={{json_encode([ 'models' => ['sku'=> $sku]])}});">
                                        <i class="fa fa-plus mr-5"></i>供應商</a>
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
                    $('#modal-lg .modal-title').html('產品 - SKU');
                    $('#modal-lg .modal-body').html(data.view)
                },
                error: function(data) {
                }
            });
        }

        function md_product_sku_edit(_this,  php_inject){
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
                    $('#modal-lg .modal-title').html('編輯 - 產品SKU');
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
@endsection

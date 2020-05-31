@extends(config('theme.member.member-app'))

@section('title', 'SKU Plus Suppliers')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                SKU Plus Suppliers
            </h3>
          
        </div>

        <!-- Main content -->
        <section class="content">
            <form method="post" action="{{route('member.skuPlusSupplier.update',['skuPlusSupplier'=> $sku_editable->sku_id])}}">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        @include(config('theme.member.view').'layouts.errors')
                    </div>
                    
                    <div class="col-xl-12 col-lg-12 text-right mb-5">
                        <button class="btn btn-primary" type="submit" name="submit" value="index"><i class="fa fa-floppy-o"></i></button>
                        <button class="btn btn-primary" type="submit" name="submit" value="edit"><i class="fa fa-arrow-down"></i></button>
                        <a class="btn btn-warning" onclick="add_supplier(this,php_inject={{json_encode([ 'models'=> ['sku' => $sku_editable]])}})" ><i class="fa fa-plus"></i></a>
                        <a class="btn btn-danger" href="{{route('member.skuPlusSupplier.index',['collapse'=> 1])}}" ><i class="fa fa-arrow-left"></i> SKU</a>
                        <a class="btn btn-danger" href="{{route('member.productPlusSKU.index',['collapse'=> 1])}}" ><i class="fa fa-arrow-left"></i> Product</a>
                    </div>
                    
                    {{--相關訊息--}}
                    <div class="col-xl-12 col-lg-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body div_overflow-x">
                                <div class="row">
                                    <div class="col-12">
                                        {{__('member/productPlusSKU.edit.productName')}}: {{$product->p_name}}<br>
                                        {{__('member/productPlusSKU.edit.productBarcode')}}: {{$product->id_code}}
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-2">
                                        SKU List :<br>
                                        @foreach($product->all_skus as $sku)
                                            <div class="div_paper">
                                                {{$sku->sku_name}}<br>
                                                {{$sku->id_code}}<br>
                                                @if($sku->sku_id == $sku_editable->sku_id )
                                                    <div class="text-right">
                                                        <a class="btn btn-danger" href="{{route('member.skuPlusSupplier.edit',['collapse'=> 1, 'skuPlusSupplier' => $sku->sku_id])}}" ><i class="fa fa-arrow-right"></i></a>
                                                    </div>
                                                @else
                                                    <a class="btn btn-warning" href="{{route('member.skuPlusSupplier.edit',['collapse'=> 1, 'skuPlusSupplier' => $sku->sku_id])}}" ><i class="fa fa-arrow-right"></i></a>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-10 div_overflow-x">
                                        <table id="skuPlusSupplier" class="itable table">
                                            <thead>
                                                <tr>
                                                    <th>Move</th>
                                                    <th>Order</th>
                                                    <th>Action</th>
                                                    <th>Supplier Name</th>
                                                    <th>Info</th>
                                                    <th>Active</th>
                                                    <th>Product Link</th>
                                                    <th>Purchase Price</th>
                                                </tr>
                                                <tr stylex="display:none;">
                                                    <td class="w-100">
                                                        <span class="handle" style="cursor: move;">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                            <i class="fa fa-ellipsis-v"></i>
                                                      </span>
                                                    </td>
                                                    <td>
                                                    
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-success" onclick="copy_supplier(this,php_inject={{json_encode([ 'models'=> ['sku' => $sku_editable]])}})" ><i class="fa fa-copy"></i></a>
                                                        <input type="text" hidden name="ss_id[]" value="">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="s_id[]" value="">
                                                    </td>
                                                    <td>
                                                    
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="permission_check" name="is_active[]" id="is_active_{{rand(999,999999)}}" disabled>
                                                        <label for="is_active_{{rand(999,999999)}}" class="p-0 m-0"></label>
                                                    </td>
                                                    <td><input type="text" name="url[]" value=""></td>
                                                    <td><input type="text" name="price[]" value=""></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($sku_editable->skuSuppliers as $supplier)
                                                <tr>
                                                    <td class="w-100">
                                                        <span class="handle" style="cursor: move;">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                            <i class="fa fa-ellipsis-v"></i>
                                                      </span>
                                                    </td>
                                                    <td>{{$loop->iteration}}<br>ss_id[{{$supplier->pivot->ss_id}}]</td>
                                                    <td>
                                                        <a class="btn btn-success" onclick="copy_supplier(this,php_inject={{json_encode([ 'models'=> ['sku' => $sku_editable]])}})" ><i class="fa fa-copy"></i></a>
                                                        <input type="text" hidden name="ss_id[]" value="{{$supplier->pivot->ss_id}}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="s_id[]" value="{{$supplier->s_id}}">
                                                        {{$supplier->s_name}}<br>
                                                        {{$supplier->id_code}}
                                                    </td>
                                                    <td>
                                                        {{$supplier->tel}}<br>
                                                        {{$supplier->phone}}<br>
                                                        <a class="btn btn-primary" href="{{($supplier->website)}}" target="_blank"><i class="fa fa-link"></i> </a>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="permission_check" name="is_active[]" id="is_active_{{$supplier->pivot->ss_id}}"
                                                               {{$supplier->pivot->is_active===1? "checked": ""}} value="{{$supplier->pivot->ss_id}}">
                                                        <label for="is_active_{{$supplier->pivot->ss_id}}" class="p-0 m-0"></label>
                                                    </td>
                                                    <td><input type="text" name="url[]" value="{{$supplier->pivot->url}}"></td>
                                                    <td><input type="text" name="price[]" value="{{$supplier->pivot->price}}"></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>

                        </div>

                    </div>
                </div>
            </form>

        </section>
        <!-- /.content -->

    </div>
@stop

@section('js')
    @parent
    <script type="text/javascript">
        $(function(){
            //排序表格
            active_table_sortable(table_id="skuPlusSupplier", eq_order_index=1, options={});
        })

        function add_supplier(_this,  php_inject) {
            sku = php_inject.models.sku
            //新增在最後一列
            //新拷貝最後一列
            clonedRow = $('#skuPlusSupplier thead tr:last').clone();
            $('#skuPlusSupplier tbody').append(clonedRow);
            active_table_tr_reorder_nth(table_id="skuPlusSupplier", eq_order_index=1, options={});
            reset_crontrol_item(cleanValue=true);
        }

        function copy_supplier(_this,  php_inject) {
            sku = php_inject.models.sku
            //新增在最後一列
            //新拷貝最後一列
            clonedRow = $(_this).parents('tr').clone();
            $('#skuPlusSupplier tbody').append(clonedRow);
            active_table_tr_reorder_nth(table_id="skuPlusSupplier", eq_order_index=1, options={});
            reset_crontrol_item(cleanValue=false);
        }
        
        function reset_crontrol_item(cleanValue=true) {
            $('#skuPlusSupplier tbody tr:last').show();
            $('#skuPlusSupplier tbody tr:last td input').each(function(){
                controlItem = $(this);
    
                //input text
                $('#skuPlusSupplier tbody tr:last td input').eq(0).val("");
                if(cleanValue==true && controlItem.attr('text')=="text"){
                    controlItem.val("")
                    alert(1);
                //input checkbox
                }else if(cleanValue==true && controlItem.attr('text')=="checkbox"){
                    controlItem.prop('checked', false);
                    alert(2);
                }
    
                _name = controlItem.attr('name');
                if(_name!=undefined) {
                    _name_arr = _name.split('[');
                    $(this).find('input').attr('name', _name_arr[0] + "[]");
                }
            })
        }
        
    </script>
@endsection



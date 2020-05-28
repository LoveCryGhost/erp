@extends(config('theme.member.member-app'))

@section('title',__('member/productPlusSKU.title'))

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                {{__('member/productPlusSKU.title')}}
            </h3>
          
        </div>

        <!-- Main content -->
        <section class="content">
            <form method="post" action="{{route('member.productPlusSKU.update',['productPlusSKU'=> $product->p_id])}}">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        @include(config('theme.member.view').'layouts.errors')
                    </div>
                    
                    <div class="col-xl-12 col-lg-12 text-right mb-5">
                        <button class="btn btn-primary" type="submit" name="submit" value="index"><i class="fa fa-floppy-o"></i></button>
                        <button class="btn btn-primary" type="submit" name="submit" value="edit"><i class="fa fa-arrow-down"></i></button>
                        <a class="btn btn-warning" onclick="add_sku(this,php_inject={{json_encode([ 'models'=> ['product' => $product]])}})" ><i class="fa fa-plus"></i></a>
                        <a class="btn btn-danger" href="{{route('member.productPlusSKU.index',['collapse'=> 1])}}" ><i class="fa fa-arrow-left"></i></a>
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
                                <table class="itable table" id="productPlusSKU">
                                    <thead>
                                        <tr>
                                            <th> No  </th>
                                            <th>Order</th>
                                            <th>Action</th>
                                            <th>Active</th>
                                            <th>Name</th>
                                            <th>Sell Price</th>
                                            {{--屬性--}}
                                            @foreach($product->type->attributes as $attribute)
                                                <th>{{$attribute->a_name}}</th>
                                            @endforeach
                                            <th>L / pcs</th>
                                            <th>W / pcs</th>
                                            <th>H / pcs</th>
                                            <th>Weight(Kg) / pcs</th>
                                            <th>L / box</th>
                                            <th>W / box</th>
                                            <th>H / box</th>
                                            <th>Weight(Kg) / box</th>
                                            <th>pcs / box</th>
                                        </tr>
                                        <tr style="display:none;">
                                            <td>
                                                <span class="handle" style="cursor: move;">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </span>
                                            </td>
                                            <td>Order</td>
                                            <td>
                                                <a class="btn btn-success" onclick="copy_sku(this,php_inject={{json_encode([ 'models'=> ['product' => $product]])}})" ><i class="fa fa-copy"></i></a>
                                                <input type="text" hidden name="sku_id[]" value=""></td>
                                            <td>
                                                <input type="checkbox" class="permission_check" name="is_active[]" id="is_active_{{rand(999,999999)}}" disabled >
                                                <label for="is_active_{{rand(999,999999)}}" class="p-0 m-0"></label></td>
                                            <td>
                                                <input class="w-400" type="text" name="sku_name[]" value=""></td>
                                            <td>
                                                <input type="text" name="price[]" value=""></td>
                                            {{--屬性--}}
                                            {{--屬性--}}
                                            @foreach($product->type->attributes as $attribute)
                                                <td>
                                                    <input type="text" name="sku_attributes[]" value="">
                                                    <input type="text" hidden name="sku_attributes_a_id[]" value="{{$attribute->a_id}}">
                                                </td>
                                            @endforeach
                                            <td><input type="text" name="length_pcs[]" value=""></td>
                                            <td><input type="text" name="width_pcs[]" value=""></td>
                                            <td><input type="text" name="heigth_pcs[]" value=""></td>
                                            <td><input type="text" name="weight_pcs[]" value=""></td>
                                            <td><input type="text" name="length_box[]" value=""></td>
                                            <td><input type="text" name="width_box[]" value=""></td>
                                            <td><input type="text" name="heigth_box[]" value=""></td>
                                            <td><input type="text" name="weight_box[]" value=""></td>
                                            <td><input type="text" name="pcs_per_box[]" value=""></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product->all_skus as $sku)
                                        <tr>
                                            <td class="w-100">
                                                <span class="handle" style="cursor: move;">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                    <i class="fa fa-ellipsis-v"></i>
                                              </span>
                                            </td>
                                            
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <a class="btn btn-success" onclick="copy_sku(this,php_inject={{json_encode([ 'models'=> ['product' => $product]])}})" ><i class="fa fa-copy"></i></a>
                                                <input type="text" hidden name="sku_id[]" value="{{$sku->sku_id}}">
                                            </td>
                                            <td>
                                                <input type="checkbox" class="permission_check" name="is_active[]" id="is_active_{{$sku->sku_id}}"
                                                   {{$sku->is_active===1? "checked": ""}} value="{{$sku->sku_id}}">
                                                <label for="is_active_{{$sku->sku_id}}" class="p-0 m-0"></label>
                                            </td>
                                            <td>
                                                <input class="w-400" type="text" name="sku_name[]" value="{{$sku->sku_name}}">
                                            </td>
                                            <td><input type="text" name="price[]" value="{{$sku->price}}"></td>
                                            {{--屬性--}}
                                            @foreach($sku->skuAttributes as $attribute)
                                                <td>
                                                    <input type="text" name="sku_attributes[]" value="{{$attribute->a_value}}">
                                                    <input type="text" hidden name="sku_attributes_a_id[]" value="{{$attribute->a_id}}">
                                                </td>
                                            @endforeach
                                            <td><input type="text" name="length_pcs[]" value="{{$sku->length_pcs}}"></td>
                                            <td><input type="text" name="width_pcs[]" value="{{$sku->width_pcs}}"></td>
                                            <td><input type="text" name="heigth_pcs[]" value="{{$sku->heigth_pcs}}"></td>
                                            <td><input type="text" name="weight_pcs[]" value="{{$sku->weight_pcs}}"></td>
                                            <td><input type="text" name="length_box[]" value="{{$sku->length_box}}"></td>
                                            <td><input type="text" name="width_box[]" value="{{$sku->width_box}}"></td>
                                            <td><input type="text" name="heigth_box[]" value="{{$sku->heigth_box}}"></td>
                                            <td><input type="text" name="weight_box[]" value="{{$sku->weight_box}}"></td>
                                            <td><input type="text" name="pcs_per_box[]" value="{{$sku->pcs_per_box}}"></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
            active_table_sortable(table_id="productPlusSKU", eq_order_index=1, options={});
        })

        function add_sku(_this,  php_inject) {
            product = php_inject.models.product
            //新增在最後一列
            //新拷貝最後一列
            clonedRow = $('#productPlusSKU thead tr:last').clone();
            $('#productPlusSKU tbody').append(clonedRow);
            active_table_tr_reorder_nth(table_id="productPlusSKU", eq_order_index=1, options={});
            reset_crontrol_item(cleanValue=true);
        }

        function copy_sku(_this,  php_inject) {
            product = php_inject.models.product
            //新增在最後一列
            //新拷貝最後一列
            clonedRow = $(_this).parents('tr').clone();
            $('#productPlusSKU tbody').append(clonedRow);
            active_table_tr_reorder_nth(table_id="productPlusSKU", eq_order_index=1, options={});
            reset_crontrol_item(cleanValue=false);
        }
        
        function reset_crontrol_item(cleanValue=true) {
            $('#productPlusSKU tbody tr:last').show();
            $('#productPlusSKU tbody tr:last td input').each(function(){
                controlItem = $(this);
    
                //input text
                $('#productPlusSKU tbody tr:last td input').eq(0).val("");
                if(cleanValue==true && controlItem.attr('text')=="text"){
                    controlItem.val("")
                    
                //input checkbox
                }else if(cleanValue==true && controlItem.attr('text')=="checkbox"){
                    controlItem.prop('checked', false);
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



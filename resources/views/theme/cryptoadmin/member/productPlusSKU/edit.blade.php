@extends(config('theme.member.member-app'))

@section('title',__('member/product.edit.title'))

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                {{__('member/product.edit.title')}}
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
                        <button class="btn btn-primary" type="submit" ><i class="fa fa-floppy-o"></i></button>
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
                                        Product Name: {{$product->p_name}}<br>
                                        Product Code: {{$product->id_code}}
                                    </div>
                                </div>
                                <table class="itable table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
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
                                    </thead>
                                    <tbody>
                                        @foreach($product->all_skus as $sku)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <input type="checkbox" class="permission_check" name="is_active[{{$sku->sku_id}}]" id="is_active_{{$sku->sku_id}}"
                                                       {{$sku->is_active===1? "checked": ""}} >
                                                <label for="is_active_{{$sku->sku_id}}" class="p-0 m-0"></label>
                                            </td>
                                            <td>
                                                <input class="w-400" type="text" name="sku_name[{{$sku->sku_id}}]" value="{{$sku->sku_name}}">
                                            </td>
                                            <td><input type="text" name="price[{{$sku->sku_id}}]" value="{{$sku->price}}"></td>
                                            {{--屬性--}}
                                            @foreach($sku->skuAttributes as $attribute)
                                                <td><input type="text" name="sku_attributes" value="{{$attribute->a_value}}"></td>
                                            @endforeach
                                            <td><input type="text" name="length_pcs[{{$sku->sku_id}}]" value="{{$sku->length_pcs}}"></td>
                                            <td><input type="text" name="width_pcs[{{$sku->sku_id}}]" value="{{$sku->width_pcs}}"></td>
                                            <td><input type="text" name="heigth_pcs[{{$sku->sku_id}}]" value="{{$sku->heigth_pcs}}"></td>
                                            <td><input type="text" name="weight_pcs[{{$sku->sku_id}}]" value="{{$sku->weight_pcs}}"></td>
                                            <td><input type="text" name="length_box[{{$sku->sku_id}}]" value="{{$sku->length_box}}"></td>
                                            <td><input type="text" name="width_box[{{$sku->sku_id}}]" value="{{$sku->width_box}}"></td>
                                            <td><input type="text" name="heigth_box[{{$sku->sku_id}}]" value="{{$sku->heigth_box}}"></td>
                                            <td><input type="text" name="weight_box[{{$sku->sku_id}}]" value="{{$sku->weight_box}}"></td>
                                            <td><input type="text" name="pcs_per_box[{{$sku->sku_id}}]" value="{{$sku->pcs_per_box}}"></td>
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
            //Select2
            active_select2(select2_class='select2_item', options={});
        })
    </script>
@endsection



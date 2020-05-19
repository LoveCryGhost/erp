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
            <form method="post" action="{{route('member.product.update',['product'=> $product->p_id])}}">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        @include(config('theme.member.view').'layouts.errors')
                    </div>

                    <div class="col-xl-12 col-lg-12 text-right mb-5">
                        @include(config('theme.member.btn.edit.crud'))
                    </div>
                    {{--相關訊息--}}
                    <div class="col-xl-12 col-lg-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.is_active')}}</h5>
                                            <div class="controls">
                                                <input type="checkbox"  class="permission_check" name="is_active" value="1" id="is_active"
                                                        {{$product->is_active==1? "checked":""}} >
                                                <label for="is_active" class="text-dark p-0 m-0"></label>
                                            </div>
                                        </div>
    
                                        <div class="form-group">
                                            <h5>{{__('default.index.table.barcode')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text"  placeholder="Auto-Generate" disabled value="{{$product->id_code}}">
                                            </div>
                                        </div>
                                        
                                        
                                        {{--產品類型--}}
                                        <div class="form-group">
                                            <h5>{{__('member/product.edit.productType')}}</h5>
                                            <div class="controls">
                                                <select class="select2_item form-control" name="t_id" required data-validation-required-message="必填欄位">
                                                {{--預設值--}}
                                                <option value="">Select...</option>
                                                @foreach($types as $type)
                                                    <option value="{{$type->t_id}}" {{$type->t_id==$product->t_id? "selected":"" }}>{{$type->t_name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
    
                                        <div class="form-group">
                                            <h5>{{__('member/product.edit.publishAt')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="publish_at" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{$product->published_at}}">
                                            </div>
                                        </div>
    
                                        <div class="form-group">
                                            <h5>{{__('member/product.edit.productName')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="p_name" placeholder="產品名稱"  value="{{$product->p_name}}">
                                            </div>
                                        </div>
    
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success form-control">{{__('member/supplier.edit.save')}}</button>
                                        </div>
                                    </div>

                                </div>
                                @include('theme.cryptoadmin.member.product.productSku.md-index',['product' => $product])
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
            //Switch
            active_switch(switch_class='bt-switch', options=[]);
        })
    </script>
@endsection



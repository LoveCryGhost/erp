@extends(config('theme.member.member-app'))

@section('title',__('member/product.create.title'))

@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h3>
            {{__('member/product.create.title')}}
        </h3>
        
    </div>

    <!-- Main content -->
    <section class="content">
        <form method="post" action="{{route('member.product.store')}}">
            @csrf
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    @include(config('theme.member.view').'layouts.errors')
                </div>

                <div class="col-xl-12 col-lg-12 text-right mb-5">
                    @include(config('theme.member.btn.create.crud'))
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
                                                    {{old('is_active')==1? "checked":""}} >
                                            <label for="is_active" class="text-dark p-0 m-0"></label>
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <h5>{{__('default.index.table.barcode')}}</h5>
                                        <div class="controls">
                                            <input class="form-control" type="text"  placeholder="Auto-Generate" disabled value="{{old('id_code')}}">
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
                                                    <option value="{{$type->t_id}}" {{$type->t_id==old('t_id')? "selected":"" }}>{{$type->t_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <h5>{{__('member/product.edit.publishAt')}}</h5>
                                        <div class="controls">
                                            <input class="form-control" type="text" name="publish_at" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{old('published_at')}}">
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <h5>{{__('member/product.edit.productName')}}</h5>
                                        <div class="controls">
                                            <input class="form-control" type="text" name="p_name" placeholder="{{__('member/product.create.productName')}}"  value="{{old('p_name')}}">
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <h5>{{__('member/product.edit.productDescription')}}</h5>
                                        <div class="controls">
                                            <textarea class="form-control" type="text" name="p_description" placeholder="{{__('member/product.edit.productDescription')}}">{{old('p_description')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success form-control">{{__('member/supplier.edit.save')}}</button>
                                    </div>
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
            //Select2
            active_select2(select2_class='select2_item', options={});
            //Switch
            active_switch(switch_class='bt-switch', options=[]);
        })
    </script>
@endsection



@extends(config('theme.member.member-app'))

@section('title', __('member/supplier.create.title'))

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                {{__('member/supplier.create.title')}}
            </h3>
        </div>

        <!-- Main content -->
        <section class="content">
            <form method="post" action="{{route('member.supplier.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        @include(config('theme.member.view').'layouts.errors')
                    </div>

                    <div class="col-xl-12 col-lg-12 text-right mb-5">
                        <button class="btn btn-primary" type="submit" ><i class="fa fa-floppy-o"></i></button>
                        <a class="btn btn-warning" href="{{route('member.supplier.create')}}" ><i class="fa fa-plus"></i></a>
                        <a class="btn btn-danger" href="{{route('member.supplier.index')}}" ><i class="fa fa-arrow-left"></i></a>
                    </div>
                    {{--相關訊息--}}
                    <div class="col-xl-12 col-lg-12">
                        <div class="box box-solid ">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <h5>{{__('member/supplier.create.is_active')}}</h5>
                                            <div class="controls">
                                                <input type="checkbox"  class="permission_check" name="is_active" value="1" id="is_active"
                                                        {{old('is_active')==1? "checked":""}} >
                                                <label for="is_active" class="text-dark p-0 m-0"></label>
                                            </div>
                                        </div>
    
                                        <div class="form-group">
                                            <h5>{{__('default.create.autoGenerate')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text"  placeholder="{{__('default.create.autoGenerate')}}" disabled>
                                            </div>
                                        </div>
    
                                        {{--供應商群組--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.create.supplierGroupName')}}</h5>
                                            <select class="select2_item form-control" name="sg_id" id="sg_id">
                                                <option value="">Select...</option>
                                                @foreach($supplierGroups as $supplierGroup)
                                                    <option value="{{$supplierGroup->sg_id}}" {{$supplierGroup->sg_id==old('sg_id')? "selected":""}}>{{$supplierGroup->id_code}} - {{$supplierGroup->sg_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
    
    
                                        <div class="form-group">
                                            <h5>{{__('member/supplier.create.supplierName')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="s_name" placeholder="{{__('member/supplier.create.supplierName')}}"  value="{{old('s_name')}}">
                                            </div>
                                        </div>
    
                                        {{--地址--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplier.create.address')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="add_company" placeholder="{{__('member/supplier.create.address')}}"  value="{{old('add_company')}}">
                                            </div>
                                        </div>
    
                                        {{--倉庫--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplier.create.warehouseAddress')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="wh_company" placeholder="{{__('member/supplier.create.warehouseAddress')}}"  value="{{old('wh_company')}}">
                                            </div>
                                        </div>
    
                                        {{--電話--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplier.create.tel')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="tel" placeholder="{{__('member/supplier.create.tel')}}"  value="{{old('tel')}}">
                                            </div>
                                        </div>
    
                                        {{--手機--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplier.create.phone')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="phone" placeholder="{{__('member/supplier.create.phone')}}"  value="{{old('phone')}}">
                                            </div>
                                        </div>
    
                                        {{--統編--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplier.create.company_id')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="company_id" placeholder="{{__('member/supplier.create.company_id')}}"  value="{{old('wh_company')}}">
                                            </div>
                                        </div>
    
    
                                        {{--公司網址--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplier.create.website')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="website" placeholder="{{__('member/supplier.create.website')}}"  value="{{old('website')}}">
                                            </div>
                                        </div>
    
                                        {{--公司簡介--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplier.create.introduction')}}</h5>
                                            <div class="controls">
                                                <textarea class="form-control" type="text" name="introduction" placeholder="{{__('member/supplier.create.introduction')}}" >{{old('introduction')}}</textarea>
                                            </div>
                                        </div>
    
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success form-control">{{__('member/supplier.create.save')}}</button>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <div class=" img-preview-frame text-center" >
                                                <input type="file" name="name_card" id="name_card"  onchange="showPreview(this,['name_card_img'])" style="display: none;"/>
                                                <label for="name_card">
                                                    <img id="name_card_img" class="rounded img-fluid mx-auto d-block cursor-pointer img-350" src="{{asset('images/default/avatars/avatar.jpg')}}" width="200px">
                                                </label>
                                            </div>
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



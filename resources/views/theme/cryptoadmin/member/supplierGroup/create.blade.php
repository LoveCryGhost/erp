@extends(config('theme.member.member-app'))

@section('title', __('member/supplierGroup.create.title'))

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                {{__('member/supplierGroup.create.title')}}
            </h3>
            
        </div>

        <!-- Main content -->
        <section class="content">
            <form method="post" action="{{route('member.supplierGroup.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        @include(config('theme.member.view').'layouts.errors')
                    </div>

                    <div class="col-xl-12 col-lg-12 text-right mb-5">
                        <button class="btn btn-primary" type="submit" ><i class="fa fa-floppy-o"></i></button>
                        <a class="btn btn-danger" href="{{route('member.supplierGroup.index')}}" ><i class="fa fa-arrow-left"></i></a>
                    </div>
                    {{--相關訊息--}}
                    <div class="col-xl-12 col-lg-12">
                        <div class="box box-solid box-dark">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.is_active')}}</h5>
                                            <div class="controls">
                                                <input type="checkbox"  class="permission_check" name="is_active" value="1" id="is_active">
                                                <label for="is_active" class="text-dark p-0 m-0"></label>
                                            </div>
                                        </div>
        
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.barcode')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text"  placeholder="{{__('member/supplierGroup.edit.barcode')}}" disabled value="{{__('member/supplierGroup.edit.autoGenerate')}}">
                                            </div>
                                        </div>
        
        
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.supplierGroupName')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="sg_name" placeholder="{{__('member/supplierGroup.edit.supplierGroupName')}}"  value="">
                                            </div>
                                        </div>
        
                                        {{--地址--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.address')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="add_company" placeholder="{{__('member/supplierGroup.edit.address')}}"  value="">
                                            </div>
                                        </div>
        
                                        {{--倉庫--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.warehouseAddress')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="wh_company" placeholder="{{__('member/supplierGroup.edit.warehouseAddress')}}"  value="">
                                            </div>
                                        </div>
        
        
                                        {{--電話--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.tel')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="tel" placeholder="{{__('member/supplierGroup.edit.warehouseAddress')}}"  value="">
                                            </div>
                                        </div>
        
                                        {{--手機--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.phone')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="phone" placeholder="{{__('member/supplierGroup.edit.phone')}}"  value="">
                                            </div>
                                        </div>
        
                                        {{--統編--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.company_id')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="company_id" placeholder="{{__('member/supplierGroup.edit.company_id')}}"  value="">
                                            </div>
                                        </div>
        
                                        {{--公司網址--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.website')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="website" placeholder="{{__('member/supplierGroup.edit.website')}}"  value="">
                                            </div>
                                        </div>
        
                                        {{--公司簡介--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.introduction')}}</h5>
                                            <div class="controls">
                                                <textarea class="form-control" type="text" name="introduction" placeholder="{{__('member/supplierGroup.edit.introduction')}}" ></textarea>
                                            </div>
                                        </div>
        
                                        <div class="form-group">
                                            <div class="controls">
                                                <button type="submit" class="btn btn-success form-control">{{__('member/supplierGroup.edit.save')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <div class=" text-center" > {{-- img-preview-frame--}}
                                                <input type="file" name="name_card" id="name_card"  onchange="showPreview(this,['name_card_img'])" style="display: none;"/>
                                                <label for="name_card">
                                                    <img id="name_card_img" class="rounded img-fluid d-block img-350 cursor-pointer"  src="{{asset('images/default/avatars/avatar.jpg')}}">
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

@endsection



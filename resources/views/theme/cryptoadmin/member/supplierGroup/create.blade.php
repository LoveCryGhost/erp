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
                        <a class="btn btn-warning" href="{{route('member.supplierGroup.create')}}" ><i class="fa fa-plus"></i></a>
                        <a class="btn btn-danger" href="{{route('member.supplierGroup.index')}}" ><i class="fa fa-arrow-left"></i></a>
                    </div>
                    {{--相關訊息--}}
                    <div class="col-xl-12 col-lg-12">
                        <div class="box box-solid box-inverse box-dark">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{__('member/supplierGroup.create.title')}}</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{__('member/supplierGroup.edit.is_active')}}</label>
                                            <div class="col-sm-10">
                                                <input type="checkbox"  class="permission_check" name="is_active" value="1" id="is_active">
                                                <label for="is_active" class="text-dark p-0 m-0"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Barcode</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text"  placeholder="Auto-Generate" disabled value="{{old('id_code')}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{__('member/supplierGroup.create.supplierGroupName')}}</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="sg_name" placeholder="供應商群組名稱"  value="{{old('sg_name')}}">
                                            </div>
                                        </div>

                                        {{--地址--}}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{__('member/supplierGroup.create.address')}}</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="add_company" placeholder="{{__('member/supplierGroup.create.title')}}"  value="{{old('add_company')}}">
                                            </div>
                                        </div>

                                        {{--倉庫--}}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{__('member/supplierGroup.create.warehouseAddress')}}</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="add_company" placeholder="{{__('member/supplierGroup.create.warehouseAddress')}}"  value="{{old('wh_company')}}">
                                            </div>
                                        </div>

                                        {{--電話--}}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{__('member/supplierGroup.create.tel')}}</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="tel" placeholder="{{__('member/supplierGroup.create.tel')}}"  value="{{old('tel')}}">
                                            </div>
                                        </div>

                                        {{--手機--}}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{__('member/supplierGroup.create.phone')}}</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="phone" placeholder="{{__('member/supplierGroup.create.phone')}}"  value="{{old('phone')}}">
                                            </div>
                                        </div>

                                        {{--統編--}}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{__('member/supplierGroup.create.company_id')}}</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="add_company" placeholder="{{__('member/supplierGroup.create.company_id')}}"  value="{{old('wh_company')}}">
                                            </div>
                                        </div>

                                        {{--公司網址--}}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{__('member/supplierGroup.create.website')}}</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="website" placeholder="{{__('member/supplierGroup.create.website')}}"  value="{{old('website')}}">
                                            </div>
                                        </div>

                                        {{--公司簡介--}}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{__('member/supplierGroup.create.introduction')}}</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" type="text" name="introduction" placeholder="{{__('member/supplierGroup.create.introduction')}}" >{{old('introduction')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-warning">{{__('member/supplierGroup.create.save')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <div class=" img-preview-frame text-center" >
                                                <input type="file" name="name_card" id="name_card"  onchange="showPreview(this,['name_card_img'])" style="display: none;"/>
                                                <label for="name_card">
                                                    <img id="name_card_img" class="rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{asset('images/default/avatars/avatar.jpg')}}" width="200px">
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



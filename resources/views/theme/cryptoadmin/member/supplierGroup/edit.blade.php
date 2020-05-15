@extends(config('theme.member.member-app'))

@section('title',__('member/supplierGroup.edit.title'))

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                {{__('member/supplierGroup.edit.title')}}
            </h3>
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard"></i>首頁</a></li>--}}
{{--                <li class="breadcrumb-item"><a href="#">Members</a></li>--}}
{{--                <li class="breadcrumb-item active">Members Profile</li>--}}
{{--            </ol>--}}
        </div>

        <!-- Main content -->
        <section class="content">
            <form method="post" action="{{route('member.supplierGroup.update',['supplierGroup'=> $supplierGroup->sg_id])}}" enctype="multipart/form-data">
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
                        <div class="box box-solid box-dark">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <h5>Active</h5>
                                            <div class="controls">
                                                <input type="checkbox"  class="permission_check" name="is_active" value="1" id="is_active"
                                                        {{$supplierGroup->is_active==1? "checked":""}} >
                                                <label for="is_active" class="text-dark p-0 m-0"></label>
                                            </div>
                                        </div>
    
                                        <div class="form-group">
                                            <h5>Barcode</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text"  placeholder="Auto-Generate" disabled value="{{$supplierGroup->id_code}}">
                                            </div>
                                        </div>
    
    
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.supplierGroupName')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="sg_name" placeholder="{{__('member/supplierGroup.edit.supplierGroupName')}}"  value="{{$supplierGroup->sg_name}}">
                                            </div>
                                        </div>
    
                                        {{--地址--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.address')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="add_company" placeholder="{{__('member/supplierGroup.edit.address')}}"  value="{{$supplierGroup->add_company}}">
                                            </div>
                                        </div>

                                        {{--倉庫--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.warehouseAddress')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="wh_company" placeholder="{{__('member/supplierGroup.edit.warehouseAddress')}}"  value="{{$supplierGroup->wh_compcany}}">
                                            </div>
                                        </div>
                                        

                                        {{--電話--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.tel')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="tel" placeholder="{{__('member/supplierGroup.edit.warehouseAddress')}}"  value="{{$supplierGroup->tel}}">
                                            </div>
                                        </div>

                                        {{--手機--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.phone')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="phone" placeholder="{{__('member/supplierGroup.edit.phone')}}"  value="{{$supplierGroup->phone}}">
                                            </div>
                                        </div>

                                        {{--統編--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.company_id')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="company_id" placeholder="{{__('member/supplierGroup.edit.company_id')}}"  value="{{$supplierGroup->wh_company}}">
                                            </div>
                                        </div>
                                        
                                        {{--公司網址--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.website')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="website" placeholder="{{__('member/supplierGroup.edit.website')}}"  value="{{$supplierGroup->website}}">
                                            </div>
                                        </div>

                                        {{--公司簡介--}}
                                        <div class="form-group">
                                            <h5>{{__('member/supplierGroup.edit.introduction')}}</h5>
                                            <div class="controls">
                                                <textarea class="form-control" type="text" name="introduction" placeholder="{{__('member/supplierGroup.edit.introduction')}}" >{{$supplierGroup->introduction}}</textarea>
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
                                                    <img id="name_card_img" class="rounded img-fluid mx-auto d-block max-w-350" style="cursor: pointer;" src="{{$supplierGroup->name_card? asset($supplierGroup->name_card):asset('images/default/avatars/avatar.jpg')}}">
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
    </div>
@stop


@section('js')
@parent

@endsection



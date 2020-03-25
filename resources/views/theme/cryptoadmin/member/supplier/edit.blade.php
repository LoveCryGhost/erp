@extends(config('theme.member.member-app'))

@section('title','供應商 - 編輯')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                供應商 - 編輯
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard"></i>首頁</a></li>
                <li class="breadcrumb-item"><a href="#">Members</a></li>
                <li class="breadcrumb-item active">Members Profile</li>
            </ol>
        </div>

        <!-- Main content -->
        <section class="content">
            <form method="post" action="{{route('member.supplier.update',['supplier'=> $supplier->s_id])}}" enctype="multipart/form-data">
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
                        <div class="box box-solid box-inverse box-dark">
                            <div class="box-header with-border">
                                <h3 class="box-title">新增供應商群組</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">啟用</label>
                                            <div class="col-sm-10">
                                                <input type="checkbox" class="bt-switch form-control" name="is_active"  value="1" {{$supplier->is_active==1? "checked":""}}
                                                       data-label-width="100%"
                                                       data-label-text="啟用" data-size="min"
                                                       data-on-text="On"    data-on-color="primary"
                                                       data-off-text="Off"  data-off-color="danger"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Barcode</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text"  placeholder="Auto-Generate" disabled value="{{$supplier->id_code}}">
                                            </div>
                                        </div>

                                        {{--供應商群組--}}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">供應商群組</label>
                                            <div class="col-sm-10">
                                                <select class="select2_item form-control" name="sg_id" id="sg_id">
                                                    <option value="">Select...</option>
                                                    @foreach($supplierGroups as $supplierGroup)
                                                        <option value="{{$supplierGroup->sg_id}}" {{$supplierGroup->sg_id==$supplier->sg_id? "selected":""}}>{{$supplierGroup->id_code}} - {{$supplierGroup->sg_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">供應商名稱</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="s_name" placeholder="供應商名稱"  value="{{$supplier->s_name}}">
                                            </div>
                                        </div>

                                        {{--地址--}}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">地址</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="add_company" placeholder="地址"  value="{{$supplier->add_company}}">
                                            </div>
                                        </div>

                                        {{--倉庫--}}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">倉庫</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="wh_company" placeholder="倉庫"  value="{{$supplier->wh_company}}">
                                            </div>
                                        </div>

                                        {{--電話--}}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">電話</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="tel" placeholder="電話"  value="{{$supplier->tel}}">
                                            </div>
                                        </div>

                                        {{--手機--}}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">手機</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="phone" placeholder="手機"  value="{{$supplier->phone}}">
                                            </div>
                                        </div>

                                        {{--統編--}}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">統編</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="company_id" placeholder="統編"  value="{{$supplier->wh_company}}">
                                            </div>
                                        </div>

                                        {{--公司網址--}}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">公司網址</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="website" placeholder="公司網址"  value="{{$supplier->website}}">
                                            </div>
                                        </div>

                                        {{--公司簡介--}}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">簡介</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" type="text" name="introduction" placeholder="簡介" >{{$supplier->introduction}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-warning">提交訊息</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <div class=" img-preview-frame text-center" >
                                                <input type="file" name="name_card" id="name_card"  onchange="showPreview(this,['name_card_img'])" style="display: none;"/>
                                                <label for="name_card">
                                                    <img id="name_card_img" class="rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{$supplier->name_card? asset($supplier->name_card):asset('images/default/avatars/avatar.jpg')}}" width="200px">
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @include('theme.cryptoadmin.member.supplier.supplierContact.md-index',['supplier' => $supplier])
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



@extends(config('theme.staff.staff-app'))

@section('title','個人信息')

@section('content')
<div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h3>
                    個人訊息
                </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard"></i>首頁</a></li>
                    <li class="breadcrumb-item"><a href="#">staffs</a></li>
                    <li class="breadcrumb-item active">staffs Profile</li>
                </ol>
            </div>

            <!-- Main content -->
            <section class="content">
                <form method="post" action="{{route('staff.staff.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            @include(config('theme.staff.view').'layouts.errors')
                        </div>
                        <div class="col-xl-12 col-lg-12 text-right mb-5">
                            <button class="btn btn-primary" type="submit" ><i class="fa fa-floppy-o"></i></button>
                            <a class="btn btn-warning" href="{{route('staff.staff.create')}}" ><i class="fa fa-plus"></i></a>
                            <a class="btn btn-danger" href="{{route('staff.staff.staff_list')}}" ><i class="fa fa-arrow-left"></i></a>
                        </div>
                        {{--個人信息--}}
                        <div class="col-xl-12 col-lg-12">
                            <div class="box box-solid box-inverse box-dark">
                                <div class="box-header with-border">
                                    <h3 class="box-title">個人信息</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Barcode</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="id_code" placeholder="Barcode" value="{{old('id_code')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">修改者</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="pic" placeholder="修改者" value="{{old('pic')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">部門</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" disabled value="">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">員工編號</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="staff_code" placeholder="使用者名稱" value="{{old('staff_code')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">啟用</label>
                                                <div class="col-sm-1">
                                                    <input class="form-control" type="text" name="is_active" placeholder="使用者名稱" value="{{old('is_active')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">鎖定</label>
                                                <div class="col-sm-1">
                                                    <input class="form-control" type="text" name="is_block" placeholder="使用者名稱" value="{{old('is_block')}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">姓名</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="name" placeholder="姓名" data-mask required data-validation-required-message="必填欄位" value="{{old('name')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">性別</label>
                                                <div class="col-sm-1">
                                                    <input class="form-control" type="text" name="sex" placeholder="Sex" value="{{old('sex')}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">介紹人</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="introduced_by"  value="{{old('introduced_by')}}">
                                                </div>

                                                <label class="col-sm-2 col-form-label">面試主管</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="interviewed_by" data-mask required data-validation-required-message="必填欄位" value="{{old('interviewed_by')}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">身份字號</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="identify_code" placeholder="身份字號" data-mask required data-validation-required-message="必填欄位" value="{{old('identify_code')}}">
                                                </div>

                                                <label class="col-sm-2 col-form-label">生日</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="birthday" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask required data-validation-required-message="必填欄位" value="{{old('birthday')}}">
                                                </div>
                                            </div>
                                        </div>

                                        {{--大頭照--}}
                                        <div class="col-3">
                                            <div class="form-group row pull-right">
                                                <div class="img-preview-frame text-center" >
                                                    <input type="file" name="avatar" id="avatar"  onchange="showPreview(this,['avatar_img'])" style="display: none;"/>
                                                    <label for="avatar">
                                                        <img id="avatar_img" class="rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{asset('theme/cryptoadmin/images/avatar/1.jpg')}}" width="200')px">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        {{--面試日期/入職日期/社保--}}
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">面試日期</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="interview_at" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{old('interview_at')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">入職日期</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="join_at" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{old('join_at')}}">
                                                </div>

                                            </div>
                                        </div>

                                        {{--申請離職/離職日期--}}
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">社保日期</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="social_security_at" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{old('social_security_at')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">申請離職</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="apply_for_leave_at" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{old('apply_for_leave_at')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">離職日期</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="leave_at" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{old('leave_at')}}">
                                                </div>
                                            </div>
                                        </div>

                                        {{--郵箱--}}
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">郵箱</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="email" value="{{old('email')}}" placeholder="郵箱">
                                                </div>
                                            </div>
                                        </div>

                                        {{--聯繫方式1--}}
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">電話1</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="tel1" placeholder="電話1" value="{{old('tel1')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">手機1</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="phone1" placeholder="手機1" value="{{old('phone1')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">戶籍地址</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="address_fix" placeholder="戶籍地址" value="{{old('address_fix')}}">
                                                </div>
                                            </div>
                                        </div>

                                        {{--聯繫方式2--}}
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">電話2</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="tel2" placeholder="電話2" value="{{old('tel2')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">手機2</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="phone2" placeholder="手機2" value="{{old('phone2')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">目前地址</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="address_current" placeholder="目前地址" value="{{old('address_current')}}">
                                                </div>
                                            </div>
                                        </div>

                                        {{--備註--}}
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">備註</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" type="text" name="note" placeholder="備註">{{old('note')}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        {{--提交--}}
                                        <div class="col-12">
                                            <div class="form-group row pull-right">
                                                <label class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-warning">提交訊息</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--證件--}}
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="box box-solid box-inverse box-dark">
                                <div class="box-header with-border">
                                    <h3 class="box-title">證件</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="col-md-12 m-0">
                                    {{--身分證正面--}}
                                        <div class="img-preview-frame" style="display: inline;" >
                                            <input type="file" name="photo_id1" id="photo_id1"  onchange="showPreview(this,['photo_id1_img'])" style="display: none;"/>
                                            <label for="photo_id1">
                                                <img id="photo_id1_img" class="rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{asset('theme/cryptoadmin/images/avatar/1.jpg')}}" width="200')px">
                                            </label>
                                        </div>
                                    {{--身分證反面--}}
                                        <div class="img-preview-frame" style="display: inline;" >
                                            <input type="file" name="photo_id2" id="photo_id2"  onchange="showPreview(this,['photo_id2_img'])" style="display: none;"/>
                                            <label for="photo_id2">
                                                <img id="photo_id2_img" class="rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{asset('theme/cryptoadmin/images/avatar/1.jpg')}}" width="200')px">
                                            </label>
                                        </div>
                                    {{--健康檢查表--}}
                                        <div class="img-preview-frame" style="display: inline;" >
                                            <input type="file" name="medical_check" id="medical_check"  onchange="showPreview(this,['medical_check_img'])" style="display: none;"/>
                                            <label for="medical_check">
                                                <img id="medical_check_img" class="rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{asset('theme/cryptoadmin/images/avatar/1.jpg')}}" width="200')px">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{--學歷--}}
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="box box-solid box-inverse box-dark">
                                <div class="box-header with-border">
                                    <h3 class="box-title">學歷</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">起始日期</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="education1_from" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{old('education1_from')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">離職日期</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="education1_to" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{old('education1_to')}}">
                                                </div>
                                                <label class="col-sm-1 col-form-label">學校</label>
                                                <div class="col-sm-3">
                                                    <input class="form-control" type="text" name="school1_name" value="{{old('school1_name')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">起始日期</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="education2_from" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{old('education2_from')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">離職日期</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="education2_to" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{old('education2_to')}}">
                                                </div>
                                                <label class="col-sm-1 col-form-label">學校</label>
                                                <div class="col-sm-3">
                                                    <input class="form-control" type="text" name="school2_name" value="{{old('school2_name')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group row pull-right">
                                                <label class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-warning">提交訊息</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--經歷--}}
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="box box-solid box-inverse box-dark">
                                <div class="box-header with-border">
                                    <h3 class="box-title">經歷</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">起始日期</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="experience1_from" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{old('experience1_from')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">離職日期</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="experience1_to" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{old('experience1_to')}}">
                                                </div>
                                                <label class="col-sm-1 col-form-label">公司</label>
                                                <div class="col-sm-3">
                                                    <input class="form-control" type="text" name="company1_name" value="{{old('company1_name')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">起始日期</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="experience2_from" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{old('experience2_from')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">離職日期</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="experience2_to" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{old('experience2_to')}}">
                                                </div>
                                                <label class="col-sm-1 col-form-label">公司</label>
                                                <div class="col-sm-3">
                                                    <input class="form-control" type="text" name="company2_name" value="{{old('company2_name')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group row pull-right">
                                                <label class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-warning">提交訊息</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--緊急聯絡人--}}
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="box box-solid box-inverse box-dark">
                                <div class="box-header with-border">
                                    <h3 class="box-title">聯繫人</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">聯繫人1</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="contact1" placeholder="聯繫人1" value="{{old('contact1')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">電話1</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="contact_tel1" placeholder="電話1" value="{{old('contact_tel1')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">手機1</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="contact_phone1"  placeholder="手機1" value="{{old('contact_phone1')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">聯繫人2</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="contact2" placeholder="聯繫人2" value="{{old('contact2')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">電話2</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="contact_tel2" placeholder="電話2" value="{{old('contact_tel2')}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">手機2</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="contact_phone2" placeholder="手機2"  value="{{old('contact_phone2')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group row pull-right">
                                                <label class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-warning">提交訊息</button>
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
<script src="{{asset('js/images.js')}}"></script>
@endsection



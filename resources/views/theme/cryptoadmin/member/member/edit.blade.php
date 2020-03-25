@extends(config('theme.member.member-app'))

@section('title','個人訊息')

@section('content')
<div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h3>
                    個人訊息
                </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard"></i>首頁</a></li>
                    <li class="breadcrumb-item"><a href="#">Members</a></li>
                    <li class="breadcrumb-item active">Members Profile</li>
                </ol>
            </div>

            <!-- Main content -->
            <section class="content">
                <form method="post" action="{{route('member.update', ['member'=>$member->id])}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            @include(config('theme.member.view').'layouts.errors')
                        </div>
                        {{--個人照片--}}
                        <div class="col-xl-4 col-lg-5">
                            <!-- Profile Image -->
                            <div class="box bg-warning bg-deathstar-dark">
                                <div class="box-body box-profile">
                                    <div class="img-preview-frame text-center" >
                                        <input type="file" name="avatar" id="avatar"  onchange="showPreview(this,['avatar_img'])" style="display: none;"/>
                                        <label for="avatar">
                                            <img id="avatar_img" class="rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{$member->avatar? asset($member->avatar):asset('theme/cryptoadmin/images/2.jpg')}}" width="200px">
                                        </label>
                                    </div>

                                    <h2 class="profile-username text-center mb-0">{{$member->name}}</h2>

                                    <h4 class="text-center mt-0"><i class="fa fa-envelope-o mr-10"></i>{{$member->email}}</h4>
                                    <h5 class="text-center mt-0">加入時間 : {{$member->created_at->diffForHumans()}}</h5>
                                    <div class="row social-states">
                                        <div class="col-6 text-right"><a href="#" class="link text-white"><i class="ion ion-ios-people-outline"></i> 254</a></div>
                                        <div class="col-6 text-left"><a href="#" class="link text-white"><i class="ion ion-images"></i> 54</a></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box -->
                        </div>
                        {{--相關訊息--}}
                        <div class="col-xl-8 col-lg-7">
                            <div class="box box-solid box-inverse box-dark">
                                <div class="box-header with-border">
                                    <h3 class="box-title">個人信息</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">使用者名稱</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="name" placeholder="使用者名稱" value="{{$member->name}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">郵箱地址</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="email" value="{{$member->email}}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">電話號碼</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="tel" name="phone" placeholder="電話號碼">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">生日</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="birthday" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{$member->birthday}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">自我介紹</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" type="text" name="introduction" placeholder="自我介紹">{{$member->introduction}}</textarea>
                                                </div>
                                            </div>





                                            <div class="form-group row">
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
                {{--更改密碼--}}
                <form method="post" action="{{route('member.update_password', ['member'=>$member->id])}}" >
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-xl-8 offset-xl-4 col-lg-8 offset-lg-4">
                            <div class="box box-solid box-inverse box-dark">
                                <div class="box-header with-border">
                                    <h3 class="box-title">密碼</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">舊密碼</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="old_password" placeholder="新密碼" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">新密碼</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="new_password" placeholder="新密碼" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">再次確認密碼</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="new_password_confirmation" placeholder="再次確認密碼" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
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
            <!-- /.content -->

        </div>
@stop

@section('js')
@parent
<script src="{{asset('js/images.js')}}"></script>
@endsection



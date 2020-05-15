@extends(config('theme.admin.admin-app'))

@section('title','個人訊息')

@section('content')
<div class="container-full">
       
        <section class="content">
            <form method="post" action="{{route('admin.adminPermission.update', ['adminPermission' => $permission->id])}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        @include(config('theme.staff.view').'layouts.errors')
                    </div>
                    <div class="col-xl-12 col-lg-12 text-right mb-5">
                        <a class="btn btn-warning" href="{{route('admin.adminPermission.index')}}" ><i class="fa fa-list"></i></a>
                        @include(config('theme.staff.btn.edit.crud'))
                    </div>
                    {{--個人信息--}}
                    <div class="col-xl-12 col-lg-12">
                        <div class="box box-solid box-inverse box-dark">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">GuardName</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="guard_name" placeholder="Barcode" value="{{$permission->guard_name}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">權限名稱</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="name" placeholder="修改者" value="{{$permission->name}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">描述</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" type="text" name="description" placeholder="描述">{{$permission->description}}</textarea>
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


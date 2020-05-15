@extends(config('theme.admin.admin-app'))

@section('title','員工列表')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                會員列表
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="#">staffs</a></li>
                <li class="breadcrumb-item active">staffs List</li>
            </ol>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table itable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>頭像</th>
                                            <th>名稱</th>
                                            <th>角色</th>
                                            <th>權限</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($staffs as $staff)
                                        <tr>
                                            <td class="w-20 text-center">{{$loop->iteration}}</td>
                                            <td class="w-60">
                                                <a class="avatar avatar-lg status-success" href="#">
                                                    <img src="{{$staff->avatar}}">
                                                </a>
                                            </td>
                                            <td class="w-200">{{$staff->name}}</td>
                                            <td>
                                                @foreach($staff->roles as $role)
                                                    {{$role->name}}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($staff->getPermissionsViaRoles() as $permission)
                                                    {{$permission->name}}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a class="btn btn-warning" href="{{route('admin.adminStaffRolePermission.edit', ['adminStaffRolePermission'=> $staff->id])}}"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class=""> {{$staffs->links("pagination::bootstrap-4")}}</div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->

    </div>
@stop

@section('js')
    @parent
    <script type="text/javascript">
        $(function(){
            $bt_switch = $('.bt-switch');
            $bt_switch.bootstrapSwitch('toggleState');
        })
    </script>

@endsection





@extends(config('theme.admin.admin-app'))

@section('title','會員列表')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                會員列表
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="#">Members</a></li>
                <li class="breadcrumb-item active">Members List</li>
            </ol>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="d-none">
                                            <th>check</th>
                                            <th>頭像</th>
                                            <th>郵件</th>
                                            <th></th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($members as $member)
                                        <tr>
                                            <td class="w-20 text-center">{{$loop->iteration}}</td>
                                            <td class="w-60">
                                                <a class="avatar avatar-lg status-success" href="#">
                                                    <img src="{{$member->avatar}}">
                                                </a>
                                            </td>
                                            <td class="w-300">
                                                <p class="mb-0">
                                                    <a href="#"><strong>{{$member->name}}</strong></a><br>
                                                    <small class="">{{$member->email}}</small><br>
                                                    <small class="">登入次數 : {{$member->member_logs_count}}, 上次登入 : {{$member->updated_at->diffForHumans()}}</small>


                                                </p>
                                            </td>
                                            <td>
                                                <input type="checkbox" class="bt-switch" name="is_active"  value="1" {{$member->is_active===1? "checked": ""}}
                                                       data-label-width="100%"
                                                       data-label-text="啟用"
                                                       data-on-text="On"    data-on-color="primary"
                                                       data-off-text="Off"  data-off-color="danger"/>
                                            </td>
                                            <td>
                                                <nav class="nav mt-2">
                                                    <a class="nav-link" href="#"><i class="fa fa-facebook"></i></a>
                                                    <a class="nav-link" href="#"><i class="fa fa-twitter"></i></a>
                                                    <a class="nav-link" href="#"><i class="fa fa-github"></i></a>
                                                    <a class="nav-link" href="#"><i class="fa fa-linkedin"></i></a>
                                                </nav>
                                            </td>
                                            <td>
                                                <nav class="nav mt-2">
                                                    <a class="nav-link" href="#">{{$member->admin? $member->admin->name: "自動註冊"}}</a>
                                                </nav>
                                            </td>
                                            <td>
                                                <a class="btn btn-warning" href="{{route('admin.member.edit', ['member'=> $member->id])}}"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class=""> {{$members->links("pagination::bootstrap-4")}}</div>
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





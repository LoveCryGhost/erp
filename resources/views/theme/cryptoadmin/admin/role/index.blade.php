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
								<table class="itable">
									<thead>
										<tr>
											<th>No</th>
											<th>Guard</th>
											<th>權限名稱</th>
											<th>描述</th>
											<th>更改時間</th>
											<th>建立時間</th>
											<th>操作</th>
										</tr>
									</thead>
									<tbody>
										@foreach($roles as $role)
										<tr>
											<td>{{$loop->iteration}}</td>
											<td>{{$role->guard_name}}</td>
											<td>
												<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-right"
												        onclick="show_all_permissions(this, php_inject={{json_encode(['models' => ['role' => $role]])}})">
													{{$role->name}}
												</button>
											</td>
											<td>{{$role->description}}</td>
											<td>{{$role->updated_at->format('Y-m-d')}}</td>
											<td>{{$role->created_at->format('Y-m-d')}}</td>
											<td>
												<a href="{{route('admin.adminRole.edit', ['adminRole'=>$role->id])}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection

@section('js')
@parent
<script type="text/javascript">
    $(function() {
        $('.infinite-scroll').jscroll({
            // 当滚动到底部时,自动加载下一页
            autoTrigger: true,
            // 限制自动加载, 仅限前两页, 后面就要用户点击才加载
            autoTriggerUntil: 0,
            // 设置加载下一页缓冲时的图片
            loadingHtml: '<div class="text-center"><img class="center-block" src="{{asset('images/default/icons/loading.gif')}}" alt="Loading..." /><div>',
            padding: 0,
            nextSelector: 'a.jscroll-next:last',
            contentSelector: 'div.infinite-scroll',
            callback: function () {
                float_image(className = "item-image", x = 90, y = -10)
            }
        });
    });

    function show_all_permissions(_this, php_inject) {
        role = php_inject.models.role;
        $.ajaxSetup(active_ajax_header());
        $.ajax({
            type: 'get',
            url: '{{route('admin.adminRole.showAllPermission')}}?role_id='+role.id,
            data: '',
            async: true,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#modal-right .modal-title').html('所有權限 - 列表');
                $('#modal-right .modal-body').html(data.view)
            },
            error: function(data) {
            }
        });
    }

</script>
@endsection





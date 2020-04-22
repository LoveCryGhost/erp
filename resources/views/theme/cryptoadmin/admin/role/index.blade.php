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
											<td>{{$role->name}}</td>
											<td>{{$role->updated_at->format('Y-m-d')}}</td>
											<td>{{$role->created_at->format('Y-m-d')}}</td>
											<td>
												<a href="{{route('admin.role.edit', ['role'=>$role->id])}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
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
@endsection





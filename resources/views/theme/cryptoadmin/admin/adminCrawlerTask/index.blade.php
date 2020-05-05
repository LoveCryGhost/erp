@extends(config('theme.admin.admin-app'))

@section('title','CrawlerTask')

@section('content')
	<div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<h3>
				爬蟲任務 - 列表
			</h3>
{{--			<ol class="breadcrumb">--}}
{{--				<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>--}}
{{--				<li class="breadcrumb-item"><a href="#">staffs</a></li>--}}
{{--				<li class="breadcrumb-item active">staffs List</li>--}}
{{--			</ol>--}}
		</div>
		
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="box">
						<div class="box-body">
							<div class="table-responsive">
								<div class="infinite-scroll">
									<table class="itable">
										<thead>
											<tr class="">
												<th class="w-30">No</th>
												<th class="w-30">建立者</th>
												<th class="w-100">任務名稱</th>
												<th class="w-100">區域</th>
												<th class="w-100">國家</th>
												<th class="w-20">頁數</th>
												<th class="w-20">資料筆數</th>
											</tr>
										</thead>
									<tbody>
										@foreach($crawlerTasks as $crawlerTask)
										<tr>
											<td>{{($crawlerTasks->currentPage()-1)*($crawlerTasks->perPage()) + $loop->iteration}}</td>
											<td>{{$crawlerTask->member->name}}</td>
											<td>{{$crawlerTask->ct_name}}</td>
											<td>{{$crawlerTask->domain_name}}</td>
											<td>{{$crawlerTask->local}}</td>
											<td>{{$crawlerTask->pages}}</td>
											<td>{{$crawlerTask->crawlerItems->count()}}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
									{{--点击加载下一页的按钮--}}
									<div class="text-center">
										{{--判断到最后一页就终止, 否则 jscroll 又会从第一页开始一直循环加载--}}
										@if( $crawlerTasks->currentPage() == $crawlerTasks->lastPage())
											<span class="text-center text-muted">{{__('default.index.lazzyload_no_more_records')}}</span>
										@else
											{{-- 这里调用 paginator 对象的 nextPageUrl() 方法, 以获得下一页的路由 --}}
											<a class="jscroll-next btn btn-outline-secondary btn-block rounded-pill" href="{{ $crawlerTasks->appends($filters)->nextPageUrl() }}">
												{{__('default.index.lazzyload_more_records')}}
											</a>
										@endif
									</div>
								</div>
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
	<script src="{{asset('js/jscroll.min.js')}}"></script>
	<script type="text/javascript">
        $(function() {
            $('.infinite-scroll').jscroll({
                // 当滚动到底部时,自动加载下一页
                autoTrigger: true,
                // 限制自动加载, 仅限前两页, 后面就要用户点击才加载
                autoTriggerUntil: 2,
                // 设置加载下一页缓冲时的图片
                loadingHtml: '<div class="text-center"><img class="center-block" src="{{asset('images/default/icons/loading.gif')}}" alt="Loading..." /><div>',
                padding: 0,
                nextSelector: 'a.jscroll-next:last',
                contentSelector: '.infinite-scroll',
                callback:function() {
                    float_image(className="item-image", x=90, y=-10)
                }
            });
        });
	</script>
@endsection





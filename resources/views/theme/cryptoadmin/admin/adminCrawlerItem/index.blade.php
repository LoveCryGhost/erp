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
								<div class="">{{$crawlerItem_total}} 比數</div>
								<div class="infinite-scroll">
									<table class="itable">
										<thead>
											<tr class="">
												<th class="w-30">No</th>
												<th class="w-100">商品名稱</th>
												<th>連接任務數量</th>
												<th>歷史銷量</th>
											</tr>
										</thead>
									<tbody>
										@foreach($crawlerItems as $crawlerItem)
										<tr>
											<td>{{($crawlerItems->currentPage()-1)*($crawlerItems->perPage()) + $loop->iteration}}</td>
											<td class="text-left">{{$crawlerItem->name}}</td>
											<td>{{$crawlerItem->crawlerTasks->count()}}</td>
											<td>{{number_format($crawlerItem->historical_sold,0,"",",")}}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
									{{--点击加载下一页的按钮--}}
									<div class="text-center">
										{{--判断到最后一页就终止, 否则 jscroll 又会从第一页开始一直循环加载--}}
										@if( $crawlerItems->currentPage() == $crawlerItems->lastPage())
											<span class="text-center text-muted">{{__('default.index.lazzyload_no_more_records')}}</span>
										@else
											{{-- 这里调用 paginator 对象的 nextPageUrl() 方法, 以获得下一页的路由 --}}
											<a class="jscroll-next btn btn-outline-secondary btn-block rounded-pill" href="{{ $crawlerItems->appends($filters)->nextPageUrl() }}">
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





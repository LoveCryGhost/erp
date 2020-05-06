@extends(config('theme.member.member-app'))

@section('title','CrawlerSearch')

@section('content')
	<div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<h3>
				Shopee 全球 ccc - 列表
			</h3>
		</div>
		
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="box">
						<div class="box-header">
							<form class="form-control m-b-0 bg-color-lightblue">
								<div class="row">
								<div class="col-md-12">
									<div class="row">
										<label class="col-sm-1 col-form-label">{{__('member/crawlerItemSearch.index.search.name')}}</label>
										<div class="col-sm-2">
											<input class="form-control" type="text" name="name" placeholder="{{__('member/crawlerItemSearch.index.search.name')}}" value="{{request()->name}}">
										</div>
										<label class="col-sm-1 col-form-label">{{__('member/crawlerItemSearch.index.search.price')}}</label>
										<div class="col-sm-4 form-control">
											<input class="w-200" style="width: auto;" type="text" name="price_min" placeholder="{{__('member/crawlerItemSearch.index.search.price_min')}}" value="{{request()->price_min}}"> ~
											<input class="w-200" style="width: auto;" type="text" name="price_max" placeholder="{{__('member/crawlerItemSearch.index.search.price_max')}}" value="{{request()->price_max}}">
										</div>
									</div>
									<div class="row">
										{{--最低周銷量--}}
										<label class="col-sm-1 col-form-label">{{__('member/crawlerItemSearch.index.search.sold')}}</label>
										<div class="col-sm-2">
											<input class="form-control"  type="text" name="sold" placeholder="{{__('member/crawlerItemSearch.index.search.sold')}}" value="{{request()->sold}}">
										</div>
										
										{{--最低歷史銷量--}}
										<label class="col-sm-1 col-form-label">{{__('member/crawlerItemSearch.index.search.historical_sold')}}</label>
										<div class="col-sm-2">
											<input class="form-control"  type="text" name="historical_sold" placeholder="{{__('member/crawlerItemSearch.index.search.historical_sold')}}" value="{{request()->historical_sold}}">
										</div>
									
									</div>
									
									<div class="row">
										<div class="col-6">
											<a href="{{route('member.crawlerItemSearch.index')}}" class="form-control btn btn-sm btn-primary">{{__('member/crawlerItemSearch.index.search.reset')}}</a>
										</div>
										<div class="col-6">
											<button type="submit" class="form-control btn btn-sm btn-primary" name="submit['submit_get']" value="submit_get">{{__('member/crawlerItemSearch.index.search.submit')}}</button>
										</div>
									</div>
								</div>
							</div>
							</form>
						</div>
						<div class="box-body">
							<div class="table-responsive">
								<div class="pull-right">{{number_format($crawlerItem_total,0, "", ",")}} 筆數</div>
								<div class="infinite-scroll">
									<table class="itable">
										<thead>
											<tr>
												<th class="w-30">No</th>
												<th>照片</th>
												<th>商品名稱</th>
												<th class="w-50">售價(低)</th>
												<th class="w-50">售價(高)</th>
												<th>歷史銷量</th>
											</tr>
										</thead>
									<tbody>
										@foreach($crawlerItems as $crawlerItem)
										<tr>
											<td>{{($crawlerItems->currentPage()-1)*($crawlerItems->perPage()) + $loop->iteration}}</td>
											<td>
												@if($crawlerItem->images==null)
													<img src="{{asset('images/default/avatars/avatar.jpg')}}" class="item-image"><br>
												@else
													<img src="https://cf.{{$crawlerItem->domain_name}}/file/{{$crawlerItem->images}}_tn" class="item-image"><br>
												@endif
											</td>
											<td class="text-left">
												{!! str_replace(request()->name, "<span class='text-red'><u><b>".request()->name.'</b></u></span>',$crawlerItem->name)!!}<br>
												<a class="btn btn-sm btn-info" target="_blank"
												   href="https://{{$crawlerItem->domain_name}}/{{$crawlerItem->name==null? "waiting-upload-data":$crawlerItem->name}}-i.{{$crawlerItem->shopid}}.{{$crawlerItem->itemid}}" >
													<i class="fa fa-external-link"></i> {{$crawlerItem->itemid}}</a>
												<a class="btn btn-sm btn-info" target="_blank"
												   href="https://{{$crawlerItem->domain_name}}/shop/{{$crawlerItem->shopid}}" >
													<i class="fa fa-shopping-bag"></i> {{$crawlerItem->crawlerShop->username}}</a>
											</td>
											<td>{{number_format($crawlerItem->crawlerItemSKUs->min('price')/10, 0,".",",")}}</td>
											<td>{{number_format($crawlerItem->crawlerItemSKUs->max('price')/10, 0,".",",")}}</td>
											<td class="text-left">
												{{__('member/crawlerItem.index.table.information.monthly_sale')}} : {{number_format($crawlerItem->sold,0,".",",")}}<br>
												{{__('member/crawlerItem.index.table.information.historic_sale')}} : {{number_format($crawlerItem->historical_sold,0,".",",")}}<br>
												{{__('member/crawlerItem.index.table.updated_at')}} : {{$crawlerItem->updated_at!=null? $crawlerItem->updated_at->diffForHumans() : ""}}<br>
											</td>
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





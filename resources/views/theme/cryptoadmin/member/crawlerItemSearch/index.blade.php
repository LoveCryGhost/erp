@extends(config('theme.member.member-app'))

@section('title','CrawlerSearch')

@section('content')
	<div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<h3>
				Shopee 全球 - 列表
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
										
										{{--國家--}}
										<label class="col-sm-1 col-form-label">{{__('member/crawlerItemSearch.index.search.country')}}</label>
										<div class="col-sm-1">
											<input type="checkbox" class="" name="local[tw]"  id="local_tw" value="tw" {{isset(request()->local['tw'])?  "checked":""}}>
											<label for="local_tw" class="text-dark m-t-5 ">{{__('member/crawlerItemSearch.index.search.language.tw')}}</label>
										</div>
										<div class="col-sm-1">
											<input type="checkbox" class="permission_check" name="local[id]"  id="local_id" value="id" {{isset(request()->local['id'])?  "checked":""}}>
											<label for="local_id" class="text-dark m-t-5">{{__('member/crawlerItemSearch.index.search.language.id')}}</label>
										</div>
										<div class="col-sm-1">
											<input type="checkbox" class="permission_check" name="local[th]"  id="local_th" value="th" {{isset(request()->local['th'])?  "checked":""}}>
											<label for="local_th" class="text-dark m-t-5">{{__('member/crawlerItemSearch.index.search.language.th')}}</label>
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
								<div class="pull-right"> {{number_format($crawlerItem_total_updated,0, "", ",")}} / {{number_format($crawlerItem_total_records,0, "", ",")}}
									{{__('member/crawlerItemSearch.index.search.records')}}
									@if($crawlerItem_total_records>0)
										({{number_format(($crawlerItem_total_updated/$crawlerItem_total_records)*100, 1,".",",")}} %)
									@endif
								</div>
								<div class="infinite-scroll">
									<table class="itable">
										<thead>
											<tr>
												<th>No</th>
												<th>{{__('member/crawlerItemSearch.index.table.image')}}</th>
												<th width="40%">{{__('member/crawlerItemSearch.index.table.productName')}}</th>
												<th>{{__('member/crawlerItemSearch.index.table.price_min')}}</th>
												<th>{{__('member/crawlerItemSearch.index.table.price_max')}}</th>
												<th>{{__('member/crawlerItemSearch.index.table.sales')}}</th>
												<th>{{__('member/crawlerItemSearch.index.table.sku')}}</th>
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
												
												{{--標註提醒--}}
												@php
													$inputs = explode(',', request()->name);
													$name = $crawlerItem->name;
													foreach($inputs as $input){
												     	$input= trim($input);
												     	if($input!=""){
															$name = str_replace($input, "<span class='text-red'><u><b>".$input.'</b></u></span>',$name);
														}
													}
												@endphp
												{!! $name!!}<br>
												
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
												{{__('member/crawlerItemSearch.index.table.information.monthly_sale')}} : {{number_format($crawlerItem->sold,0,".",",")}}<br>
												{{__('member/crawlerItemSearch.index.table.information.historic_sale')}} : {{number_format($crawlerItem->historical_sold,0,".",",")}}<br>
												{{__('member/crawlerItemSearch.index.table.updated_at')}} : {{$crawlerItem->updated_at!=null? $crawlerItem->updated_at->diffForHumans() : ""}}<br>
											</td>
											
											<td>
												<a class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-left"
												   onclick="show_crawler_item_skus(this, php_inject={{json_encode(['models' => ['crawlerItem' => $crawlerItem]])}})"> {{__('member/crawlerItemSearch.index.table.skuDetailBtn')}}</a>
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
                autoTriggerUntil: 1,
                // 设置加载下一页缓冲时的图片
                loadingHtml: '<div class="text-center"><img class="center-block" src="{{asset('images/default/icons/loading.gif')}}" alt="Loading..." /><div>',
	            //设置距离底部多远时开始加载下一页
                padding: 0,
                nextSelector: 'a.jscroll-next:last',
                contentSelector: '.infinite-scroll',
                callback:function() {
                    float_image(className="item-image", x=90, y=-10)
                }
            });
        });

        function show_crawler_item_skus(_this, php_inject) {
            $.ajaxSetup(active_ajax_header());
            $.ajax({
                type: 'get',
                url: '{{route('member.crawlerItem-crawlerItemSku.index')}}?ci_id='+php_inject.models.crawlerItem.ci_id,
                data: '',
                async: true,
                crossDomain: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#modal-left .modal-title').html('{{__('member/crawlerItem.sku_detail.title')}}');
                    $('#modal-left .modal-body').html(data.view)
                },
                error: function(data) {
                }
            });
        }
	</script>
	
@endsection





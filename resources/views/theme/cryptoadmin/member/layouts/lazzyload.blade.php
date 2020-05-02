<div class="text-center">
    {{--判断到最后一页就终止, 否则 jscroll 又会从第一页开始一直循环加载--}}
    @if( $supplierGroups->currentPage() == $supplierGroups->lastPage())
        <span class="text-center text-muted">{{__('default.index.lazzyload_no_more_records')}}</span>
    @else
        {{-- 这里调用 paginator 对象的 nextPageUrl() 方法, 以获得下一页的路由 --}}
        <a class="jscroll-next btn btn-outline-secondary btn-block rounded-pill" href="{{ $supplierGroups->appends($filters)->nextPageUrl() }}">
            {{__('default.index.lazzyload_no_more_records')}}
        </a>
    @endif
</div>


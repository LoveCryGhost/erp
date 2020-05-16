@extends(config('theme.member.member-app'))

@section('title','供應商 - 群組列表')

@section('content-header','')
@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                {{__('member/supplierGroup.index.title')}}
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="#">Members</a></li>
                <li class="breadcrumb-item active">Members List</li>
            </ol>
        </div>

        <section class="content">
            <div class="box">
                {{--搜尋--}}
                <div class="box-header">
                    <div class="row">
                        <div class="col">
                            <form class="form-control m-b-0">
                            
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <h5>Barcode</h5>
                                    <div class="controls">
                                        <input class="form-control" type="text" name="id_code" placeholder="Barcode" value="{{request()->id_code}}">
                                    </div>
                                </div>
    
                                <div class="col-sm-3 form-group">
                                    <h5>{{__('member/supplierGroup.index.search.supplierGroupName')}}</h5>
                                    <div class="controls">
                                        <input class="form-control" type="text" name="sg_name" placeholder="{{__('member/supplierGroup.index.search.supplierGroupName')}}" value="{{request()->sg_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{route('member.supplierGroup.index')}}" class="form-control btn btn-sm btn-primary btn-rounded">{{__('member/supplierGroup.index.search.reset')}}</a>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="form-control btn btn-sm btn-primary btn-rounded" name="submit['submit_get']" value="submit_get">{{__('member/supplierGroup.index.search.submit')}}</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

                {{--主頁--}}
                <div class="box-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 text-right">
                            @include(config('theme.member.btn.index.crud'))
                        </div>
                        <div class="col">
                            <div class="table-responsive">
                                <div class="infinite-scroll">
                                    <table class="itable">
                                        <thead>
                                        <tr>
                                            <th>{{__('member/supplierGroup.index.table.no')}}</th>
                                            <th>{{__('member/supplierGroup.index.table.barcode')}}</th>
                                            <th>{{__('member/supplierGroup.index.table.nameCard')}}</th>
                                            <th>{{__('member/supplierGroup.index.table.supplierGroupName')}}</th>
                                            <th>{{__('member/supplierGroup.index.table.is_active')}}</th>
                                            <th>{{__('member/supplierGroup.index.table.information')}}</th>
                                            <th>{{__('member/supplierGroup.index.table.action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($supplierGroups as $supplierGroup)
                                            <tr>
                                                <td class="w-20 text-center">{{$loop->iteration}}</td>
                                                <td>{{$supplierGroup->id_code}}</td>
                                                <td>
                                                    <img  class="name_card rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{$supplierGroup->name_card? asset($supplierGroup->name_card):asset('images/default/avatars/avatar.jpg')}}" width="200px">
                                                </td>
                                                <td class="w-200">
                                                    <p class="mb-0">
                                                        <a href="#"><strong>{{$supplierGroup->sg_name}}</strong></a><br>
                                                    </p>
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="permission_check" name="is_active" id="is_active"
                                                           {{$supplierGroup->is_active===1? "checked": ""}} disabled>
                                                    <label for="is_active" class="p-0 m-0"></label>
                                                </td>
                                                <td>
                                                    <p class="mb-0">
                                                        <small> {{__('member/supplierGroup.index.table.pic')}}: {{$supplierGroup->member->name}}</small><br>
                                                    </p>
                                                </td>
                                                <td>
                                                    @include(config('theme.member.btn.index.table_tr'),['id' => $supplierGroup->sg_id])
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{--点击加载下一页的按钮--}}
                                    @include('theme.cryptoadmin.member.layouts.lazzyload', [ 'supplierGroups' => $supplierGroups])
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
        
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




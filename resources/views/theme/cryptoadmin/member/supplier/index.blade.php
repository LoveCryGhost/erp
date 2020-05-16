@extends(config('theme.member.member-app'))

@section('title',__('member/supplier.index.title'))

@section('content-header','')
@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                {{__('member/supplier.index.title')}}
            </h3>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="col-xl-12 col-lg-12 text-right mb-5">
                                @include(config('theme.member.btn.index.crud'))
                            </div>
                            <div class="table-responsive">
                                <table class="itable table">
                                    <thead>
                                    <tr>
                                        <th>{{__('member/supplier.index.table.no')}}</th>
                                        <th>{{__('member/supplier.index.table.barcode')}}</th>
                                        <th>{{__('member/supplier.index.table.nameCard')}}</th>
                                        <th>{{__('member/supplier.index.table.supplierName')}}</th>
                                        <th>{{__('member/supplier.index.table.is_active')}}</th>
                                        <th>{{__('member/supplier.index.table.information')}}</th>
                                        <th>{{__('member/supplier.index.table.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($suppliers as $supplier)
                                        <tr>
                                            <td class="w-20 text-center">{{$loop->iteration}}</td>
                                            <td>{{$supplier->id_code}}</td>
                                            <td>
                                                <img  class="name_card rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{$supplier->name_card? asset($supplier->name_card):asset('images/default/avatars/avatar.jpg')}}" width="200px">
                                            </td>
                                            <td class="w-200">
                                                <p class="mb-0">
                                                    <a href="#"><strong>{{$supplier->s_name}}</strong></a><br>
                                                </p>
                                            </td>
                                            <td>
                                                <input type="checkbox" class="permission_check" name="is_active" id="is_active"
                                                       {{$supplier->is_active===1? "checked": ""}} disabled>
                                                <label for="is_active" class="p-0 m-0"></label>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <small>{{__('member/supplier.index.table.pic')}} : {{$supplier->member->name}}</small><br>
                                                </p>
                                            </td>
                                            <td>
                                                @include(config('theme.member.btn.index.table_tr'),['id' => $supplier->s_id])
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class=""> {{$suppliers->links("pagination::bootstrap-4")}}</div>
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
<script type="text/javascript">
$(function(){
    active_switch(switch_class='bt-switch', options=[]);
})
</script>
@endsection




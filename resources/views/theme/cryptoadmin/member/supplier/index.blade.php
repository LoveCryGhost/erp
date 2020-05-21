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
                        <div class="box-header">
                            <div class="row">
                                <div class="col">
                                    <form class="form-control m-b-0 member-crud-search-form">
                                        <div class="row">
                                            <div class="col-sm-3 form-group">
                                                <h5>{{__('default.index.table.barcode')}}</h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="id_code" placeholder="Barcode" value="{{request()->id_code}}">
                                                </div>
                                            </div>
    
                                            <div class="col-sm-3 form-group">
                                                <h5>{{__('member/supplier.index.search.supplierGroupName')}}</h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="sg_name" placeholder="{{__('member/supplier.index.search.supplierGroupName')}}" value="{{request()->sg_name}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 form-group">
                                                <h5>{{__('member/supplier.index.search.supplierName')}}</h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="s_name" placeholder="{{__('member/supplier.index.search.supplierName')}}" value="{{request()->s_name}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 form-group">
                                                <h5>{{__('default.index.search.contactPerson')}}</h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="sc_name" placeholder="{{__('default.index.search.contactPerson')}}" value="{{request()->sc_name}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 form-group">
                                                <h5>{{__('default.index.search.tel')}}</h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="tel" placeholder="{{__('default.index.search.tel')}}" value="{{request()->tel}}">
                                                </div>
                                            </div>
        
                                            <div class="col-sm-3 form-group">
                                                <h5>{{__('default.index.search.phone')}}</h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="phone" placeholder="{{__('default.index.search.phone')}}" value="{{request()->phone}}">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="{{route('member.supplier.index')}}" class="form-control btn btn-sm btn-primary">{{__('member/supplierGroup.index.search.reset')}}</a>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="form-control btn btn-sm btn-primary" name="submit['submit_get']" value="submit_get">{{__('member/supplierGroup.index.search.submit')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                                        
                                        <th>{{__('member/supplier.index.table.contactPerson')}}</th>
                                        <th>{{__('member/supplier.index.table.pic')}}</th>
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
                                                <strong><a href="#">{{$supplier->s_name}}</a></strong>
                                                <p>{{$supplier->supplierGroup->sg_name}}</p>
                                            </td>
                                            <td>
                                                <input type="checkbox" class="permission_check" name="is_active" id="is_active"
                                                       {{$supplier->is_active===1? "checked": ""}} disabled>
                                                <label for="is_active" class="p-0 m-0"></label>
                                            </td>
                                            <td class="text-left">
                                                @foreach($supplier->all_supplierContacts as $contact)
                                                    {{$contact->sc_name}} / {{$contact->tel}} / {{$contact->phone}}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    {{$supplier->member->name}}
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




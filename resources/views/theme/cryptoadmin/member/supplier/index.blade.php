@extends(config('theme.member.member-app'))

@section('title','供應商 - 列表')

@section('content-header','')
@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                供應商 - 列表
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="#">Members</a></li>
                <li class="breadcrumb-item active">Members List</li>
            </ol>
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
                                <table class="table table-hover">
                                    <thead>
                                    <tr class="d-none">
                                        <th>check</th>
                                        <th>Barcode</th>
                                        <th>名片</th>
                                        <th>名稱</th>
                                        <th>操作</th>
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
                                                <input type="checkbox" class="bt-switch" name="is_active"  value="1" {{$supplier->is_active===1? "checked": ""}}
                                                data-label-width="100%"
                                                       data-label-text="啟用"
                                                       data-on-text="On"    data-on-color="primary"
                                                       data-off-text="Off"  data-off-color="danger"/>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <small>修改人 : {{$supplier->member->name}}</small><br>
                                                    <small>最後更新 : {{$supplier->updated_at->diffForHumans()}}</small>
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




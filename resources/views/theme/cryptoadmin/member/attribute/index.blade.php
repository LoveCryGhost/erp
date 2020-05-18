@extends(config('theme.member.member-app'))

@section('title', __('member/attribute.title'))

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
               {{__('member/attribute.title')}}
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
                                            <th>{{__('default.index.table.no')}}</th>
                                            <th>{{__('default.index.table.barcode')}}</th>
                                            <th>{{__('member/attribute.index.table.attribute')}}</th>
                                            <th>{{__('default.index.table.is_active')}}</th>
                                            <th>{{__('default.index.table.info')}}</th>
                                            <th>{{__('default.index.table.crud')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($attributes as $attribute)
                                        <tr>
                                            <td class="w-20 text-center">{{$loop->iteration}}</td>
                                            <td>{{$attribute->id_code}}</td>
                                            <td class="w-300">
                                                <p class="mb-0">
                                                    <a href="#"><strong>{{$attribute->a_name}}</strong></a><br>
                                                </p>
                                            </td>
                                            <td>
                                                <input type="checkbox" class="permission_check" name="is_active" id="is_active"
                                                       {{$attribute->is_active===1? "checked": ""}} disabled>
                                                <label for="is_active" class="p-0 m-0"></label>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <small>{{__('default.index.table.createdBy')}} : {{$attribute->member->name}}</small><br>
                                                </p>
                                            </td>

                                            <td>
                                                @include(config('theme.member.btn.index.table_tr'),['id' => $attribute->a_id])
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class=""> {{$attributes->links("pagination::bootstrap-4")}}</div>
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
    <script type="text/javascript">
        $(function(){
            $bt_switch = $('.bt-switch');
            $bt_switch.bootstrapSwitch('toggleState');
        })
    </script>

@endsection





<div class="box box-solid box-inverse box-dark">
    <div class="box-header  p-5">
        <h5 class="box-title m-0">產品類型</h5>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modal-md"
                   onclick="event.preventDefault();
                           md_type_attribute_create(this, php_inject={{json_encode(['models'=>[]])}});">
                    <i class="fa fa-plus"></i></a>
            </div>
            <div class="col-12">
                <table class="table table-bordered table-hover" id="tbl-type-attribute">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>排序</th>
                            <th>Barcode</th>
                            <th>屬性</th>
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(isset($type))
                            @foreach($type->attributes as $attribute)
                                <tr class="handle" data-md-id="{{$attribute->a_id}}">
                                    <td>
                                        <span class="handle" style="cursor: move;">
                                            <i class="fa fa-ellipsis-v"></i>
                                            <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                    </td>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$attribute->id_code}}
                                        <input name="a_ids[]" hidden value="{{$attribute->a_id}}">
                                    </td>
                                    <td>{{$attribute->a_name}}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-md"
                                           onclick="event.preventDefault();
                                                   md_type_attribute_edit(this, php_inject={{json_encode(['models'=>['type' => $type, 'attribute' => $attribute]])}});">
                                            <i class="fa fa-edit mr-5"></i>編輯
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                           onclick="event.preventDefault();
                                                   md_type_attribute_delete(this, php_inject={{json_encode(['models'=>['type' => $type, 'attribute' => $attribute]])}});">
                                            <i class="fa fa-trash mr-5"></i>刪除
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@section('js')
@parent
@yield('jss')
<script type="text/javascript">
    $(function () {
        //排序表格
        active_table_sortable(table_id="tbl-type-attribute", eq_order_index=1, options={});
        //Switch
        active_switch(switch_class='bt-switch', options=[]);
    });

    function md_type_attribute_create(_this,  php_inject){
        $.ajaxSetup(active_ajax_header());
        $.ajax({
            type: 'get',
            url: '{{route('member.type-attribute.create')}}',
            data: '',
            async: true,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#modal-md .modal-title').html('產品 - 屬性');
                $('#modal-md .modal-body').html(data.view);

                //插入排序value
                $('#tbl-type-attribute tbody tr').each(function ($index) {
                    input_a_id = $(this).children('td:eq(2)').find('input').attr('name','a_ids[]');
                })
            },
            error: function(data) {
            }
        });
    }

    function md_type_attribute_edit(_this,  php_inject){
        $.ajaxSetup(active_ajax_header());
        $.ajax({
            type: 'get',
            url: '{{route('member.type-attribute.index')}}/'+php_inject.models.attribute.a_id+'/edit',
            data: '',
            async: true,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#modal-md .modal-title').html('編輯 - 產品屬性');
                $('#modal-md .modal-body').html(data.view);
            },
            error: function(data) {
            }
        });
    }

    function md_type_attribute_delete(_this,  php_inject) {
        swal(swal_delete_info(), function(){
            swal("已經刪除!", "刪除成功", "success");

            var formData = new FormData();
            tr_delete = tr = $('#tbl-type-attribute tbody tr[data-md-id='+php_inject.models.attribute.a_id+']');
            formData.append('_method', 'delete');
            $.ajaxSetup(active_ajax_header());
            $.ajax({
                type: 'post',
                url: '{{route('member.type-attribute.index')}}/'+php_inject.models.attribute.a_id+'?t_id='+php_inject.models.type.t_id,
                data: formData,
                async: true,
                crossDomain: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    tr_delete.remove();
                },
                error: function(data) {
                }
            });
        });
    }
</script>
@endsection

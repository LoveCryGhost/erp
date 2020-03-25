<div class="box box-solid box-inverse box-dark">

    <div class="box-body">
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-md"
                   onclick="event.preventDefault();
                           md_type_attribute_store(this, php_inject={{json_encode([ 'models' => []])}});">
                    <i class="fa fa-save"></i></a>
            </div>
            <div class="col-12">
                {{--Select2--}}
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">產品屬性</label>
                    <div class="col-sm-9">
                        <select class="select2_item form-control" name="a_id" id="a_id">
                            <option value="">Select...</option>
                            @foreach($attributes as $attribute)
                                <option value="{{$attribute->a_id}}" >{{$attribute->id_code}} - {{$attribute->a_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">

    $(function () {
        active_select2(select2_class="select2_item", options={});

        //檢查是否有重複的Attribute & 並將其設定成Disable
        $('#tbl-type-attribute tbody tr').each(function () {
            select_a_id_val = $(this).children('td:eq(2)').find('input').val();
            $(".select2_item[id=a_id] option[value='"+select_a_id_val+"']").attr('disabled', 'disabled').append(' -- (Disabled)');
        });
    });

    function md_type_attribute_store(_this,  attributes){
        //若為空值，返回
        if($('#a_id').val() === ""){
            //關閉modal
            clean_close_modal(modal_id="modal-md");
            return false;
        }

        var formData = new FormData();
        formData.append('a_id', $('#a_id').val());

        $.ajaxSetup(active_ajax_header());
        $.ajax({
            type: 'post',
            url: '{{route('member.type-attribute.store')}}',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

                //關閉modal
                clean_close_modal(modal_id="modal-md");

                //只顯示, 不儲存
                if(data.models.attribute!=null) {
                    cursor_move = '<span class="handle" style="cursor: move;">' +
                        '      <i class="fa fa-ellipsis-v"></i>' +
                        '      <i class="fa fa-ellipsis-v"></i>' +
                        '</span>';
                    id_code = data.models.attribute.id_code +
                        '<input name="a_ids[]" hidden value="' + data.models.attribute.a_id + '">';

                    models = {"models":{"attribute": data.models.attribute}};
                    crud =  '<a class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-md"' +
                        '                                           onclick="event.preventDefault();' +
                        '                                                   md_type_attribute_edit(this, php_inject=models);">' +
                        '                                            <i class="fa fa-edit mr-5"></i>編輯</a> '+
                        '<a class="btn btn-danger btn-sm" '+
                        'onclick="event.preventDefault();md_type_attribute_delete(this, php_inject=models);">'+
                        '<i class="fa fa-trash mr-5"></i>刪除</a>';

                    html = '<tr data-md-id="'+ data.models.attribute.a_id+'"><td>' + cursor_move + '</td><td></td><td>' + id_code + '</td><td>' + data.models.attribute.a_name + '</td><td>'+crud+'</td></tr>';
                    $('#tbl-type-attribute tbody').append(html);

                    //Table重新排序
                    active_table_tr_reorder_nth(table_id = "tbl-type-attribute", eq_order_index = 1);
                }
            },
            error: function(data) {
            }
        });
    }
</script>

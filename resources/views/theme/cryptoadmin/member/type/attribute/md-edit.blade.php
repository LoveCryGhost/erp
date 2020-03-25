<div class="box box-solid box-inverse box-dark">

    <div class="box-body">
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-md"
                   onclick="event.preventDefault();
                           md_type_attribute_update(this, php_inject={{json_encode([ 'models' => ['attribute' => $attribute]])}});">
                    <i class="fa fa-save"></i></a>
            </div>
            <div class="col-12">
                {{--Select2--}}
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">產品屬性</label>
                    <div class="col-sm-9">
                        <select class="select2_item form-control" name="a_id" id="a_id">
                            <option data-md-id="">Select...</option>
                            @foreach($attributes as $attr)
                                @if($attr->a_id == $attribute->a_id)
                                    <option value="{{$attr->a_id}}" selected disabled="disabled" data-md-id="{{$attr->a_id}}">{{$attr->id_code}} - {{$attr->a_name}} -- (Disabled)</option>
                                @else
                                    <option value="{{$attr->a_id}}" data-md-id="{{$attr->a_id}}" >{{$attr->id_code}} - {{$attr->a_name}}</option>
                                @endif
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

    function md_type_attribute_update(_this,  php_inject){
        a_id = $('#a_id').find(':selected').data('md-id');
        //先判別更改的是否等於原先設定 或是 空值
        if(php_inject.models.attribute.a_id===a_id || $('#a_id').find(':selected').data('md-id')=== ""){
            //關閉modal
            clean_close_modal(modal_id="modal-md");
            return false;
        }

        var formData = new FormData();
        formData.append('a_id', a_id);
        formData.append('_method', 'put');

        $.ajaxSetup(active_ajax_header());
        $.ajax({
            type: 'post',
            url: '{{route('member.type-attribute.index')}}/'+ a_id,
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                //關閉modal
                clean_close_modal(modal_id="modal-lg");

                //新增增加的
                cursor_move = '<span class="handle" style="cursor: move;">' +
                    '                                        <i class="fa fa-ellipsis-v"></i>' +
                    '                                        <i class="fa fa-ellipsis-v"></i>' +
                    '                                  </span>';
                id_code = data.models.attribute.id_code +
                            '<input name="a_ids[]" hidden value="'+ data.models.attribute.a_id+'">';
                a_name = data.models.attribute.a_name;

                models = {"models":{"attribute": data.models.attribute}};
                crud_btn = '<a  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-md"'+
                                'onclick="event.preventDefault();'+
                                'md_type_attribute_edit(this, php_inject=models)">'+
                                '<i class="fa fa-edit mr-5"></i>編輯</a> ';
                crud_btn+=  '<a class="btn btn-danger btn-sm" ' +
                            '  onclick="event.preventDefault();' +
                            '          md_type_attribute_delete(this, php_inject=models);">' +
                            '   <i class="fa fa-trash mr-5"></i>刪除</a>';
                html='<tr data-md-id="'+data.models.attribute.a_id+'"><td>'+cursor_move+'</td><td></td><td>'+id_code+'</td><td>'+a_name+'</td><td>'+crud_btn+'</td></tr>';

                //輸出
                tr = $('#tbl-type-attribute tbody tr[data-md-id='+php_inject.models.attribute.a_id+']');
                tr.after(html);

                //移除
                tr.remove();


                //排序
                $('#tbl-type-attribute tbody tr').each(function ($index) {
                    input_a_id = $(this).children('td:eq(2)').find('input').attr('name','a_ids[]');
                    $(this).children('td:eq(1)').html($index+1);
                })

            },
            error: function(data) {
                master_detail_errors(_this, data);
            }
        });
    }
</script>

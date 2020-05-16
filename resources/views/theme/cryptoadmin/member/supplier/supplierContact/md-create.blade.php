<div class="box box-solid ">
    <div class="box-body">
        @include(config('theme.admin.view').'layouts.modal-errors')
        <div class="row">
            <div class="col-12">
                @include(config('theme.member.view').'layouts.errors')
                <div class="form-group">
                    <h5>{{__('member/supplier.supplierContact.create.contactName')}}</h5>
                    <div class="controls">
                        <input class="form-control" type="text" name="sc_name" id="sc_name"  placeholder="{{__('member/supplier.supplierContact.create.contactName')}}"  value="">
                    </div>
                </div>
    
                <div class="form-group">
                    <h5>{{__('member/supplier.supplierContact.create.tel')}}</h5>
                    <div class="controls">
                        <input class="form-control" type="text" name="tel" id="tel"  placeholder="{{__('member/supplier.supplierContact.create.tel')}}"  value="">
                    </div>
                </div>
                <div class="form-group">
                    <h5>{{__('member/supplier.supplierContact.create.phone')}}</h5>
                    <div class="controls">
                        <input class="form-control" type="text" name="phone" id="phone"  placeholder="{{__('member/supplier.supplierContact.create.phone')}}"  value="">
                    </div>
                </div>
                <div class="form-group">
                    <h5>{{__('member/supplier.supplierContact.create.introduction')}}</h5>
                    <div class="controls">
                        <textarea class="form-control" type="text" name="introduction" id="introduction"  placeholder="{{__('member/supplier.supplierContact.create.introduction')}}"  ></textarea>
                    </div>
                </div>
            </div>
           
            <div class="col-6">
                <button type="button" class="btn btn-danger form-control" data-dismiss="modal">Close</button>
            </div>
            <div class="col-6">
                <a href="#" class="btn btn-primary form-control"
                   onclick="event.preventDefault();
                           md_supplier_contact_store(this, php_inject={{json_encode([ 'models' => ['supplier' => $supplier]])}});">
                    <i class="fa fa-save"></i></a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    function md_supplier_contact_store(_this,  php_inject){
        var formData = new FormData();
        formData.append('s_id', php_inject.models.supplier.s_id);
        formData.append('sc_name', $('#sc_name').val());
        formData.append('tel', $('#tel').val());
        formData.append('phone', $('#phone').val());
        formData.append('introduction', $('#introduction').val());
        $.ajaxSetup(active_ajax_header());
        $.ajax({
            type: 'post',
            url: '{{route('member.supplier-contact.store')}}',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                //關閉modal
                clean_close_modal(modal_id="modal-lg");

                //新增列
                cursor_move = '<span class="handle" style="cursor: move;">' +
                    '      <i class="fa fa-ellipsis-v"></i>' +
                    '      <i class="fa fa-ellipsis-v"></i>' +
                    '</span>';
                sc_name = data.request.sc_name;
                sort_order  =   '<input text="type" name="supplier_contacts[ids][]" hidden value="'+data.models.supplierContact.sc_id+'">'+
                                '<input text="type" name="supplier_contacts[sc_name][]" hidden value="'+data.models.supplierContact.sc_name+'">';
                models = {"models":{"supplier": data.models.supplier, "supplierContact":data.models.supplierContact}};
                crud =  '<a class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-lg"' +
                        '                                           onclick="event.preventDefault();' +
                        '                                                   md_supplier_contact_edit(this, php_inject=models);">' +
                        '                                            <i class="fa fa-edit mr-5"></i>編輯</a>'+
                        '<a class="btn btn-danger btn-sm" '+
                        'onclick="event.preventDefault();md_supplier_contact_delete(this, php_inject=models);">'+
                        '<i class="fa fa-trash mr-5"></i>刪除</a>';
                html='<tr class="handle" data-md-id="'+data.models.supplierContact.sc_id+'"><td>'+cursor_move+'</td><td></td><td>'+sc_name+sort_order+'</td><td>'+null_to_empty(data.models.supplierContact.tel)+'</td><td>'+null_to_empty(data.models.supplierContact.phone)+'</td><td>'+crud+'</td></tr>';

                //輸出
                $('#tbl-supplier-contact tbody').append(html);

                //Table重新排序
                active_table_tr_reorder_nth(table_id="tbl-supplier-contact", eq_order_index=1);
            },
            error: function(data) {
                master_detail_errors(_this, data);
            }
        });
    }
</script>

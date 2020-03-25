<div class="box box-solid box-inverse box-dark">
    <div class="box-body">
        @include(config('theme.admin.view').'layouts.modal-errors')
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-primary"
                   onclick="event.preventDefault();
                       md_staff_department_store(this, php_inject={{json_encode(['models'=>['staff'=>$staff]])}});">
                    <i class="fa fa-save"></i></a>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">轉調部門</label>
                    <div class="col-sm-10">
                        <select  class="form-control" id="d_id">
                            @foreach($staffDepartments as $staffDepartment)
                                <option value="{{$staffDepartment->d_id}}">
                                    @if($staffDepartment->parent==null)
                                        {{$staffDepartment->name}}
                                    @else
                                        {{$staffDepartment->parent->name}} - {{$staffDepartment->name}}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">轉調起始日期</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="start_at"
                               data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{date('Y-m-d')}}">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">獎金</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="bonus" placeholder="bonus"
                               value="0">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">建立者</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="created_by" disabled placeholder="created_by"
                               value="{{Auth::guard('staff')->user()->name}}">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">更改者</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="modified_by" disabled placeholder="modified_by"
                               value="{{Auth::guard('staff')->user()->name}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(function () {

    });

    function md_staff_department_store(_this,  php_inject) {

        var formData = new FormData();
        formData.append('st_id', {{$data['st_id']}});
        _d_id =$('#d_id').find(':selected').val();
        formData.append('d_id', _d_id);

        formData.append('start_at', $('#start_at').val());
        formData.append('bonus', $('#bonus').val());

        $.ajaxSetup(active_ajax_header());
        $.ajax({
            type: 'post',
            url: "{{route('staff.staff-department.index')}}?st_id={{$data['st_id']}}" ,
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

                //關閉modal
                clean_close_modal(modal_id="modal-lg");


                //最後一筆資料為最新資料
                _length = data.models.staff.staff_departments.length;
                staff_department = data.models.staff.staff_departments[_length-1];

                models = {"models":{"staff": data.models.staff}};

                //顯示到modal left
                cursor_move = '<span class="handle" style="cursor: move;">' +
                    '                                        <i class="fa fa-ellipsis-v"></i>' +
                    '                                        <i class="fa fa-ellipsis-v"></i>' +
                    '                                  </span>';
                crud_btn = '<a  class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-lg"'+
                    'onclick="event.preventDefault();'+
                    'md_staff_department_edit(this, php_inject=models)">'+
                    '<i class="fa fa-edit mr-5"></i>編輯</a> ';


                models = {"models":{"staff": data.models.staff, "staffDepartment": data.models.staffDepartment},"options":{"sd_id":staff_department.pivot.sd_id}}
                crud_btn = crud_btn +
                '<a class="btn btn-warning btn-sm" ' +
                '                                          onclick="event.preventDefault(); md_staff_department_destroy(this, php_inject=models);">' +
                '                                           <i class="fa fa-trash mr-5"></i>刪除' +
                '                                       </a>'
                if(staff_department.parent === null){
                    staff_department_name = staff_department.name;
                }else{
                    staff_department_name = staff_department.parent.name + "-" + staff_department.name;
                }

                html='<tr data-sd-id="'+ staff_department.pivot.sd_id+ '"><td>'+cursor_move+'</td><td></td><td>'+staff_department_name+'</td><td>'+
                    staff_department.pivot.bonus+'</td><td>'+staff_department.pivot.start_at+'</td><td>'+"{{Auth::guard('staff')->user()->name}}"+
                    '</td><td>'+"{{Auth::guard('staff')->user()->name}}"+'</td><td>'+crud_btn+'</td></tr>';


                //輸出
                tr = $('#tbl-staff-staff_department tbody').append(html);

                //Table重新排序
                active_table_tr_reorder_nth(table_id="tbl-staff-staff_department", eq_order_index=1);
            },
            error: function(data) {
                master_detail_errors(_this, data);
            }
        });
    }
</script>

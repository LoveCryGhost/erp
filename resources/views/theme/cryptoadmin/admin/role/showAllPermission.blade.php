
<div >
	{{$role->guard_name}} / {{$role->name}}
</div>
<div >
	{{$role->description}}
</div>

<div class="myadmin-dd-empty dd" id="nestable2">
	<ol class="dd-list">
		<li class="dd-item dd3-item" data-id="13">
			<div class="dd-handle dd3-handle"></div>
			<div class="dd3-content"> Item 13 </div>
		</li>
		<li class="dd-item dd3-item" data-id="14">
			<div class="dd-handle dd3-handle"></div>
			<div class="dd3-content"> Item 14 </div>
		</li>
		<li class="dd-item dd3-item" data-id="14">
			<div class="dd-handle dd3-handle"></div>
			<div class="dd3-content"> Item 16 </div>
		</li>
		<li class="dd-item dd3-item" data-id="14">
			<div class="dd-handle dd3-handle"></div>
			<div class="dd3-content"> Item 17 </div>
		</li>
		<li class="dd-item dd3-item" data-id="14">
			<div class="dd-handle dd3-handle"></div>
			<div class="dd3-content"> Item 18 </div>
		</li>
		<li class="dd-item dd3-item" data-id="14">
			<div class="dd-handle dd3-handle"></div>
			<div class="dd3-content"> Item 19 </div>
		</li>
		<li class="dd-item dd3-item" data-id="15">
			<div class="dd-handle dd3-handle"></div>
			<div class="dd3-content"> Item 15 </div>
			<ol class="dd-list">
				<li class="dd-item dd3-item" data-id="16">
					<div class="dd-handle dd3-handle"></div>
					<div class="dd3-content"> Item 16 </div>
				</li>
				<li class="dd-item dd3-item" data-id="17">
					<div class="dd-handle dd3-handle"></div>
					<div class="dd3-content"> Item 17 </div>
				</li>
				<li class="dd-item dd3-item" data-id="18">
					<div class="dd-handle dd3-handle"></div>
					<div class="dd3-content"> Item 18 </div>
				</li>
			</ol>
		</li>
	</ol>
</div>

<table class="itable">
	<thead>
	
		<tr>
			<th>No.</th>
			<th>Guard</th>
			<th>權限名稱</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($permissions as $permission)
		<tr>
			<td>{{$loop->iteration}}</td>
			<td>{{$permission->guard_name}}</td>
			<td class="text-left">{{$permission->name}}</td>
			<td>
				<div class="checkbox">
					<input type="checkbox" class="permission_check" name="{{$permission->name}}" id="permission_{{$permission->id}}"
							{{$role->hasPermissionTo($permission->name)? "checked":""}}
							onclick="assignPermissionToRole(this, php_inject={{json_encode(['models' => ['role' => $role, 'permission'=>$permission]])}})">
					<label for="permission_{{$permission->id}}" class="text-dark"></label>
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<!--Nestable js -->


<script>
	
	function assignPermissionToRole(_this, php_inject) {
	    role = php_inject.models.role;
        permission = php_inject.models.permission;
        $.ajaxSetup(active_ajax_header());
        var formData = new FormData();
        formData.append('role_id', role.id);
        formData.append('permission_id', permission.id);
        $.ajax({
            type: 'post',
            url: '{{route('admin.adminRole.assignPermissionToRole')}}',
            data: formData,
            async: true,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {
				
            },
            error: function(data) {
            }
        });
    }
    
    $(function () {
		$('.permission_check').click(function(){
		    _permiision_name = $(this).attr('name');
			//選取
			if($(this).is(':checked')){
				//是select_all => 字串包含.*
                if (_permiision_name.toLowerCase().indexOf(".*") >= 0){
                    _permission_route = _permiision_name.replace(".*", "");
					_lth = $('input.permission_check[name^="'+_permission_route+'."]').prop('checked', true);
					
                //不是select_all
                }else{
                    //先處理name字串
                    _permission_route="";
                    _permiision_name_arr = _permiision_name.split('.');
                    for(var i=0; i<_permiision_name_arr.length-1; i++){
                        _permission_route+= _permiision_name_arr[i]+'.';
                    }
                    //刪除最後一個字元
                    _permission_route = _permission_route.substr(0, _permission_route.length - 1);
                    //檢查有多少個同組子元素(非.*)
	                $els = $('input.permission_check[name^="'+_permission_route+'."][name!="'+_permission_route+'.*"]');
	                $elements_length = $els.length;
	                $elements_checked_length = $('input.permission_check[name^="'+_permission_route+'."][name!="'+_permission_route+'.*"]:checked').length;
	                
	                //全選
	                if($elements_length==$elements_checked_length){
                        $('input.permission_check[name^="'+_permission_route+'.*"]').prop('checked',true);
	                }
                }
                
            //取消
			}else{
				//是select_all => 字串包含.*
                if (_permiision_name.toLowerCase().indexOf(".*") >= 0){
                    _permission_route = _permiision_name.replace(".*", "");
                    $('input.permission_check[name^="'+_permission_route+'."]').prop('checked', false);
                    
                //不是select_all
                }else{
					//先處理name字串
                    _permission_route="";
                    _permiision_name_arr = _permiision_name.split('.');
                    for(var i=0; i<_permiision_name_arr.length-1; i++){
                        _permission_route+= _permiision_name_arr[i]+'.';
                    }
                    //刪除最後一個字元
                    _permission_route = _permission_route.substr(0, _permission_route.length - 1);
                    //檢查有多少個同組子元素(非.*)
                    $els = $('input.permission_check[name^="'+_permission_route+'."][name!="'+_permission_route+'.*"]');
                    $elements_length = $els.length;
                    $elements_checked_length = $('input.permission_check[name^="'+_permission_route+'."][name!="'+_permission_route+'.*"]:checked').length;

                    //全選
                    if($elements_length!=$elements_checked_length){
                        $('input.permission_check[name^="'+_permission_route+'.*"]').prop('checked',false);
                    }
                }
            }
	    });
    })
</script>

<script src="{{asset('theme/cryptoadmin/vendor_components/nestable/jquery.nestable.js')}}"></script>
<script src="{{asset('theme/cryptoadmin/js/pages/nestable.js')}}"></script>
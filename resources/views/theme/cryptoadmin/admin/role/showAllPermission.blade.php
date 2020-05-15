
<div class="row">
	<div class="col-4">
		{{$role->guard_name}} / {{$role->name}}
	</div>
	<div class="col-4">
		{{$role->description}}
	</div>
	<div class="col-4 ">
		<textarea id="nestable_output" style="display: none;"></textarea>
		<button class="btn btn-success pull-right" onclick="update_nestable_order();">儲存</button>
	</div>
</div>


<div class="myadmin-dd-empty dd" id="permission_nestable">
	<ol class="dd-list">
		@foreach($permissions as $permission)
			@include('theme.cryptoadmin.admin.role.showPermissionParent', ['permission'=>$permission])
		@endforeach
	</ol>
</div>

<!--Nestable js -->
<script>
	
	function assignPermissionToRole(_this, php_inject) {
	    //可以用
	    //console.log($('#nestable_output').val());
        role_id = php_inject.role_id;
        permission_id = php_inject.permission_id;
        $.ajaxSetup(active_ajax_header());
        var formData = new FormData();
        formData.append('role_id', role_id);
        formData.append('permission_id', permission_id);
        // formData.append('nestable_output', $('#nestable_output').val());
        
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


<script>
   var update_nestable_order = function(){
       //可以用
       //console.log($('#nestable_output').val());
       role_id = php_inject.role_id;
       permission_id = php_inject.permission_id;
       $.ajaxSetup(active_ajax_header());
       var formData = new FormData();
       formData.append('nestable_output', $('#nestable_output').val());

       $.ajax({
           type: 'post',
           url: '{{route('admin.adminRole.update_nestable_order')}}',
           data: formData,
           async: true,
           crossDomain: true,
           contentType: false,
           processData: false,
           success: function(data) {
               clean_close_modal('modal-right');
           },
           error: function(data) {
           }
       });
   }
    
    $(function () {

        var updateOutput = function (e) {
            var list = e.length ? e : $(e.target)
                , output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
            }
            else {
                output.val('JSON browser support required for this demo.');
            }
        };
        $('#permission_nestable').nestable({
            group: 1
        }).on('change', updateOutput);
        updateOutput($('#permission_nestable').data('output', $('#nestable_output')));;
    })
</script>

<div >
	{{$role->guard_name}} / {{$role->name}}
</div>
<div >
	{{$role->description}}
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
					<input type="checkbox" name="permission_{{$permission->id}}" id="permission_{{$permission->id}}"
					  
							{{$role->hasPermissionTo($permission->name)? "checked":"--"}}
							onclick="assignPermissionToRole(this, php_inject={{json_encode(['models' => ['role' => $role, 'permission'=>$permission]])}})">
					<label for="permission_{{$permission->id}}" class="text-dark"></label>
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

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
</script>

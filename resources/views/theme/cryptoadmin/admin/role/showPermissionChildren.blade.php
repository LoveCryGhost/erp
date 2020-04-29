<li class="dd-item dd3-item" data-id="{{$permission->id}}" data-p_id="{{$permission->p_id}}">
	<div class="dd-handle dd3-handle"></div>
	<div class="dd3-content">
		<div class="row">
			<div class="col-10">
				({{$permission->id}} -- {{$permission->p_id}})  {{$permission->name}}<br>
				{{$permission->description}}
			</div>
			<div class="col-2">
				<input type="checkbox" class="permission_check" name="{{$permission->name}}" id="permission_{{$permission->id}}"
				       {{$role->hasPermissionTo($permission->name)? "checked":""}}
				       onclick="assignPermissionToRole(this, php_inject={{json_encode(['role_id' => $role->id, 'permission_id'=>$permission->id])}})">
				<label for="permission_{{$permission->id}}" class="text-dark p-0 m-0"></label>
			</div>
		</div>
	</div>
	<ol class="dd-list">
		@foreach($permission->children as $permission_children)
			@if($permission_children->children->count()==0)
				<li class="dd-item dd3-item" data-id="{{$permission_children->id}}" data-p_id="{{$permission_children->p_id}}">
					<div class="dd-handle dd3-handle"></div>
					<div class="dd3-content">
						<div class="row">
							<div class="col-10">
								({{$permission->id}} -- {{$permission->p_id}})  {{$permission_children->name}}<br>
								{{$permission_children->description}}
							</div>
							<div class="col-2">
								<input type="checkbox" class="permission_check" name="{{$permission_children->name}}" id="permission_{{$permission_children->id}}"
								       {{$role->hasPermissionTo($permission_children->name)? "checked":""}}
								       onclick="assignPermissionToRole(this, php_inject={{json_encode(['role_id' => $role->id, 'permission_id'=>$permission_children->id])}})">
								<label for="permission_{{$permission_children->id}}" class="text-dark p-0 m-0"></label>
							</div>
						</div>
				</li>
			@else
				@include('theme.cryptoadmin.admin.role.showPermissionChildren', ['permission'=>$permission_children])
			@endif
		@endforeach
	</ol>
</li>
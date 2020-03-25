@php
    $route_index = Route::current()->action['as'];
    $route_edit = str_replace('index','edit',$route_index);
    $route_destroy = str_replace('index','destroy',$route_index);
    $route_create = str_replace('index','create',$route_index);
    $route_param = str_replace("member.","", str_replace('.index',"",$route_index));
@endphp

<a class="btn btn-warning btn-sm"
   href="{{route($route_edit,
            [$route_param => $id])}}">
    <i class="fa fa-edit mr-5"></i>編輯</a>

<form action="{{route($route_destroy, [$route_param=> $id])}}" method="post"
      style="display: inline-block;"
      onsubmit="return confirm('您确定要删除吗？');">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-secondary btn-sm">
        <i class="fa fa-trash mr-5"></i>刪除
    </button>
</form>
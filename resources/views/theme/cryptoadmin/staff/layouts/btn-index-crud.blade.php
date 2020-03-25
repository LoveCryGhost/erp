@php
    $route_index = Route::current()->action['as'];
    $route_edit = str_replace('index','edit',$route_index);
    $route_destroy = str_replace('index','destroy',$route_index);
    $route_create = str_replace('index','create',$route_index);
    $route_param = str_replace("staff.","", str_replace('.index',"",$route_index));
@endphp

<a class="btn btn-warning" href="{{route($route_create)}}" ><i class="fa fa-plus"></i></a>

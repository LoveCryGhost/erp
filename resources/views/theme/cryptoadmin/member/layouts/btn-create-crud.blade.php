@php
    $route_create = Route::current()->action['as'];
    $route_index = str_replace('create','index',$route_create);
@endphp

<button class="btn btn-primary" type="submit" ><i class="fa fa-floppy-o"></i></button>
<a class="btn btn-warning" href="{{route($route_create)}}" ><i class="fa fa-plus"></i></a>
<a class="btn btn-danger" href="{{route($route_index)}}" ><i class="fa fa-arrow-left"></i></a>
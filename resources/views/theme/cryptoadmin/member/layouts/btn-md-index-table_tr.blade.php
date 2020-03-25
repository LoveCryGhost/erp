@php
    $route_param = str_replace('-','_',str_replace('member.','',$route_name));

    $route_edit = $route_name.'.edit';
    $route_destroy= $route_name.'.destroy';
@endphp


<a  class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-md"
   onclick="event.preventDefault();
           md_edit(this, php_inject={{json_encode(['m_id'  => $m_id ])}});">
    <i class="fa fa-edit mr-5"></i>編輯</a>
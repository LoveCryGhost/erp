@extends(config('theme.member.member-app'))

@section('title', __('member/attribute.edit.title'))

@section('content')
<div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h3>
                    {{__('member/attribute.index.title')}}
                </h3>
            </div>

            <!-- Main content -->
            <section class="content">
                <form method="post" action="{{route('member.attribute.update', ['attribute'=>$attribute->a_id])}}">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            @include(config('theme.member.view').'layouts.errors')
                        </div>

                        <div class="col-xl-12 col-lg-12 text-right mb-5">
                            @include(config('theme.member.btn.edit.crud'))
                        </div>
                        {{--相關訊息--}}
                        <div class="col-xl-12 col-lg-12">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <h5>{{__('default.edit.is_active')}}</h5>
                                                <div class="controls">
                                                    <input type="checkbox"  class="permission_check" name="is_active" value="1" id="is_active"
                                                            {{$attribute->is_active==1? "checked":""}} >
                                                    <label for="is_active" class="text-dark p-0 m-0"></label>
                                                </div>
                                            </div>
    
                                            <div class="form-group">
                                                <h5>{{__('default.edit.barcode')}}</h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="id_code" placeholder="Barcode" value="{{$attribute->id_code}}" disabled>
                                                </div>
                                            </div>
    
                                            <div class="form-group">
                                                <h5>{{__('member/attribute.edit.attributeName')}}</h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="a_name" placeholder="{{__('member/attribute.edit.attributeName')}}"  value="{{$attribute->a_name}}">
                                                </div>
                                            </div>
    
                                            <div class="form-group">
                                                <h5>{{__('default.edit.description')}}</h5>
                                                <div class="controls">
                                                    <textarea class="form-control" type="text" name="a_description" placeholder="{{__('default.edit.description')}}" >{{$attribute->a_description}}</textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="controls">
                                                    <button type="submit" class="btn btn-success form-control">{{__('default.edit.save')}}</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </form>

            </section>
            <!-- /.content -->

        </div>
@stop

@section('js')
    @parent
    <script type="text/javascript">
        $(function(){
            $bt_switch = $('.bt-switch');
            $bt_switch.bootstrapSwitch('toggleState', true);
        })
    </script>

@endsection



@extends(config('theme.member.member-app'))

@section('title','產品屬性')

@section('content')
<div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h3>
                    產品 - 屬性
                </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard"></i>首頁</a></li>
                    <li class="breadcrumb-item"><a href="#">Members</a></li>
                    <li class="breadcrumb-item active">Members Profile</li>
                </ol>
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
                            <div class="box box-solid box-inverse box-dark">
                                <div class="box-header with-border">
                                    <h3 class="box-title">產品屬性</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">啟用</label>
                                                <div class="col-sm-10">
                                                    <input type="checkbox" class="bt-switch" name="is_active"  value="1" {{$attribute->is_active==1? "checked": ""}}
                                                    data-label-width="100%"
                                                           data-label-text="啟用" data-size="min"
                                                           data-on-text="On"    data-on-color="primary"
                                                           data-off-text="Off"  data-off-color="danger"/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Barcode</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="id_code" placeholder="Barcode" value="{{$attribute->id_code}}" disabled>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">屬性名稱</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="a_name" placeholder="屬性名稱"  value="{{$attribute->a_name}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-warning">提交訊息</button>
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



@extends(config('theme.member.member-app'))

@section('title','新增 - 產品')

@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h3>
            新增 - 產品
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard"></i>首頁</a></li>
            <li class="breadcrumb-item"><a href="#">Members</a></li>
            <li class="breadcrumb-item active">Members Profile</li>
        </ol>
    </div>

    <!-- Main content -->
    <section class="content">
        <form method="post" action="{{route('member.product.store')}}">
            @csrf
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    @include(config('theme.member.view').'layouts.errors')
                </div>

                <div class="col-xl-12 col-lg-12 text-right mb-5">
                    @include(config('theme.member.btn.create.crud'))
                </div>
                {{--相關訊息--}}
                <div class="col-xl-12 col-lg-12">
                    <div class="box box-solid box-inverse box-dark">
                        <div class="box-header with-border">
                            <h3 class="box-title">新增產品</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">啟用</label>
                                        <div class="col-sm-10">
                                            <input type="checkbox" class="bt-switch" name="is_active"  value="1"
                                            data-label-width="100%"
                                                   data-label-text="啟用" data-size="min"
                                                   data-on-text="On"    data-on-color="primary"
                                                   data-off-text="Off"  data-off-color="danger"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Barcode</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text"  placeholder="Auto-Generate" disabled value="Auto-Generate !!">
                                        </div>
                                    </div>


                                    {{--產品類型--}}
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">產品類型</label>
                                        <div class="col-sm-10">
                                            <select class="select2_item form-control" name="t_id" required data-validation-required-message="必填欄位">
                                                {{--預設值--}}
                                                <option value="">Select...</option>
                                                @foreach($types as $type)
                                                    <option value="{{$type->t_id}}">{{$type->t_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">發布時間</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="publish_at" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{old('publish_at')}}">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">產品名稱</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="p_name" placeholder="產品名稱"  value="{{old('p_name')}}">
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
            //Select2
            active_select2(select2_class='select2_item', options={});
            //Switch
            active_switch(switch_class='bt-switch', options=[]);
        })
    </script>
@endsection



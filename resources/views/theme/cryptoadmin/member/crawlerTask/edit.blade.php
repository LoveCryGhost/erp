@extends(config('theme.member.member-app'))

@section('title','編輯 - Shopee任務')

@section('content')
<div class="container-full">
    <div class="content-header">
        <h3>
            編輯 - Shopee任務
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard"></i>首頁</a></li>
            <li class="breadcrumb-item"><a href="#">Members</a></li>
            <li class="breadcrumb-item active">Members Profile</li>
        </ol>
    </div>

    <!-- Main content -->
    <section class="content">
        <form method="post" action="{{route('member.crawlertask.update',['crawlertask' => $crawlertask->ct_id])}}">
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
                            <h3 class="box-title">編輯 - Shopee任務</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-12">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">最後更新時間</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" placeholder="最後更新時間" disabled value=" {{$crawlertask->updated_at==null? "": $crawlertask->updated_at->diffForHumans()}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">啟用</label>
                                        <div class="col-sm-10">
                                            <input type="checkbox" class="bt-switch" name="is_active"  value="1" {{$crawlertask->is_active==1? "checked" : ""}}
                                                data-label-width="100%"
                                                data-label-text="啟用" data-size="min"
                                                data-on-text="On"    data-on-color="primary"
                                                data-off-text="Off"  data-off-color="danger"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Barcode</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text"  placeholder="Auto-Generate" disabled value="{{$crawlertask->id_code}}" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">任務名稱</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="ct_name" placeholder="任務名稱"   value="{{$crawlertask->ct_name}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">網址</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="url" placeholder="網址" disabled value="{{$crawlertask->url}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">搜尋頁數</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="pages" placeholder="搜尋頁數" disabled value="{{$crawlertask->pages}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Domain</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="domain_name" placeholder="Domain" disabled  value="{{$crawlertask->domain_name}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">類別</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="cat" placeholder="類別" disabled  value="{{$crawlertask->cat}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">國家</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="local" placeholder="國家" disabled  value="{{$crawlertask->local}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">創建者</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" placeholder="創建者" disabled  value="{{$crawlertask->member->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">描述</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" type="text" name="description" placeholder="描述" >{{$crawlertask->description}}</textarea>
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
            active_switch(switch_class='bt-switch', options=[]);
        })
    </script>
@endsection



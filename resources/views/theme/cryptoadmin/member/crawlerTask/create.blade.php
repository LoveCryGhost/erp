@extends(config('theme.member.member-app'))

@section('title',__('member/crawlerTask.title'))

@section('content')
<div class="container-full">
    <div class="content-header">
        <h3>
            {{__('member/crawlerTask.edit.title')}}
        </h3>
{{--        <ol class="breadcrumb">--}}
{{--            <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard"></i>首頁</a></li>--}}
{{--            <li class="breadcrumb-item"><a href="#">Members</a></li>--}}
{{--            <li class="breadcrumb-item active">Members Profile</li>--}}
{{--        </ol>--}}
    </div>

    <!-- Main content -->
    <section class="content">
        <form method="post" action="{{route('member.crawlerTask.store')}}">
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
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.is_active')}}</label>
                                        <div class="col-sm-10">
                                            <input type="checkbox" class="permission_check" name="is_active" value="1" id="is_active"
                                                   checked disabled>
                                            <label for="is_active" class="text-dark p-0 m-0"></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.barcode')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text"  placeholder="{{__('member/crawlerTask.edit.auto_generate')}}" disabled value="{{__('member/crawlerTask.edit.auto_generate')}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.taskName')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="ct_name" placeholder="{{__('member/crawlerTask.edit.taskName')}}"  value="{{old('ct_name')}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.url')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="url" placeholder="{{__('member/crawlerTask.edit.url')}}"  value="{{old('url')}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.pages')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="pages" placeholder="{{__('member/crawlerTask.edit.pages')}}"  value="{{old('pages')}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.description')}}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" type="text" name="description" placeholder="{{__('member/crawlerTask.edit.description')}}" >{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-warning">{{__('member/crawlerTask.edit.submit')}}</button>
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

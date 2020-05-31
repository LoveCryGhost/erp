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
        <form method="post" action="{{route('member.crawlerTask.update',['crawlerTask' => $crawlerTask->ct_id])}}">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    @include(config('theme.member.view').'layouts.errors')
                </div>

                <div class="col-xl-12 col-lg-12 text-right mb-5">
                    <button class="btn btn-primary" type="submit" ><i class="fa fa-floppy-o"></i></button>
                    <a class="btn btn-warning" href="{{route('member.supplier.create')}}" ><i class="fa fa-plus"></i></a>
                    <a class="btn btn-danger" href="{{route('member.supplier.index')}}" ><i class="fa fa-arrow-left"></i></a>
                </div>
                {{--相關訊息--}}
                <div class="col-xl-12 col-lg-12">
                    <div class="box box-solid box-inverse box-dark">
                        <div class="box-header with-border">
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-12">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.updated_at')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" placeholder="{{__('member/crawlerTask.edit.updated_at')}}" disabled value=" {{$crawlerTask->updated_at==null? "": $crawlerTask->updated_at->diffForHumans()}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.is_active')}}</label>
                                        <div class="col-sm-10">
                                            <input type="checkbox" class="permission_check" name="is_active" value="1" id="is_active" disabled
                                                   {{$crawlerTask->is_active===1? "checked": ""}}>
                                            <label for="is_active" class="text-dark p-0 m-0"></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.barcode')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text"  placeholder="{{__('member/crawlerTask.edit.barcode')}}" disabled value="{{$crawlerTask->id_code}}" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.taskName')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="ct_name" placeholder="{{__('member/crawlerTask.edit.taskName')}}"   value="{{$crawlerTask->ct_name}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.url')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="url" placeholder="{{__('member/crawlerTask.edit.url')}}" disabled value="{{$crawlerTask->url}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.page')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="pages" placeholder="{{__('member/crawlerTask.edit.page')}}" disabled value="{{$crawlerTask->pages}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.domain')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="domain_name" placeholder="{{__('member/crawlerTask.edit.domain')}}" disabled  value="{{$crawlerTask->domain_name}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.category')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="cat" placeholder="{{__('member/crawlerTask.edit.category')}}" disabled  value="{{$crawlerTask->cat}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.local')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="local" placeholder="{{__('member/crawlerTask.edit.local')}}" disabled  value="{{$crawlerTask->local}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.author')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" placeholder="{{__('member/crawlerTask.edit.author')}}" disabled  value="{{$crawlerTask->member->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{__('member/crawlerTask.edit.description')}}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" type="text" name="description" placeholder="描述" >{{$crawlerTask->description}}</textarea>
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

@endsection



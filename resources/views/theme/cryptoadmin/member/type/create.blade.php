@extends(config('theme.member.member-app'))

@section('title',__('member/type.create.title'))

@section('content')
<div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h3>
                    {{__('member/type.create.title')}}
                </h3>
               
            </div>

            <!-- Main content -->
            <section class="content">
                <form method="post" action="{{route('member.type.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            @include(config('theme.member.view').'layouts.errors')
                        </div>

                        <div class="col-xl-12 col-lg-12 text-right mb-5">
                            @include(config('theme.member.btn.create.crud'))
                        </div>
                        <div class="col-xl-12 col-lg-12">
                            <div class="box box-solid ">
                                <div class="box-header with-border">
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <h5>{{__('default.create.is_active')}}</h5>
                                                <div class="controls">
                                                    <input type="checkbox"  class="permission_check" name="is_active" value="1" id="is_active"
                                                        {{old('is_active')==1? "checled":""}}
                                                    >
                                                    <label for="is_active" class="text-dark p-0 m-0"></label>
                                                </div>
                                            </div>
    
                                            <div class="form-group">
                                                <h5>{{__('default.edit.barcode')}}</h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="id_code" placeholder="{{__('default.create.autoGenerate')}}" value="{{old('id_code')}}" disabled>
                                                </div>
                                            </div>
    
                                            <div class="form-group">
                                                <h5>{{__('member/type.create.productTypeName')}}</h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="t_name" placeholder="{{__('member/type.edit.productTypeName')}}"  value="{{old('t_name')}}">
                                                </div>
                                            </div>
    
                                            <div class="form-group">
                                                <h5>{{__('default.create.description')}}</h5>
                                                <div class="controls">
                                                    <textarea class="form-control" type="text" name="t_description" placeholder="{{__('default.edit.description')}}" >{{old('t_description')}}</textarea>
                                                </div>
                                            </div>
    
                                            <div class="form-group">
                                                <div class="controls">
                                                    <button type="submit" class="btn btn-success form-control">{{__('default.edit.save')}}</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- Type - Attribute Detail --}}
                                    @include('theme.cryptoadmin.member.type.attribute.md-index', ['master_id' => 0 ])
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </section>
            <!-- /.content -->

        </div>
@stop




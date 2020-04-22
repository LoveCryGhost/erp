@extends(config('theme.staff.staff-app'))

@section('title','Excel - Like')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                Excel表
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="#">Members</a></li>
                <li class="breadcrumb-item active">Members List</li>
            </ol>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-12">
                    <div class="box">
                        <div class="box-body">
                            <div>
                                <a class="btn btn-warning" href="{{route('staff.excel_like.create')}}"><i class="fa fa-plus"></i></a>
                            </div>
                            @foreach($staffExcelLikes as $staffExcelLike)
                            <div class="pull-up">
                                <div class="col-4">
                                可操作:{{$staffExcelLike->is_active}}
                                可顯示:{{$staffExcelLike->showable}}
                                可編輯:{{$staffExcelLike->editable}}
                                描述:{{$staffExcelLike->description}}
                                </div>
                                <div class="col">
                                    編輯:<a href="{{route('staff.excel_like.edit',['excel_like'=>$staffExcelLike->id])}}"><i class="fa fa-edit"></i></a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

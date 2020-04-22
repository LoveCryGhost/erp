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
                        <div class="box-body div_overflow-x">
                            <div class="pull-right">
                                <a class="btn btn-warning" href="{{route('staff.staffExcelLike.create')}}"><i class="fa fa-plus"></i></a>
                            </div>
                            <table class="itable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>編碼</th>
                                        <th>標題</th>
                                        <th>啟用</th>
                                        <th>可顯示</th>
                                        <th>可編輯</th>
                                        <th>描述</th>
                                        
                                        <th>JQ</th>
                                        <th>Excel</th>
                                        
                                        <th>建立者</th>
                                        <th>使用者</th>
                                        <th>修改時間</th>
                                        <th>建立時間</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($staffExcelLikes as $staffExcelLike)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$staffExcelLike->id_code}}</td>
                                        <td>{{$staffExcelLike->title}}</td>
                                        <td>{{$staffExcelLike->is_active}}</td>
                                        <td>{{$staffExcelLike->showable}}</td>
                                        <td>{{$staffExcelLike->editable}}</td>
                                        <td>{{$staffExcelLike->description}}</td>
                                        
                                        <td>JQ</td>
                                        <td>Excel</td>
                                        <td>{{$staffExcelLike->staff->name}}</td>
                                        <td>Viewer</td>
                                        <td>{{$staffExcelLike->updated_at->format("Y-m-d H:t")}}</td>
                                        <td>{{$staffExcelLike->created_at->format("Y-m-d H:t")}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-success" href="{{route('staff.staffExcelLike.edit',
['staffExcelLike' => $staffExcelLike->id])}}"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

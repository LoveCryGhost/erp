@extends(config('theme.staff.staff-app'))

@section('title','控制台')

@section('css')

    <script src="https://jexcel.net/v4/jexcel.js"></script>
    <link rel="stylesheet" href="https://jexcel.net/v4/jexcel.css" type="text/css" />

    <script src="https://jexcel.net/v4/jsuites.js"></script>
    <link rel="stylesheet" href="https://jexcel.net/v4/jsuites.css" type="text/css" />

    <style type="text/css" media="screen">
        .ace-editor {
            min-height: 500px;
        }
    </style>
@endsection

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                Blank pagexx
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Sample Page</li>
                <li class="breadcrumb-item active">Blank page</li>
            </ol>
        </div>


        <!-- Main content -->
        <section class="content">
            <form action="{{route('staff.excel_like.update',['excel_like' => $staffExcelLike->id ])}}" method="post">
                @csrf
                @method('put')
                <div id='excel_content' class="div_overflow-x"></div>
                <textarea name="excel_content">{{$staffExcelLike->excel_content}}</textarea>

                <div class="box">
                    <div class="box-body">
                        <pre class="ace-editor" id="jquery" data-plugin="ace" data-mode="javascript" style="width: 100%;">{{$staffExcelLike->jquery}}</pre>
                        <textarea name="jquery" style="display: none;">{{$staffExcelLike->jquery}}</textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="form-control">儲存</button>
                    </div>
                </div>
                <div onclick="mybtn()">GEt Data</div>
            </form>
        </section>

    </div>
@endsection

@section('js')

    <script src="{{asset('storage/excellike/aa.js')}}" type="text/javascript"></script>
    <script src="{{asset('theme/cryptoadmin/vendor_plugins/ace-builds-master/src-min-noconflict/ace.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('theme/cryptoadmin/js/pages/form-code-editor.js')}}"></script>
    <script>
        var editor = ace.edit("jquery");
        editor.setTheme("ace/theme/iplastic");
        editor.getSession().setMode("ace/mode/javascript");
        var textarea = $('textarea[name="jquery"]');
        editor.getSession().on("change", function () {
            textarea.val(editor.getSession().getValue());
        });
    </script>
    <script>
        $(function () {
            $('#excel_content').jexcel('setData',{!!$staffExcelLike->excel_content!!})
        })
    </script>
@endsection


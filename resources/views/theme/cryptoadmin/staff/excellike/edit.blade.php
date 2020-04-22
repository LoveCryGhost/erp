@extends(config('theme.staff.staff-app'))

@section('title','控制台')

@section('css')
    <link rel="stylesheet" href="https://bossanova.uk/jsuites/v2/jsuites.css" type="text/css" />
    <link rel="stylesheet" href="https://bossanova.uk/jexcel/v4/jexcel.css" type="text/css" />
    @if(Auth::guard('admin')->check())
        <style type="text/css" media="screen">
            .ace-editor {
                min-height: 1200px;
            }
        </style>
    @endif
@endsection

@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <form action="{{route('staff.staffExcelLike.update', ['staffExcelLike'=> $staffExcelLike->id])}}" method="post">
                @csrf
                @method('put')
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary m-b-5 form-control">儲存</button>
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-sm-1 col-form-label">啟用</label>
                            <div class="col-sm-2">
                                <input class="form-control" type="text" name="is_active" placeholder="啟用" value="{{$staffExcelLike->is_active}}">
                            </div>
                            
                            <label class="col-sm-1 col-form-label">可顯示</label>
                            <div class="col-sm-2">
                                <input class="form-control" type="text" name="showable" placeholder="可顯示" value="{{$staffExcelLike->showable}}">
                            </div>
                            
                            <label class="col-sm-1 col-form-label">可編輯</label>
                            <div class="col-sm-2">
                                <input class="form-control" type="text" name="editable" placeholder="可編輯" value="{{$staffExcelLike->editable}}">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-1 col-form-label">標題名稱</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" name="title" placeholder="標題名稱" value="{{$staffExcelLike->title}}">
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-sm-1 col-form-label">描述</label>
                            <div class="col-sm-11">
                                <textarea  class="form-control " name="description">{{$staffExcelLike->description}}</textarea>
                            </div>
                        </div>
                        
                        {{--ExcelLike--}}
                        <div class="row">
                            <div class="col-12">
                                <div id='excel_content'></div>
                                <textarea name="excel_content" style="display: none;">{{$staffExcelLike->excel_content}}</textarea>
                            </div>
                        </div>
                        
                        {{--Jquery Editor--}}
                         <div class="row " {{Auth::guard('admin')->check()? "":"style=visibility:hidden;" }}>
                            <div class="col-12">
                                <pre class="ace-editor" id="jquery" data-plugin="ace" data-mode="javascript"
                                        {{Auth::guard('admin')->check()? "style=width:100%;":"" }}></pre>
                                <textarea name="jquery" style="display: none;">{{$staffExcelLike->jquery}}</textarea>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </form>
        </section>
    
    </div>
@endsection

@section('js')
    <script src="{{asset('storage/excellike/'.$staffExcelLike->id_code.'.js')}}" type="text/javascript"></script>
    <script src="https://bossanova.uk/jexcel/v4/jexcel.js"></script>
    <script src="https://bossanova.uk/jsuites/v2/jsuites.js"></script>
    <script src="{{asset('theme/cryptoadmin/vendor_plugins/ace-builds-master/src-min-noconflict/ace.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('theme/cryptoadmin/js/pages/form-code-editor.js')}}"></script>
    
    <script>
        //啟用Edotor
        var editor = ace.edit("jquery");
        editor.setTheme("ace/theme/iplastic");
        editor.getSession().setMode("ace/mode/javascript");
        
        
        //Editor若更改，指派到Textarea
        var textarea = $('textarea[name="jquery"]');
        editor.getSession().on("change", function () {
            textarea.val(editor.getSession().getValue());
        });
        
        //指派內容到Editor - Textarea
        jQuery.get("{{asset('storage/excellike/'.$staffExcelLike->id_code.'.js')}}", function(data) {
            textarea.val(data);
            editor.setValue(data);
        });
        $(function () {
            $('#excel_content').jexcel('setData',{!!$staffExcelLike->excel_content!!})
        })
    </script>
   
@endsection



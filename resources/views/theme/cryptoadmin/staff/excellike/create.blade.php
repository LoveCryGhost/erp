@extends(config('theme.staff.staff-app'))

@section('title','控制台')

@section('css')
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>

    <script src="https://bossanova.uk/jexcel/v4/jexcel.js"></script>
    <script src="https://bossanova.uk/jsuites/v2/jsuites.js"></script>
    <link rel="stylesheet" href="https://bossanova.uk/jsuites/v2/jsuites.css" type="text/css" />
    <link rel="stylesheet" href="https://bossanova.uk/jexcel/v4/jexcel.css" type="text/css" />
    <link rel="stylesheet" href="https://bossanova.uk/jexcel/v4/jexcel.css" type="text/css" />

    <style type="text/css" media="screen">
        .ace-editor {
            min-height: 300px;
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
        <form action="{{route('staff.excel_like.store')}}" method="post">
            @csrf

            <div id='spreadsheet_1'></div>
            <div id="spreadsheet_2"></div>


            <div class="box">
                <div class="box-body">

                    <div class="box-body">
                        <pre class="ace-editor" id="jquery" data-plugin="ace" data-mode="javascript" style="width: 100%;"></pre>
                        <textarea name="jquery" style="display: none;"></textarea>
                    </div>
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
<script>
    {{--  Data  --}}
    data = [
        ['Mazda', 2001, '2020/01/03'],
        ['Pegeout', 2010, ""],
        ['Honda Fit', 2009, ""],
        ['Honda CRV', 2010, ""],
    ];


    jexcel(document.getElementById('spreadsheet_1'), {
        data:data,
        minDimensions:[10,10],
        //Title & 寬度 / Validation
        columns:[
            { title:'Model', width:'300', type:'text' },
            { title:'Price', width:'80', type:'numeric' },
            { title:'Date', width:'100', type:'calendar', options: {
                    // Date format
                    format:'DD/MM/YYYY',
                    // Allow keyboard date entry
                    readonly:0,
                    // Today is default
                    today:0,
                    // Show timepicker
                    time:0,
                    // Show the reset button
                    resetButton:true,
                    // Placeholder
                    placeholder:'',
                    // Translations can be done here
                    months:['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    weekdays:['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
                    weekdays_short:['S', 'M', 'T', 'W', 'T', 'F', 'S'],
                    // Value
                    value:null,
                    // Events
                    onclose:null,
                    onchange:null,
                    // Fullscreen (this is automatic set for screensize < 800)
                    fullscreen:false, } },
            { title:'Photo', width:'150', type:'image' },
            { title:'Condition', width:'150', type:'dropdown', source:['New','Used'] },
            {
                type:'dropdown',
                title:'Available in',
                multiple:true,
                autocomplete:true,
                source:[{id:1, name:'Red'},{id:2, name:'Yellow'},{id:3,name:'Blue'}],
                width:'200',
            },
            { title:'Color', width:'80', type:'color' },
            { title:'Available', width:'80', type:'checkbox' },
        ],
        columnResize: false,
        rows:{ 3: {height:'50px' }}, //沒有title 屬性
        rowResize: false,
    });
</script>

<script>
    // var data3 = [
    //     [1, 'Morning'],
    //     [2, 'Morning'],
    //     [3, 'Afternoon'],
    //     [3, 'Evening'],
    // ];
    //
    // jexcel(document.getElementById('spreadsheet_2'), {
    //     data:data3,
    //     columns: [
    //         {
    //             type:'dropdown',
    //             title:'Category',
    //             width:'300',
    //             source:[
    //                 { id:'1', name:'Paul Hodel', image:'/templates/jexcel-v4/img/1.jpg', title:'Admin', group:'Secretary' },
    //                 { id:'2', name:'Cosme Sergio', image:'/templates/jexcel-v4/img/2.jpg', title:'Teacher', group:'Docent' },
    //                 { id:'3', name:'Rose Mary', image:'/templates/jexcel-v4/img/3.png', title:'Teacher', group:'Docent' },
    //                 { id:'4', name:'Fernanda', image:'/templates/jexcel-v4/img/3.png', title:'Admin', group:'Secretary' },
    //                 { id:'5', name:'Roger', image:'/templates/jexcel-v4/img/3.png', title:'Teacher', group:'Docent' },
    //             ]
    //         },
    //         {
    //             type:'dropdown',
    //             title:'Working hours',
    //             width:'200',
    //             source:['Morning','Afternoon','Evening'],
    //             options: { type:'picker' },
    //         },
    //     ]
    // });
    //
    // function mybtn() {
    //     $('#spreadsheet_1').jexcel('getData', false);
    //     console.log(data);
    // }
</script>
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
@endsection


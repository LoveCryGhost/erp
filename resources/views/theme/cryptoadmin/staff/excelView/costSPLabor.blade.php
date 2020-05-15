@extends(config('theme.staff.staff-app'))

@section('title','Excel - Like')
@section('css')
    <link rel="stylesheet" href="https://bossanova.uk/jsuites/v2/jsuites.css" type="text/css" />
    <link rel="stylesheet" href="https://bossanova.uk/jexcel/v4/jexcel.css" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
    <script src="https://bossanova.uk/jexcel/v3/xlsx.js"></script>
@endsection

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
                            <div id='spreadsheet'></div>
                            <div id='sheetjs'></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script src="https://bossanova.uk/jexcel/v4/jexcel.js"></script>
    <script src="https://bossanova.uk/jsuites/v2/jsuites.js"></script>
    <script>
        jexcel(document.getElementById('spreadsheet'), {
            csv:"{{asset('/storage/excelView/SP_Output_n_Cost.csv')}}",
            csvHeaders:false,
            lazyLoading:true,
            tableOverflow: true,
            tableWidth: "2000px",
            tableHeight: "1000px",
            columnResize: true,
            tableOverflow:true,
            defaultColWidth: 130,
           
        });
    </script>
    <script>
        jexcel.fromSpreadsheet("{{asset('/storage/excelView/SP_Output_n_Cost.xlsx')}}", function(result) {
            if (! result.length) {
                console.error('JEXCEL: Something went wrong.');
            } else {
                if (result.length == 1) {
                    jexcel(document.getElementById('sheetjs'), result[0]);
                } else {
                    jexcel.createTabs(document.getElementById('sheetjs'), result);
                }
            }
        });
    </script>
@endsection

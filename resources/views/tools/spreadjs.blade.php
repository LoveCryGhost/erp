<div id="ss">

</div>
{{--<link rel="stylesheet" href="{{asset('js/test/spreadjs/gc.spread.sheets.13.0.0.css')}}">--}}
{{--灰黑色--}}
{{--<link rel="stylesheet" href="{{asset('js/test/spreadjs/gc.spread.sheets.excel2013darkGray.13.0.0.css')}}">--}}

{{--<link rel="stylesheet" href="{{asset('js/test/spreadjs/gc.spread.sheets.excel2013lightGray.13.0.0.css')}}">--}}
<link rel="stylesheet" href="{{asset('js/test/spreadjs/gc.spread.sheets.excel2016colorful.13.0.0.css')}}">


<script src="{{asset('js/test/spreadjs/gc.spread.sheets.all.13.0.0.js')}}"></script>
<script src="{{asset('js/test/gc.spread.sheets.all.13.0.0.min.js')}}"></script>
<script type="text/javascript">
    // 添加授权
    // Your Code
    window.onload = function(){
        var spread = new GC.Spread.Sheets.Workbook(document.getElementById("ss"),{sheetCount:3});
        GC.Spread.Sheets.LicenseKey = "Your Key";
        var sheet = spread.getActiveSheet();
    }
</script>
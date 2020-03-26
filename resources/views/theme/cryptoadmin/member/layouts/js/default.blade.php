<!-- jQuery 3 -->
<script src="{{asset('theme/cryptoadmin/vendor_components/jquery-3.3.1/jquery-3.3.1.js')}}"></script>

{{--前--}}
{{--Toast--}}

<!-- popper -->
<script src="{{asset('theme/cryptoadmin/vendor_components/popper/dist/popper.min.js')}}"></script>
@include(config('theme.user.js.toast'))
<script src="{{asset('js/bootstrap-switch.js')}}"></script>

{{--後--}}
<!-- fullscreen -->
<script src="{{asset('theme/cryptoadmin/vendor_components/screenfull/screenfull.js')}}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{asset('theme/cryptoadmin/vendor_components/jquery-ui/jquery-ui.js')}}"></script>

<!-- Bootstrap 4.0-->
<script src="{{asset('theme/cryptoadmin/vendor_components/bootstrap/dist/js/bootstrap.js')}}"></script>

<!-- PACE -->
<script src="{{asset('theme/cryptoadmin/vendor_components/PACE/pace.min.js')}}"></script>


<!-- Slimscroll -->
<script src="{{asset('theme/cryptoadmin/vendor_components/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

<!-- FastClick -->
<script src="{{asset('theme/cryptoadmin/vendor_components/fastclick/lib/fastclick.js')}}"></script>


<!-- webticker -->
<script src="{{asset('theme/cryptoadmin/vendor_components/Web-Ticker-master/jquery.webticker.min.js')}}"></script>


<!-- EChartJS JavaScript -->
{{--<script src="{{asset('theme/cryptoadmin/vendor_components/echarts-master/dist/echarts-en.min.js')}}"></script>--}}
{{--<script src="{{asset('theme/cryptoadmin/vendor_components/echarts-liquidfill-master/dist/echarts-liquidfill.min.js')}}"></script>--}}


<!-- This is data table -->
{{--<script src="{{asset('theme/cryptoadmin/vendor_components/datatable/datatables.min.js')}}"></script>--}}
{{--<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>--}}

<!-- Crypto Admin App -->
<script src="{{asset('theme/cryptoadmin/js/template.js')}}"></script>




<!-- Crypto Admin for demo purposes -->
<script src="{{asset('theme/cryptoadmin/js/demo.js')}}"></script>


<!-- Form validator JavaScript -->
<script src="{{asset('theme/cryptoadmin/js/pages/validation.js')}}"></script>
<script src="{{asset('theme/cryptoadmin/js/pages/form-validation.js')}}"></script>


<!-- Sweet-Alert  -->
<script src="{{asset('theme/cryptoadmin/vendor_components/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('theme/cryptoadmin/vendor_components/sweetalert/jquery.sweet-alert.custom.js')}}"></script>

<script src="{{asset('theme/cryptoadmin/js/pages/statistic.js')}}"></script>

{{--<!--amcharts charts -->--}}
<script src="http://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
<script src="http://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
<script src="http://www.amcharts.com/lib/3/radar.js" type="text/javascript"></script>
<script src="http://www.amcharts.com/lib/3/pie.js" type="text/javascript"></script>
<script src="http://www.amcharts.com/lib/3/plugins/animate/animate.min.js" type="text/javascript"></script>
<script src="http://www.amcharts.com/lib/3/plugins/export/export.min.js" type="text/javascript"></script>
<script src="http://www.amcharts.com/lib/3/themes/light.js" type="text/javascript"></script>


<!-- InputMask -->
<!-- Bootstrap touchspin -->
<script src="{{asset('theme/cryptoadmin/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('theme/cryptoadmin/vendor_components/select2/dist/js/select2.full.js')}}"></script>
<script src="{{asset('theme/cryptoadmin/vendor_plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('theme/cryptoadmin/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('theme/cryptoadmin/vendor_plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('theme/cryptoadmin/vendor_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('theme/cryptoadmin/vendor_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('theme/cryptoadmin/vendor_plugins/iCheck/icheck.min.js')}}"></script>

<script src="{{asset('theme/cryptoadmin/js/pages/advanced-form-element.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('theme/cryptoadmin/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<!-- bootstrap color picker -->
<script src="{{asset('theme/cryptoadmin/vendor_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>

<!-- bootstrap time picker -->
<script src="{{asset('theme/cryptoadmin/vendor_plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>

<!-- SlimScroll -->
<script src="{{asset('theme/cryptoadmin/vendor_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>



<!-- FastClick -->
<script src="{{asset('theme/cryptoadmin/vendor_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('js/images.js')}}"></script>

<script src="{{asset('theme/cryptoadmin/js/pages/amcharts/charts.js')}}" type="text/javascript"></script>

{{--<!-- Crypto Admin App -->--}}
<script src="{{asset('theme/cryptoadmin/js/template.js')}}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet">



<script>

    function null_to_empty(str) {
        if(str==null){
            return "";
        }
        return str;
    }
    function active_ajax_header(){
        return {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };
    }


    function active_switch(switch_class, options=[]) {
        $bt_switch = $('.'+switch_class);
        $bt_switch.bootstrapSwitch('toggleState', true);
    }

    function active_select2(select2_class, options={}){
        //active
        select2_item = $('.'+select2_class);
        //theme
        if(options.theme !=null){
            select2_item.select2({
                theme: options.theme
            });
        }else{
            select2_item.select2();
        }

    }

    //表格
    //tr_movable_htlm
    function tr_movable_html() {
       return   tr_movable_html =  '<span class="handle" style="cursor: move;">' +
                                   '      <i class="fa fa-ellipsis-v"></i>' +
                                   '      <i class="fa fa-ellipsis-v"></i>' +
                                   '</span>';
    }

    function active_table_tr_reorder_in_1st_td() {
        //排序
        $('#'+table_id+' tbody tr').each(function ($index) {
            $(this).children('td:eq(1)').html($index+1);
        })
    }


    function active_table_tr_reorder_in_2nd_td() {
        //排序
        $('#'+table_id+' tbody tr').each(function ($index) {
            $(this).children('td:eq(2)').html($index+1);
        })
    }
    function active_table_tr_reorder_nth(table_id, eq_order_index=1) {
        //排序
        $('#'+table_id+' tbody tr').each(function ($index) {
            $(this).children('td:eq('+eq_order_index+')').html($index+1);
        })
    }

    //排序表格
    function active_table_sortable(table_id, eq_order_index=1, options={}) {
        if(eq_order_index === 1){
            $('#'+table_id+' tbody').sortable({
                placeholder         : 'sort-highlight',
                handle              : '.handle',
                forcePlaceholderSize: false,
                zIndex              : 999999,
                update              : active_table_tr_reorder_in_1st_td
            });
        }else if(eq_order_index === 2){
            $('#'+table_id+' tbody').sortable({
                placeholder         : 'sort-highlight',
                handle              : '.handle',
                forcePlaceholderSize: false,
                zIndex              : 999999,
                update              : active_table_tr_reorder_in_2nd_td
            });
        }
    }


    function clean_close_modal(modal_id) {
        _modal = $('#'+modal_id);
        _modal.children().find('.close').click();
        _modal.children().find('.modal-body').html('');
    }

    function master_detail_errors(_this, data) {
        //轉換物件
        var request = $.parseJSON(data.responseText);
        error_bag = $(_this).parents().closest('div.box-body').children().find('#modal_errors_div');
        error_bag.html('');
        $.each(request.errors, function(key, value) {
            error_bag.append('<li>' + value + '</li>');
        });
        error_bag.show();
    }

    function swal_delete_info(){
        return {
            title: "您確定要刪除?",
            text: "刪除後，您將無法復原此資料!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "確認刪除!",
            cancelButtonText: "取消",
            closeOnConfirm: false
        }
    }

    function float_image(className, x=40, y=10){
        $("img."+className).mouseover(function (e) {
            var tooltip = "<div id='tooltip'><img src='" + this.src + "' alt='产品预览图' width='300px;' style='z-index: 99999;'/><\/div>"; //创建 div 元素
            $("body").append(tooltip);	//把它追加到文档中
            $("#tooltip")
                .css({
                    "top": ($(this).offset().top) + y+ "px",
                    "left": ($(this).offset().left + x ) + "px"
                }).show("fast");	  //设置x坐标和y坐标，并且显示
        }).mouseout(function () {
            $("#tooltip").remove();	 //移除
        });
    }
</script>


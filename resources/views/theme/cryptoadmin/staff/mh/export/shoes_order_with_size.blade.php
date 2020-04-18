<table class="table table-bordered table-striped table-hover fontsize-1">
    <thead class="text-center">
    <tr class="bg-primary">
        <th class="m-5 p-5">編號</th>
        <th class="m-5 p-5">部門</th>
        <th class="m-5 p-5">型體</th>
        <th class="m-5 p-5">客戶名稱</th>
        <th class="m-5 p-5">訂單狀況</th>
        <th class="m-5 p-5">MH指令號</th>
        <th class="m-5 p-5">客戶訂單號</th>
        <th class="m-5 p-5">客戶採購單號</th>
        <th class="m-5 p-5">訂單類型</th>
        <th class="m-5 p-5">預告日期</th>
        <th class="m-5 p-5">接單日期</th>

        <th class="m-5 p-5">顏色</th>
        <th class="m-5 p-5">品名</th>
        <th class="m-5 p-5">採購日期</th>
        <th class="m-5 p-5">進料日期</th>

        <th class="m-5 p-5">總數</th>
        <th class="m-5 p-5">需求日期</th>
        <th class="m-5 p-5">入庫日期</th>
        <th class="m-5 p-5">完成日期</th>
        <th class="m-5 p-5">出貨日期</th>
        @foreach($size_oders as $size)
            <th class="m-5 p-5">{{$size}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($shoes_orders as $shoes_order)
        <tr>
            <td class="m-0 p-0">
                {{$loop->iteration}}
            </td>
            <td class="m-0 p-0">{{$shoes_order->department}}</td>
            <td class="m-0 p-0">{{$shoes_order->model_name}}</td>
            <td class="m-0 p-0">{{$shoes_order->shoesCustomer->c_name}}</td>
            <td class="m-0 p-0">{{$shoes_order->order_condition}}</td>
            <td class="m-0 p-0">{{$shoes_order->mh_order_code}}</td>
            <td class="m-0 p-0">{{$shoes_order->c_order_code}}</td>
            <td class="m-0 p-0">{{$shoes_order->c_purchase_code}}</td>
            <td class="m-0 p-0">{{$shoes_order->order_type}}</td>
            <td class="m-0 p-0">{{$shoes_order->predict_at=="0000-00-00"? "":date('m/d', strtotime($shoes_order->predict_at))}}</td>
            <td class="m-0 p-0">{{$shoes_order->received_at=="0000-00-00"? "":date('m/d', strtotime($shoes_order->received_at))}}</td>

            <td class="m-0 p-0">{{$shoes_order->color}}</td>
            @if($shoes_order->shoesPurchases->count()>0)
                <td class="m-0 p-0">{{$shoes_order->shoesPurchases->first()->material_name}}</td>
                <td class="text-center">{{$shoes_order->shoesPurchases->first()->purchase_at=="0000-00-00"? "": date('m/d', strtotime($shoes_order->shoesPurchases->first()->purchase_at))}}</td>
                <td class="m-0 p-0">{{$shoes_order->shoesPurchases->first()->outbound_at=="0000-00-00"? "": date('m/d', strtotime($shoes_order->shoesPurchases->first()->outbound_at))}}</td>
            @else
                <td class="m-0 p-0"></td>
                <td class="m-0 p-0"></td>
                <td class="m-0 p-0"></td>
            @endif

            <td class="m-0 p-0">{{number_format($shoes_order->qty,0,"",",")}}</td>

            <td class="m-0 p-0"></td>
            <td class="m-0 p-0"></td>
            <td class="m-0 p-0"></td>
            <td class="m-0 p-0"></td>

            @foreach($size_oders as $size)
                <td class="m-0 p-0">{{$item = $shoes_order->shoesOrderDetails->where('size',$size)->first()?
                                                                        number_format($shoes_order->shoesOrderDetails->where('size',$size)->first()->qty,0,"",",") : ""}}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>

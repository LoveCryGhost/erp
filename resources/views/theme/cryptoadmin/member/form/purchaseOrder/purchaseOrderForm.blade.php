@extends(config('theme.member.member-app'))

@section('title','代理商後台')

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
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card">
                        <div class="card-header">採購清單</div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>商品信息</th>
                                    <th>单价</th>
                                    <th>数量</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody class="product_list">
                                @foreach($purchaseOrderCartItems as $item)
                                    <tr data-id="{{ $item->sku->sku_id }}">
                                        <td>
                                            <input type="checkbox" name="select" value="{{ $item->sku->is_active }}" {{ $item->sku->is_active==1 ? 'checked' : '' }}/>
                                        </td>
                                        <td>{{ $item->sku->id_code }}</td>
                                        <td><img class="sku-thumbnail" src="{{$item->sku->thumbnail!==null? asset($item->sku->thumbnail):asset('images/default/products/product.jpg')}}" /></td>
                                        <td>
                                           {{$item->amount}}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger btn-remove">移除</button>
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
        <!-- /.content -->

    </div>
@stop

@section('js')
<script>
    $('.btn-remove').click(function () {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm){
            if (isConfirm) {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });
    });
</script>
@endsection


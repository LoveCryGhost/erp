
@can('member.reportSKU.crawlerItemAanalysis')
    <div class="btn btn-primary mb-10" onclick="bind_product_sku_to_crawler_sku(this, php_inject={{json_encode([
                        "ct_i_id" => $data['ct_i_id'],
                        "itemid" => $data['itemid'],
                        "shopid" => $data['shopid'],
                        "modelid" => $data['modelid']
                    ])}})">{{__('member/crawlerItem.sku_detail.product.cancel')}}</div><br>

    @foreach($skus as $sku)
        <div class="btn btn-primary mb-10" onclick="bind_product_sku_to_crawler_sku(this, php_inject={{json_encode([
                        "ct_i_id" => $data['ct_i_id'],
                        "itemid" => $data['itemid'],
                        "shopid" => $data['shopid'],
                        "modelid" => $data['modelid'],
                        "sku_id" => $sku->sku_id,
                    ])}})">{{$sku->id_code}} - {{$sku->sku_name}} - {{$sku->price}}</div><br>
    @endforeach

    <script type="text/javascript">
        function bind_product_sku_to_crawler_sku(_this, php_inject){
            //先判別是否為取消
            if(php_inject.ct_i_id != null){
                $.ajaxSetup(active_ajax_header());
                var formData = new FormData();
                formData.append('ct_i_id', php_inject.ct_i_id);
                formData.append('itemid', php_inject.itemid);
                formData.append('shopid', php_inject.shopid);
                formData.append('modelid', php_inject.modelid);
                formData.append('sku_id', php_inject.sku_id);
                $.ajax({
                    type: 'post',
                    url: '{{route('member.crawlerItem-crawlerItemSku.bindProductSkuToCrawlerSku')}}',
                    data: formData,
                    async: true,
                    crossDomain: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $.toast({
                            heading: "成功綁定",
                            text: "",
                            position: "top-right",
                            loaderBg: "#ff6849",
                            icon: "success",
                            hideAfter: 2000,
                            stack: 6,
                        });
                    },
                    error: function(data) {
                    }
                });
            }
        }
    </script>

@endcan

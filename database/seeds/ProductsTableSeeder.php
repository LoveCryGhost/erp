<?php

use App\Handlers\BarcodeHandler;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductThumbnail;
use App\Models\SKU;
use App\Models\SKUAttribute;
use App\Models\Type;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        //Types
            $types = [
                 '烘培用品', '面膜', '男裝', '女裝', '童裝'
            ];



        //Attribute
            $attributes = [
                '顏色', '材質', '尺寸',
            ];


            //輸入資料庫中
            $index = 1;
            foreach ($types as $type){
                Type::create([
                    'id_code' => (new BarcodeHandler())->barcode_generation(config('barcode.type'), $index++),
                    'is_active' => 1,
                    't_name' => $type,
                    't_description' => "",
                    'member_id' => 1,
                ]);
            }

            $index = 1;
            foreach ($attributes as $attribute){
                Attribute::create([
                    'id_code' => (new BarcodeHandler())->barcode_generation(config('barcode.attribute'), $index++),
                    'is_active' => 1,
                    'a_name' => $attribute,
                    'a_description' => "",
                    'member_id' => 1,
                ]);
            }

        //TypeAttribute
            $type=Type::find(1)->attributes()->attach([1,2,3]);
            $type=Type::find(2)->attributes()->attach([1]);
            $type=Type::find(3)->attributes()->attach([1,3]);
            $type=Type::find(4)->attributes()->attach([1,3]);
            $type=Type::find(5)->attributes()->attach([1,3]);

        //Products
            //烘培
            $products = [
                [
                    'is_active' => 1, 'publish_at' => null, 'member_id' => 1,
                    'p_name' => "Pizza 烤盤", 't_id' => 1,
                    'c_ids' => [2],
                    'produuct_thumnail_ids' => ['/images/default/products/pizza_pan_1.jpg', '/images/default/products/pizza_pan_2.jpg'],
                    'skus' => [
                        ['1', 'Pizza 7"烤盤', 100, 'sku_attributes' =>[ 1=>'黑色', 2=>'鐵氟龍', 3=>'7"']], //1 = member_id
                        ['1', 'Pizza 8"烤盤',300, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        ['1', 'Pizza 9"烤盤',400, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        ['1', 'Pizza 10"烤盤',700, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        ['1', 'Pizza 11"烤盤',900, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        ['1', 'Pizza 12"烤盤',110, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        ['1', 'Pizza 13"烤盤',130, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        ['1', 'Pizza 14"烤盤',150, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                    ]
                ],[
                    'is_active' => 1, 'publish_at' => null, 'member_id' => 1,
                    'p_name' => "吐司烤盤", 't_id' => 1,
                    'c_ids' => [2],
                    'produuct_thumnail_ids' => ['/images/default/products/toast_pan_1.jpg', '/images/default/products/toast_pan_2.jpg', '/images/default/products/toast_pan_3.jpg'],
                    'skus' => []
                ]
            ];
            //面膜
            $products = array_merge($products,[
                [
                    'is_active' => 1, 'publish_at' => null, 'member_id' => 1,
                    'p_name' => "潑尿酸面膜", 't_id' => 2,
                    'c_ids' => [8],
                    'produuct_thumnail_ids' => ['/images/default/products/mask_1.jpg', '/images/default/products/mask_2.jpg', '/images/default/products/mask_3.jpg'],
                    'skus' => []
                ],[
                    'is_active' => 1, 'publish_at' => null, 'member_id' => 1,
                    'p_name' => "保濕SKU面膜", 't_id' => 2,
                    'c_ids' => [10],
                    'produuct_thumnail_ids' => ['/images/default/products/mask_4.jpg'],
                    'skus' => []
                ]]);



            //男裝

            //女裝

            //童裝

            $index=1;
            foreach ($products as $product){
                $product['id_code'] = (new BarcodeHandler())->barcode_generation(config('barcode.product'), $index++);
                $c_ids = $product['c_ids'];
                $produuct_thumnail_ids = $product['produuct_thumnail_ids'];
                $skus = $product['skus'];
                unset($product['c_ids']);
                unset($product['produuct_thumnail_ids']);
                unset($product['skus']);

                $product=  Product::create($product);
                $product->categories()->attach($c_ids);

                //Thumbnails
                foreach ($produuct_thumnail_ids as $key => $thumbnail_path){
                    $productThumbnail = new  ProductThumbnail();
                    $productThumbnail->path = $thumbnail_path;
                    $productThumbnail->p_id = $product->p_id;
                    $productThumbnail->save();
                }

                //SKU
                if(count($skus)>0){
                    foreach ($skus as $sku){
                        $SKU = new SKU();
                        $SKU->p_id = $product->p_id;
                        $SKU->id_code =  (new BarcodeHandler())->barcode_generation(config('barcode.sku'), $index++);;
                        $SKU->member_id = $sku[0];
                        $SKU->sku_name = $sku[1];
                        $SKU->price = $sku[2];
                        $SKU->save();

                        //SKU-Attribute
                        foreach ($sku['sku_attributes'] as $attr_id => $attr_value){
                            $skuAttribute = new SKUAttribute();
                            $skuAttribute->sku_id = $SKU->sku_id;
                            $skuAttribute->a_id = $attr_id;
                            $skuAttribute->a_value = $attr_value;
                            $skuAttribute->save();
                        }

                        //SKU Supplier
                        $sku_supplier =[
                            1 => ['price'=>123, 'url' => "http://www.google.com"],
                            2 => ['price'=>321, 'url' => "http://www.baidu.cn"]
                        ];
                        $SKU->skuSuppliers()->sync($sku_supplier);
                    }
                }

            }
    }
}
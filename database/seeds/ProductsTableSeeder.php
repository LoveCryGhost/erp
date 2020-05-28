<?php

use App\Handlers\BarcodeHandler;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductThumbnail;
use App\Models\SKU;
use App\Models\SKUAttribute;
use App\Models\SKUSupplier;
use App\Models\Type;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        app()->setLocale('tw');
        //Types
            $types = [
                 '烘培用品', '面膜', '男裝', '女裝', '童裝'
            ];



        //Attribute
            $attributes = [
                '顏色', '材質', '尺寸',
            ];


            //輸入資料庫中
            $index_type = 1;
            foreach ($types as $type){
                Type::create([
                    'id_code' => (new BarcodeHandler())->barcode_generation(config('barcode.type'), $index_type++),
                    'is_active' => 1,
                    't_name' => $type,
                    't_description' => "",
                    'member_id' => 1,
                ]);
            }

            $index_attribute = 1;
            foreach ($attributes as $attribute){
                Attribute::create([
                    'id_code' => (new BarcodeHandler())->barcode_generation(config('barcode.attribute'), $index_attribute++),
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
                    'p_name' => "Pizza 烤盤3", 't_id' => 1,
                    'p_description' => '1234',
                    'c_ids' => [2],
                    'produuct_thumnail_ids' => ['/images/default/products/pizza_pan_1.jpg', '/images/default/products/pizza_pan_2.jpg'],
                    'skus' => [
                        ['1', 'Pizza 7"烤盤', 111, 'sku_attributes' =>[ 1=>'黑色', 2=>'鐵氟龍', 3=>'7"']], //1 = member_id
                        ['1', 'Pizza 8"烤盤', 112, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        ['1', 'Pizza 9"烤盤', 113, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        ['1', 'Pizza 10"烤盤', 114, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        ['1', 'Pizza 11"烤盤', 115, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        ['1', 'Pizza 12"烤盤', 116, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        ['1', 'Pizza 13"烤盤', 117, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        ['1', 'Pizza 14"烤盤', 118, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                    ]
                ],[
                    'is_active' => 1, 'publish_at' => null, 'member_id' => 1,
                    'p_name' => "吐司烤盤", 't_id' => 1,
                    'p_description' => '1234',
                    'c_ids' => [2],
                    'produuct_thumnail_ids' => ['/images/default/products/toast_pan_1.jpg', '/images/default/products/toast_pan_2.jpg', '/images/default/products/toast_pan_3.jpg'],
                    'skus' => [
                        ['1', '花嘴 1', 121, 'sku_attributes' =>[ 1=>'黑色', 2=>'鐵氟龍', 3=>'7"']], //1 = member_id
                        ['1', '花嘴 2', 122, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                    ]
                ]
            ];

            //面膜
            $products = array_merge($products,[
                [
                    'is_active' => 1, 'publish_at' => null, 'member_id' => 1,
                    'p_name' => "潑尿酸面膜", 't_id' => 2,
                    'p_description' => '1234',
                    'c_ids' => [8],
                    'produuct_thumnail_ids' => ['/images/default/products/mask_1.jpg', '/images/default/products/mask_2.jpg', '/images/default/products/mask_3.jpg'],
                    'skus' => []
                ],[
                    'is_active' => 1, 'publish_at' => null, 'member_id' => 1,
                    'p_name' => "保濕SKU面膜", 't_id' => 2,
                    'p_description' => '1234',
                    'c_ids' => [10],
                    'produuct_thumnail_ids' => ['/images/default/products/mask_4.jpg'],
                    'skus' => []
                ]]);



            //男裝

            //女裝

            //童裝

            $index_product=1;
            foreach ($products as $product){
                $product['id_code'] = (new BarcodeHandler())->barcode_generation(config('barcode.product'), $index_product++);
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
                        $SKU->id_code =  (new BarcodeHandler())->barcode_generation(config('barcode.sku'), $index_product++);;
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
                        $sku_suppliers =[
                            1 => ['price'=>523, 'url' => "http://www.google.com"],
                        ];
                        //$SKU->skuSuppliers()->sync($sku_suppliers);
                        foreach ($sku_suppliers as $s_id => $sku_supplier){
                            $a = $SKU->skuSuppliers()->attach([
                                $s_id => [
                                    'is_active' => 1,
                                    'random'=> rand(1,999999999999999)
                                ]
                            ]);
                            $skuSupplier = SKUSupplier::latest()->first();

                            $SKU->skuSuppliers()->updateExistingPivot(
                                $s_id , [
                                'is_active' => 1,
                                'price' => rand(1,9),
                                'random' => rand(1,999999999999999)
                            ]);
                        }
                    }
                }
            }

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //Types
            $types = [
                '廚房用品-雜項'
            ];



            //Attribute
            $attributes = [
                '顏色', '材質', '尺寸', '型狀',
            ];


            //輸入資料庫中
            //$index_type = 6;
            foreach ($types as $type){
                Type::create([
                    'id_code' => (new BarcodeHandler())->barcode_generation(config('barcode.type'), $index_type++),
                    'is_active' => 1,
                    't_name' => $type,
                    't_description' => "",
                    'member_id' => 6,
                ]);
            }

            //$index_attribute =  4;
            foreach ($attributes as $attribute){
                Attribute::create([
                    'id_code' => (new BarcodeHandler())->barcode_generation(config('barcode.attribute'), $index_attribute++),
                    'is_active' => 1,
                    'a_name' => $attribute,
                    'a_description' => "",
                    'member_id' => 6,
                ]);
            }

            //TypeAttribute
            $type=Type::find(6)->attributes()->attach([4,5,6,7]);
            $products = [
                [
                    'is_active' => 1, 'publish_at' => null, 'member_id' =>6,
                    'p_name' => "Pizza 烤盤", 't_id' => 6,
                    'p_description' => '1234',
                    'c_ids' => [2],
                    'produuct_thumnail_ids' => ['/images/default/products/pizza_pan_1.jpg', '/images/default/products/pizza_pan_2.jpg'],
                    'skus' => [
                        [5, 'Pizza 5-7"烤盤', 211, 'sku_attributes' =>[ 1=>'黑色', 2=>'鐵氟龍', 3=>'7"']], //6 = member_id
                        [5, 'Pizza 5-8"烤盤', 212, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        [5, 'Pizza 5-9"烤盤', 213, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        [5, 'Pizza 5-10"烤盤', 214, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        [5, 'Pizza 5-11"烤盤', 215, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        [5, 'Pizza 5-12"烤盤', 216, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        [5, 'Pizza 5-13"烤盤', 217, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                        [5, 'Pizza 5-14"烤盤', 218, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                    ]
                ],[
                    'is_active' => 1, 'publish_at' => null, 'member_id' => 6,
                    'p_name' => "吐司烤盤", 't_id' => 6,
                    'p_description' => '1234',
                    'c_ids' => [2],
                    'produuct_thumnail_ids' => ['/images/default/products/toast_pan_1.jpg', '/images/default/products/toast_pan_2.jpg', '/images/default/products/toast_pan_3.jpg'],
                    'skus' => [
                        [5, '花嘴 1', 221, 'sku_attributes' =>[ 1=>'黑色', 2=>'鐵氟龍', 3=>'7"']], //6 = member_id
                        [5, '花嘴 2', 222, 'sku_attributes' =>[ 1=>'AA', 2=>'BB', 3=>'CC']],
                    ]
                ]
            ];

            foreach ($products as $product){
                $product['id_code'] = (new BarcodeHandler())->barcode_generation(config('barcode.product'), $index_product++);
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
                        $SKU->id_code =  (new BarcodeHandler())->barcode_generation(config('barcode.sku'), $index_product++);;
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
                        $sku_suppliers =[
                            2 => ['price'=>123, 'url' => "http://www.google.com"],
                        ];
                        //$SKU->skuSuppliers()->sync($sku_suppliers);
                        foreach ($sku_suppliers as $s_id => $sku_supplier){

                            $a =$SKU->skuSuppliers()->attach([
                                $s_id => [
                                    'is_active' => 1,
                                    'price' => rand(1,9),
                                    'random'=> rand(1,999999999999999)
                                ]
                            ]);

                            $skuSupplier = SKUSupplier::latest()->first();
                            $SKU->skuSuppliers()->updateExistingPivot(
                                $s_id , [
                                'is_active' => 1,
                                'price' => rand(1,9),
                                'random' => rand(1,999999999999999)
                            ]);
                        }
                    }
                }
            }
    }
}

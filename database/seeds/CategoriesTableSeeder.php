<?php

use App\Handlers\BarcodeHandler;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\User;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        //分類
            $categories = [
                '烘培用品' => [ '烤盤', '打蛋器', '煎蛋器', '刷子', '分蛋器'],
                '面膜' => ['坡尿酸', '美白', '保濕'],
                '男裝' => ['長褲', '短褲', '長袖', '西裝'],
                '女裝' => ['長褲', '短褲', '短裙', '長裙', '背心', '泳裝'],
                '童裝' => ['親子裝', '套裝']
            ];

            $index = 0;
            foreach($categories as $name => $sub_categories){

                $insert = [
                    'c_pid' => null,
                    'id_code' => (new BarcodeHandler())->barcode_generation(config('barcode.categories'), $index++),
                    'is_active' => 1,
                    'c_name' => $name,
                    'c_description' => "",
                    'member_id' => 1
                ];
                $cat_id = Category::insertGetId($insert);

                foreach ($sub_categories as $key => $sub_category_name){
                    $insert = [
                        'c_pid' => $cat_id,
                        'id_code' => (new BarcodeHandler())->barcode_generation(config('barcode.categories'), $index++),
                        'is_active' => 1,
                        'c_name' => $sub_category_name,
                        'c_description' => "",
                        'member_id' => 1
                    ];
                    Category::insertGetId($insert);
                }
            }
    }
}
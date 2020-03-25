<?php

use App\Handlers\BarcodeHandler;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            '',
        ];

        // 生成数据集合
        $admins = factory(Admin::class)
            ->times(10)
            ->make()
            ->each(function ($admin, $index)
            use ($faker, $avatars)
            {
                // 从头像数组中随机取出一个并赋值
                $admin->avatar = $faker->randomElement($avatars);
                $admin->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.admin'), $index+1);
            });

        // 让隐藏字段可见，并将数据集合转换为数组
        $admin_array = $admins->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        Admin::insert($admin_array);

        $admin = Admin::find(1);
        $admin->name = 'admin-1';
        $admin->email = 'admin1@app.com';
        $admin->avatar = '';
        $admin->save();

        $admin = Admin::find(2);
        $admin->name = 'admin-2';
        $admin->email = 'admin2@app.com';
        $admin->avatar = '';
        $admin->save();

    }
}
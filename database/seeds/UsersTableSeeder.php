<?php

use App\Handlers\BarcodeHandler;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
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
        $users = factory(User::class)
            ->times(2)
            ->make()
            ->each(function ($user, $index)
            use ($faker, $avatars)
            {
                // 从头像数组中随机取出一个并赋值
                $user->avatar = $faker->randomElement($avatars);
                $user->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.user'), $index+1);
                $user->avatar = '/images/default/avatars/avatar'.($index+1).'.jpg';
            });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        $user = User::find(1);
        $user->name = 'user-1';
        $user->email = 'user1@app.com';
        $user->save();

        $user = User::find(2);
        $user->name = 'user-2';
        $user->email = 'user2@app.com';
        $user->save();

    }
}

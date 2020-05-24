<?php

use App\Handlers\BarcodeHandler;
use App\Models\Member;
use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
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
        $members = factory(Member::class)
            ->times(10)
            ->make()
            ->each(function ($member, $index)
            use ($faker, $avatars)
            {
                // 从头像数组中随机取出一个并赋值
                $member->avatar = $faker->randomElement($avatars);
                $member->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.member'), $index+1);
            });

        // 让隐藏字段可见，并将数据集合转换为数组
        $member_array = $members->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        Member::insert($member_array);

        $member = Member::find(1);
        $member->name = 'SuperMember';
        $member->email = 'super_member@app.com';
        $member->avatar = '';
        $member->save();

        $member = Member::find(2);
        $member->name = 'Category';
        $member->email = 'category@app.com';
        $member->avatar = '';
        $member->save();

        $member = Member::find(3);
        $member->name = 'SubCategory';
        $member->email = 'subCategory@app.com';

        $member->avatar = '';
        $member->save();

        $member = Member::find(4);
        $member->name = 'CategoryOutside';
        $member->email = 'categoryOutside@app.com';
        $member->avatar = '';
        $member->save();

        $member = Member::find(5);
        $member->name = 'SubCategoryOutside';
        $member->email = 'subCategoryOutside@app.com';
        $member->avatar = '';
        $member->save();

        $member = Member::find(6);
        $member->name = 'risca';
        $member->email = 'risca@app.com';
        $member->avatar = '';
        $member->save();

    }
}

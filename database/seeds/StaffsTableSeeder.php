<?php

use App\Handlers\BarcodeHandler;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffsTableSeeder extends Seeder
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
        $Staffs = factory(Staff::class)
            ->times(50)
            ->make()
            ->each(function ($Staff, $index)
            use ($faker, $avatars)
            {
                // 从头像数组中随机取出一个并赋值
                $Staff->avatar = $faker->randomElement($avatars);
                $Staff->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.staff'), $index+1);
                $Staff->d_id = rand(2,6);
                $Staff->sex = rand(0,1);
                $Staff->staff_code = rand(10000,99999);
                $Staff->tel1 = $faker->phoneNumber;
                $Staff->phone1 = $faker->phoneNumber;
                $Staff->join_at = $faker->dateTimeThisDecade();
                $Staff->avatar = '/images/default/avatars/avatar'.($index+1).'.jpg';
                $Staff->join_at = today();
            });

        // 让隐藏字段可见，并将数据集合转换为数组
        $Staff_array = $Staffs->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        Staff::insert($Staff_array);

        $Staff = Staff::find(1);
        $Staff->name = 'Staff-Admin';
        $Staff->email = 'staff_admin@app.com';
        $Staff->save();

        $Staff = Staff::find(2);
        $Staff->name = 'Staff-HR';
        $Staff->email = 'staff_hr@app.com';
        $Staff->save();

        $Staff = Staff::find(3);
        $Staff->name = 'Staff-HR-Test';
        $Staff->email = 'staff_hr_test@app.com';
        $Staff->save();

        $Staff = Staff::find(4);
        $Staff->name = 'Staff-Scheduling';
        $Staff->email = 'staff_scheduling@app.com';
        $Staff->save();

        $Staff = Staff::find(5);
        $Staff->name = 'Staff-Mold';
        $Staff->email = 'staff_mold@app.com';
        $Staff->save();

        //Staff - Department
        $staffs = Staff::get();
        foreach ($staffs as $staff){
            $rand_int = rand(1,33);
            $staff->staffDepartments()->attach([$rand_int => ['created_by' => rand(1,10),'modified_by' => rand(1,10), 'bonus' => rand(100,500), 'start_at' => now()]]);
        }
    }
}

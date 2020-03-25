<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
//        $this->call(AdminsTableSeeder::class);
//        $this->call(MembersTableSeeder::class);
//        $this->call(CategoriesTableSeeder::class);
//        $this->call(ProductsTableSeeder::class);
//        $this->call(SuppliersTableSeeder::class);
//        $this->call(StaffDepartmentsTableSeeder::class);
//        $this->call(StaffsTableSeeder::class);
    }
}

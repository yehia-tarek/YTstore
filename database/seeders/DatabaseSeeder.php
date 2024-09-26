<?php

use Illuminate\Database\Seeder;
use Database\Seeders\CouponSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\SettingTableSeeder;

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
         $this->call(SettingTableSeeder::class);
         $this->call(CouponSeeder::class);


    }
}

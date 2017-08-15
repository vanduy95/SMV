<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class OrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('organization')->insert([
                [
                'ma'=>'HT',
                'name'=>'hệ thống',
                'city'=>'dong chay',
                'address'=>'Ha Noi',
                'phone'=>'0977601447',
                'bank'=>'vnbank',
                'system'=>1,
                'worker'=>'0',
                ]
                ]);
    }
}

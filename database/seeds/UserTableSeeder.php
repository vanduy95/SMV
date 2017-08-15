<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('user')->insert([
         [
         'groupuser_id'=>1,
         'username'=>'admin',
         'email'=>'phamtuananh7602@gmail.com',
         'password'=>bcrypt('123456'),
         'status'=>1,
         'syslock'=>0,
         'organization_id'=>1,
         ],
       ]);
    }
  }

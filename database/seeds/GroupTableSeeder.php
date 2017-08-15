<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groupuser')->insert([
            ['name'=>'Admin','note'=>'Người dùng có quyền cao nhất','created_at'=>new DateTime(),],
            ['name'=>'Khách hàng','note'=>'Cập nhật và xác thực thông tin khách hàng','created_at'=>new DateTime(),],
            ['name'=>'Cập nhật thông tin','note'=>'Cập nhật và xác thực thông tin khách hàng','created_at'=>new DateTime(),],
            ['name'=>'Xác thực thông tin','note'=>'Cập nhật thông tin khách hàng và phê duyệt','created_at'=>new DateTime(),],
            ['name'=>'Duyệt','note'=>'Cập nhật thông tin khách hàng và phê duyệt','created_at'=>new DateTime(),],
            ['name'=>'Nhân viên bán hàng','note'=>'Cập nhật thông tin khách hàng và phê duyệt','created_at'=>new DateTime(),],
            ['name'=>'test','note'=>'','created_at'=>new DateTime(),],
            ['name'=>'Kế toán','note'=>'','created_at'=>new DateTime(),],

        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class ProcessStatusTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('processstatus')->insert([
        	['name'=>'Cập nhật thông tin','value'=>'1','created_at'=>new DateTime(),],
        	['name'=>'Xác nhận thông tin','value'=>'2','created_at'=>new DateTime(),],
        	['name'=>'Chờ Duyệt','value'=>'3','created_at'=>new DateTime(),],
        	['name'=>'Đã duyệt','value'=>'4','created_at'=>new DateTime(),],
            ['name'=>'Đã giao hàng','value'=>'5','created_at'=>new DateTime(),],
            ['name'=>'Từ chối','value'=>'6','created_at'=>new DateTime(),]
        	]);
    }
}

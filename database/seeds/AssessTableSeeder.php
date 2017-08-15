<?php

use Illuminate\Database\Seeder;

class AssessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assess')->insert([
        	['scoresfirst'=>'95','scoreslast'=>'100','reted'=>'AAA','reviews'=>'Rủi ro thấp'],
        	['scoresfirst'=>'90','scoreslast'=>'94','reted'=>'AA','reviews'=>'Rủi ro thấp'],
        	['scoresfirst'=>'85','scoreslast'=>'89','reted'=>'A','reviews'=>'Rủi ro thấp'],
        	['scoresfirst'=>'80','scoreslast'=>'84','reted'=>'BBB','reviews'=>'Rủi ro trung bình'],
        	['scoresfirst'=>'70','scoreslast'=>'79','reted'=>'BB','reviews'=>'Rủi ro trung bình'],
        	['scoresfirst'=>'60','scoreslast'=>'69','reted'=>'B','reviews'=>'Rủi ro trung bình'],
        	['scoresfirst'=>'50','scoreslast'=>'59','reted'=>'CCC','reviews'=>'Rủi ro cao'],
        	['scoresfirst'=>'40','scoreslast'=>'49','reted'=>'CC','reviews'=>'Rủi ro cao'],
        	['scoresfirst'=>'35','scoreslast'=>'39','reted'=>'C','reviews'=>'Rủi ro cao'],
        	['scoresfirst'=>'0','scoreslast'=>'34','reted'=>'D','reviews'=>'Rủi ro cao'],
        ]);
    }
}

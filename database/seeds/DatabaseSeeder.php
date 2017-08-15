<?php 
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GroupTableSeeder::class);
        // $this->call(OrganizationTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(AssessTableSeeder::class);
        $this->call(ProcessStatusTable::class);
    }
}

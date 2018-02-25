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
        $this->call(BranchTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(PositionTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ApplicationsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
    }
}

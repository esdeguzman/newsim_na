<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Initial Data for Departments
        $departments = [
            [
                'code' => 'HR',
                'name' => 'Human Resource'
            ],
            [
                'code' => 'MKTG',
                'name' => 'Marketing'
            ],
            [
                'code' => 'TRNG',
                'name' => 'Training'
            ],
            [
                'code' => 'IT',
                'name' => 'Information Technology'
            ],
            [
                'code' => 'ACNT',
                'name' => 'Accounting'
            ],
            [
                'code' => 'IAD',
                'name' => 'Internal Audit'
            ],
            [
                'code' => 'REG',
                'name' => 'Registration'
            ],
            [
                'code' => 'RND',
                'name' => 'Research and Development'
            ]
        ];

        foreach ($departments as $value) {
            $department = new Department();
            $department->code = $value['code'];
            $department->name = $value['name'];
            $department->save();
        }
    }
}

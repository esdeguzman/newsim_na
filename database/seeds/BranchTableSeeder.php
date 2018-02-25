<?php

use Illuminate\Database\Seeder;
use App\Branch;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Initial Data for Branches
        $branches = [
            [
                'code' => 'BCD',
                'name' => 'Bacolod'
            ],
            [
                'code' => 'CEB',
                'name' => 'Cebu'
            ],
            [
                'code' => 'DAV',
                'name' => 'Davao'
            ],
            [
                'code' => 'ILO',
                'name' => 'Ilo-ilo'
            ],
            [
                'code' => 'MA',
                'name' => 'Makati'
            ]
        ];

        foreach ($branches as $value) {
            $branch = new Branch();
            $branch->code = $value['code'];
            $branch->name = $value['name'];
            $branch->save();
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Branch;
use App\Department;
use Laravel\Passport\Client;
use App\Position;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $branches = Branch::all();
        $departments = Department::all();
        $positions = Position::all();
        $applications = Client::all();

        // Default Account
        $user = new User();
        $user->employee_id = $faker->unique()->numberBetween($min = 1000, $max = 9000);
        $user->email = 'mobile@newsim.ph';
        $user->username = 'daniel';
        $user->password = bcrypt('root');
        $user->first_name = 'Mike';
        $user->middle_name = '';
        $user->last_name = 'Lopez';
        $user->gender = 'male';
        $user->employment_status = 'active';
        $user->department = 'Information Technology';
        $user->position = 'Programmer';
        $user->branch = 'Makati';
        $user->type = 'admin';
        $user->remarks = $faker->text($maxNbChars = 100);
        $user->verified = true;
        $user->save();

        $user = new User();
        $user->employee_id = $faker->unique()->numberBetween($min = 1000, $max = 9000);
        $user->email = 'deguzman.esmeraldo@gmail.com';
        $user->username = 'esme';
        $user->password = bcrypt('root');
        $user->first_name = 'Esmeraldo';
        $user->middle_name = '';
        $user->last_name = 'De Guzman';
        $user->gender = 'male';
        $user->employment_status = 'active';
        $user->department = 'Information Technology';
        $user->position = 'Programmer';
        $user->branch = 'Makati';
        $user->type = 'super-admin';
        $user->remarks = $faker->text($maxNbChars = 100);
        $user->verified = true;
        $user->save();

        $user = new User();
        $user->employee_id = $faker->unique()->numberBetween($min = 1000, $max = 9000);
        $user->email = 'qmr.jenny@gmail.com';
        $user->username = 'jenny';
        $user->password = bcrypt('root');
        $user->first_name = 'Jenny';
        $user->middle_name = 'Fajardo';
        $user->last_name = 'Ludovico';
        $user->chief = 1;
        $user->gender = 'female';
        $user->employment_status = 'active';
        $user->department = 'Quality Management Relation';
        $user->position = 'QMRA';
        $user->branch = 'Makati';
        $user->type = 'default';
        $user->remarks = $faker->text($maxNbChars = 100);
        $user->verified = true;
        $user->save();

		$user = new User();
        $user->employee_id = $faker->unique()->numberBetween($min = 1000, $max = 9000);
        $user->email = 'documentcontroller.clarisa@gmail.com';
        $user->username = 'clarisa';
        $user->password = bcrypt('root');
        $user->first_name = 'Clarisa';
        $user->middle_name = '';
        $user->last_name = 'Surname';
        $user->gender = 'female';
        $user->employment_status = 'active';
        $user->department = 'Quality Management Relation';
        $user->position = 'Document Controller';
        $user->branch = 'Makati';
        $user->type = 'default';
        $user->remarks = $faker->text($maxNbChars = 100);
        $user->verified = true;
        $user->save();

        for ($i=0; $i < 100; $i++) {
            $user = new User();
            $user->employee_id = $faker->unique()->numberBetween($min = 1000, $max = 9000);
            $user->email = $faker->email;
            $user->username = $faker->unique()->userName;
            $user->password = bcrypt('root');
            $user->first_name = $faker->firstName;
            $user->middle_name = $faker->lastName;
            $user->last_name = $faker->lastName;
            $user->gender = $faker->randomElement(['male', 'female']);
            $user->chief = $faker->optional($weight = 0.9, $default = 1)->randomElement([0]);
            $user->employment_status = $faker->randomElement(['active', 'inactive']);
            $user->department = $faker->randomElement($departments->toArray())['name'];
            $user->position = $faker->randomElement($positions->toArray())['name'];
            $user->branch = $faker->randomElement($branches->toArray())['name'];
            $user->type = $faker->randomElement(['super-admin', 'admin', 'default']);
            $user->remarks = $faker->text($maxNbChars = 100);
            $user->save();
        }
    }
}

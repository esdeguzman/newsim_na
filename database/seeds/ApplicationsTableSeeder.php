<?php

use Illuminate\Database\Seeder;
use Laravel\Passport\Client;

class ApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Initial Data for Client Application
        $code = ['DLS', 'eQMS'];
        $name = ['Document Library System', 'Electronic Quality Management System'];
        $description = ['For archiving and retrieving documents', 'For Quality Assurance Department'];
        $redirect = ['http://das.newsimapps.dev/callback', 'http://eqms.newsimapps.dev/callback'];


        for ($i=0; $i < 2; $i++) {
            $application = (new Client)->forceFill([
                'user_id' => 1,
                'code' => $code[$i],
                'name' => $name[$i],
                'description' => $description[$i],
                'secret' => str_random(40),
                'redirect' => $redirect[$i],
                'personal_access_client' => false,
                'password_client' => false,
                'revoked' => false,
            ]);
            $application->save();
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Position;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Initial Data for Job Positions
        $positions = [
            'CEO',
            'Support Staff',
            'Chief Training Officer',
            'On-Call Deck Instructor/ Assesor',
            'Driver',
            'Engine Instructor',
            'On-Call Engine Instructor',
            'Company Driver',
            'On-Call Instructor',
            'Support Staff / Training Assistant',
            'QMR',
            'Instructor',
            'Training Assistant',
            'Account Customer Relations Officer',
            'Marketing Officer',
            'On-Call Instructor/ Assesor',
            'Instructor/ Assessor',
            'Chief Marketing Officer',
            'Accounting Assistant',
            'System and Multimedia Support',
            'IT Assistant',
            'Registrar Assistant',
            'Chief IT Officer',
            'Chief Registration Officer',
            'Assistant Registrar',
            'On-Call Instructor/ Assessor',
            'Chief Executive Officer',
            'Cashier',
            'Billing and Collection Officer',
            'QMR Assitant',
            'Billing and Purchasing Officer',
            'Costumer Relations Officer',
            'Registration Assistant',
            'Site Training Manager',
            'Accounting Officer',
            'Receptionist/ Executive Secretary',
            'On-Call Instructor/ Research',
            'Finance Assistant',
            'QMR Assistant',
            'RDO Cum Instructor/ Assessor',
            'Web Administrator',
            'On Board Instructor',
            'RND Assistant',
            'RDO',
            'Technical Support',
            'Motor Pool Supervisor',
            'HR Officer',
            'HR Assistant',
            'Researcher',
            'Research and Developer Officer',
            'Compliance Assistant',
            'Documentation Assistant',
            'Marketing Assistant',
            'Compliance Officer',
            'Encoder',
            'Front Desk',
            'Branch IT',
            'On Board Deck Instructor',
            'On Board Instructor/On Call Deck Instructor',
            'Network and Technical Support',
            'VisMin COO / CTO',
            'Book Keeper',
            'IT Support',
            'Receptionist',
            'Registar',
            'Marketing Staff',
            'Training Manager',
            'WEB Programmer',
            'Programmer',
            'HR',
            'Mason',
            'Chief Finance Officer',
            'Support Staff / Maintenance',
            'Purchasing Officer/ Property Custodian',
            'Instructor/M.O',
            'CTSO / CTO',
            'CRO',
            'Front Office',
            'Chief Mate',
            'Review Instructor',
            'Support Staff/ Technical',
            'Deck Instructor',
            'Training Instructor',
            'Graphic Artist',
            'Network Technical Support/Branch IT Support',
            'ON-Call Deck Instructor'
        ];

        foreach ($positions as $value) {
            $position = new Position();
            $position->name = $value;
            $position->save();
        }

    }
}

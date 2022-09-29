<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\PeopleRole;
use App\Models\PhoneType;
use Illuminate\Database\Seeder;

class PeopleRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array(
            array(
                "name" => 'Owner'
            ),
            array(
                "name" => 'Manager'
            ),
            array(
                "name" => 'Shipping'
            ),
            array(
                "name" => 'QA'
            ),
            array(
                "name" => 'Purchasing'
            ),
            array(
                "name" => 'Accounting'
            ),
        );
        foreach ($data as $value) {
            PeopleRole::firstOrCreate($value);
       }
    }
}

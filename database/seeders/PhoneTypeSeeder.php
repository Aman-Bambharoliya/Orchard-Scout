<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\PhoneType;
use Illuminate\Database\Seeder;

class PhoneTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phone_types=array(
            array(
                "name" => 'Mobile'
            ),
            array(
                "name" => 'Main'
            ),
            array(
                "name" => 'Home'
            ),
            array(
                "name" => 'Fax'
            ),
        );
        foreach ($phone_types as $phone_type) {
            PhoneType::firstOrCreate($phone_type);
       }
    }
}

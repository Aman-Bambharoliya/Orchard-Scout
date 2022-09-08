<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $find = Admin::where('email', 'superadmin@gmail.com')->get();
        if (count($find) < 1) {
            $admin = Admin::create([
                'name' => 'Administrator',
                'email' => 'superadmin@gmail.com',
                'role' => '1',
                'password' => bcrypt('123456')
            ]);
        }
    }
}

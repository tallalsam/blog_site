<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuperAdmin;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SuperAdmin::truncate();

        SuperAdmin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin'),
        ]);
    }
}

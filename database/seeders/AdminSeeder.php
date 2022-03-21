<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();

        $admins = [[
            'name' => 'Admin1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('admin1'),
        ],
        [
            'name' => 'Admin2',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('admin2'),
        ]];

        Admin::insert($admins);
    }
}

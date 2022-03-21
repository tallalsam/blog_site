<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $users = [[
            'name' => 'User1',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('user1'),
        ],
        [
            'name' => 'User2',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('user2'),
        ]];

       User::insert($users);
    }
}

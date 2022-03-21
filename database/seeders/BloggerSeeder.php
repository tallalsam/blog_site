<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blogger;

class BloggerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blogger::truncate();

        $bloggers = [[
            'name' => 'Blogger1',
            'email' => 'blogger1@gmail.com',
            'password' => bcrypt('blogger1'),
        ],
        [
            'name' => 'Blogger2',
            'email' => 'blogger2@gmail.com',
            'password' => bcrypt('blogger2'),
        ]];

        Blogger::insert($bloggers);
    }
}

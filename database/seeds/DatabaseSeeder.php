<?php

use App\admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        admin::create([
            'email' => 'user@email.com',
            'password' => md5('demopassword123'),
            'username' => 'Group 8',
            'token' => ''
        ]);
    }
}

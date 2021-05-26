<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'HBilal',
            'last_name' => 'Khan',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        User::create([
            'first_name' => 'New',
            'last_name' => 'Manager',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'manager'
        ]);

        User::create([
            'first_name' => 'Khan',
            'last_name' => 'Employee',
            'email' => 'employee@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'employee'
        ]);
    }
}

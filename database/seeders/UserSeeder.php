<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Admin
            [
                'name'      => 'Administrator',
                'username'  => 'admin',
                'email'     => 'admin@admin.admin',
                'password'  => Hash::make('123'),
                'role'      => 'admin',
                'status'    => 'active',
            ],

            // Agent
            [
                'name'      => 'Agent',
                'username'  => 'agent',
                'email'     => 'agent@agent.agent',
                'password'  => Hash::make('123'),
                'role'      => 'agent',
                'status'    => 'active',
            ],

            // User
            [
                'name'      => 'User',
                'username'  => 'user',
                'email'     => 'user@user.user',
                'password'  => Hash::make('123'),
                'role'      => 'user',
                'status'    => 'active',
            ],
        ]);
    }
}

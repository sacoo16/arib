<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => Hash::make('password'),
                'remember_token' => NULL,
                'role'           => 'admin',
                'phone'          => '01111111111',
            ],
            [
                'id'             => 2,
                'name'           => 'Manager',
                'email'          => 'manager@admin.com',
                'password'       => Hash::make('password'),
                'remember_token' => NULL,
                'role'           => 'manager',
                'phone'          => '01222222222',
            ],
            [
                'id'             => 3,
                'name'           => 'Employee',
                'email'          => 'employee@admin.com',
                'password'       => Hash::make('password'),
                'remember_token' => NULL,
                'role'           => 'employee',
                'phone'          => '01333333333',
            ],
        ];
        User::insert($users);
    }
}

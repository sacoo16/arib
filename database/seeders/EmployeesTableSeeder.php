<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'id'             => 1,
                'first_name'     => 'Joe',
                'last_name'      => 'Doe 1',
                'salary'         => 10000,
                'user_id'        => 1,
                'department_id'  => NULL,
                'manager_id'     => NULL,
            ],
            [
                'id'             => 2,
                'first_name'     => 'New',
                'last_name'      => 'Manager',
                'salary'         => 8000,
                'user_id'        => 2,
                'department_id'  => 1,
                'manager_id'     => NULL,
            ],
            [
                'id'             => 3,
                'first_name'     => 'New',
                'last_name'      => 'Employee',
                'salary'         => 3000,
                'user_id'        => 3,
                'department_id'  => 1,
                'manager_id'     => 2,
            ],
           
        ];
        Employee::insert($employees);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeeRole;
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
        //Roles
        EmployeeRole::factory()->create([
            'name' => 'Developer'
        ]);

        EmployeeRole::factory()->create([
            'name' => 'Team Leader'
        ]);

        EmployeeRole::factory()->create([
            'name' => 'CTO'
        ]);

        //Employees
        Employee::factory()->create([
            'name' => 'Juan Nicolás',
            'surname' => 'Murillo',
            'email' => 'juannicolas@outlook.com'
        ]);

        Employee::factory(19)->create();
    }
}

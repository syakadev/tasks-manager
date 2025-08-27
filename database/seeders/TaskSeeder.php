<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tasks;


class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tasks::create([
            'name' => 'Design Homepage',
            'description' => 'Create a new design for the website homepage.',
            'status' => 'no',
            'project_id' => 1,
        ]);

        Tasks::create([
            'name' => 'Develop User Authentication',
            'description' => 'Implement user registration, login, and logout functionalities.',
            'status' => 'yes',
            'project_id' => 2,
        ]);

        Tasks::create([
            'name' => 'Optimize Database Queries',
            'description' => 'Improve the performance of frequently used database queries.',
            'status' => 'no',
            'project_id' => 1,
        ]);

    }
}

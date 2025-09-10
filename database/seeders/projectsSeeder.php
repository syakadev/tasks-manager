<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Projects;

class projectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Projects::create([
            'name' => 'Website Redesign',
            'description' => 'Redesign the company website for a modern look and improved user experience.',
            'status' => 'todo',
            'end_date' => '2026-03-31',
            'user_id' => 1,
        ]);

        Projects::create([
            'name' => 'Mobile App Development',
            'description' => 'Develop a new mobile application for both iOS and Android platforms.',
            'status' => 'doing',
            'end_date' => '2026-06-30',
            'user_id' => 1,
        ]);

        Projects::create([
            'name' => 'Database Migration',
            'description' => 'Migrate existing database to a new, more scalable solution.',
            'status' => 'done',
            'end_date' => '2023-12-15',
            'user_id' => 1,
        ]);
    }
}

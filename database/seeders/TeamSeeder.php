<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;


class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::create([
            'name' => 'Development Team',
            'description' => 'Team responsible for software development.',
            'manager_id' => 1,
            'user1_id' => 2,
            'user2_id' => null,
            'user3_id' => null,
        ]);

        Team::create([
            'name' => 'Design Team ui ux',
            'description' => 'Team responsible for UI/UX design.',
            'manager_id' => 1,
            'user1_id' => 2,
            'user2_id' => null,
            'user3_id' => null,
        ]);

    }
}

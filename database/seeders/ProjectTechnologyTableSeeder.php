<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Technology;

class ProjectTechnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 200; $i++ ){
            $project = Project::inRandomOrder()->first();
            $technology_id = Technology::inRandomOrder()->first()->id;

            $project->technology()->attach($technology_id);
            // dump($technology_id);
        }
    }
}

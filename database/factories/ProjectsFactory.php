<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'judul_project' => $this->faker->sentence(3),
            'deskripsi_project' => $this->faker->paragraph(),
            'image_project' => null,
            'project_price' => $this->faker->numberBetween(200000, 700000), 
        ];
    }
}
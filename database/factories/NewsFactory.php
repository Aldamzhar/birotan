<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'img' => collect(Storage::files('public'))->random(),
            'title' => fake()->title,
            'publication_date' => fake()->date,
            'author_name' => fake()->name,
            'description' => fake()->realText
        ];
    }
}

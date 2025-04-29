<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * 
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagePath = 'waw.png';
        $title = $this->faker->sentence(3);
        $year = $this->faker->year();
        $duration = $this->faker->numberBetween(60, 180);
        $genres = ['Action', 'Comedy', 'Drama', 'Sci-Fi', 'Fantasy', 'Thriller', 'Romance', 'Animated'];
        $genre = $this->faker->randomElement($genres);

        return [
            'title' => $title,
            'thumbnail' => $imagePath,
            'description' => $this->faker->sentence(17),
            'production_year' => $year,
            'duration' => $duration,
            'genre' => $genre,
            'synopsis' => $this->faker->paragraph(5),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

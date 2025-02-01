<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'author_id' => Author::factory(),
            'category_id' => Category::factory(),
            'publisher_id' => Publisher::factory(),
            'published_year' => $this->faker->year
        ];
    }
}

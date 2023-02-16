<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->name();
        return [
            'title' => $title,
            'description' => $this->faker->text,
            'slug' => Str::slug($title),
            'price' => $this->faker->randomNumber(),
            'lenght' => $this->faker->randomNumber(),
            'width' => $this->faker->randomNumber(),
            'weight' => $this->faker->randomNumber(),
            'category_id' => Category::get()->random()->id
        ];
    }
}

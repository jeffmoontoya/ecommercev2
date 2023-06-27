<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();

        return [
            'category_id' => $category->id,
            'product_image' => $this->faker->imageUrl(),
            'product_name' => $this->faker->sentence(3),
            'product_description' => $this->faker->paragraph,
            'product_price' => $this->faker->randomFloat(2, 10, 100),
            'product_stock' => $this->faker->randomNumber(2),
        ];
    }
}

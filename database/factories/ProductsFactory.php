<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => '1',
            'cate_id' => '1',
            'name' => $this->faker->unique()->name,
            'small_description' => $this->faker->paragraph,
            'description' => $this->faker->paragraph,
            'price' => '20',
            'image' => $this->faker->imageUrl,
            'qty' => $this->faker->numberBetween(1,20),
            'status' => '1'
        ];
    }
}

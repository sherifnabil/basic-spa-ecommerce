<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' =>  $this->faker->words(
                nb: 3,
                asText: true
            ),
            'sku' =>  $this->faker->bothify('prod-######'),
            'image'    =>  '/products/photo.jpeg',
        ];
    }
}

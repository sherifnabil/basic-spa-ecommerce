<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' =>  $this->faker->words(
                nb: 3,
                asText: true
            )
        ];
    }
}

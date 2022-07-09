<?php

namespace Database\Factories;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => Ad::factory(),
            'author_name' => $this->faker->sentence(rand(10, 20)),
            'description' => $this->faker->sentences(rand(10, 100), true),
            'title' => $this->faker->sentence(rand(10, 20))
        ];
    }
}

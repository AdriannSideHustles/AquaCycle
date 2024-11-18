<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\reward>
 */
class RewardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'description' => fake() -> realText(15),
            'image_url' => fake() -> imageUrl(),
            'avail_qty' => fake() -> numberBetween(20,50),
            'points_required' => fake() -> numberBetween(10,20),
            'status' => "Available"
        ];
    }
}

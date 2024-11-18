<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserStats>
 */
class UserStatsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'outstanding_points' => fake() -> numberBetween(40,50),
            'total_accu_points' => fake() ->numberBetween(150,500),
            'total_bottles_thrown' => fake() -> numberBetween(75,150)            
        ];
    }
}

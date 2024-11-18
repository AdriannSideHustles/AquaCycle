<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\reward::factory(10)->create();
        \App\Models\article::factory(10)->create();
        \App\Models\RewardExchange::factory(10)->create();
        \App\Models\UserStats::factory(10)->create();
        \App\Models\BottleDisposal::factory(20)->create();


        \App\Models\RewardExchange::factory(5)->create([
            'user_id' => 1,
            'reward_id' => 1,
            'qty'=> fake() -> numberBetween(1,10),
            'status' => "Approved"
        ]);
        \App\Models\RewardExchange::factory(5)->create([
            'user_id' => 1,
            'reward_id' => 1,
            'qty'=> fake() -> numberBetween(1,10),
            'status' => "Rejected"
        ]);
        \App\Models\RewardExchange::factory(5)->create([
            'user_id' => 1,
            'reward_id' => 1,
            'qty'=> fake() -> numberBetween(1,10),
            'status' => "Redeemed"
        ]);
    }
}

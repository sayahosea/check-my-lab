<?php

namespace Database\Factories;

use App\Models\TestTracker;
use App\Utils\ENUM;
use App\Utils\Utility;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TestTracker>
 */
class TestTrackerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'test_id' => Utility::fakeTestID(),
            'activity' => fake()->randomElement(ENUM::Activity),
            'time' => fake()->dateTimeBetween('-1 week')
        ];
    }
}

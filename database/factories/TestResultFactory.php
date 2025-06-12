<?php

namespace Database\Factories;

use App\Models\TestResult;
use App\Utils\Utility;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TestResult>
 */
class TestResultFactory extends Factory
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
            'patient_nik' => Utility::fakeNik(),
            'test_file' => null
        ];
    }
}

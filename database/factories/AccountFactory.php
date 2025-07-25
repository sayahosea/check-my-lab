<?php

namespace Database\Factories;

use App\Models\Account;
use App\Utils\ENUM;
use App\Utils\Utility;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Account>
 */
class AccountFactory extends Factory
{
    public function definition(): array
    {
        $role = 'PASIEN';
        $full_name = fake()->firstName() . ' ' . fake()->lastName();

        $nik = null;
        $erm = null;
        $password = null;

        if ($role === 'PASIEN') {
            $nik = Utility::fakeNik();
            $erm = Utility::generateERM();
        } else {
            $password = '$argon2id$v=19$m=65536,t=4,p=1$L0Q3dzN6VEhsWnAyU0pFdA$c/2l2/4vujxtZoa1Nbx8LnlHuETkEiIR5sz2ZxfTSF0';
        }

        return [
            'account_id' => fake()->uuid(),
            'role' => $role,
            'patient_nik' => $nik,
            'phone_number' => $this->fakePhoneNumber(),
            'password' => $password,
            'full_name' => $full_name,
            'patient_erm' => $erm,
        ];
    }

    private function fakePhoneNumber(): string
    {
        return '0811' . fake()->randomNumber(8, true);
    }
}

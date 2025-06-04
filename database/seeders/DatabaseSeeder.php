<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Account::factory(10)->create();
    }
}

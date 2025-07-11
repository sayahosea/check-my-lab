<?php

namespace App\Utils;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Utility
{
    public static function fakeNik(): string
    {
        return fake()->randomNumber(7, true) . fake()->randomNumber(7, true) . '11';
    }

    public static function fakeTestID(): string
    {
        $test_id = '';
        for ($i = 0; $i < 10; $i++) {
            $test_id .= fake()->randomLetter();
        }

        return $test_id;
    }

    public static function checkAuth(Request $request) {
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $user = DB::table('user_accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        $role = $user->role;
        if ($role == 'PASIEN') return redirect('/');

        return null;
    }

    public static function hashPassword(string $plainText): String
    {
        $options = [
            'memory_cost' => 65536, // 64MB
            'time_cost' => 4,
            'threads' => 1,
        ];
        return password_hash($plainText, PASSWORD_ARGON2ID, $options);
    }

    public static function generateERM(): string
    {
        $erm_number = mt_rand(1, 10000);
        return sprintf("ERM%05d", $erm_number);
    }

    public static function getPatientTotal(): int
    {
        return DB::table('patient_accounts')->count();
    }

    public static function getTestTotal(): int
    {
        return DB::table('test_results')->count();
    }

    public static function getStaffTotal(): int
    {
        return DB::table('puskesmas_accounts')
            ->count();
    }
}

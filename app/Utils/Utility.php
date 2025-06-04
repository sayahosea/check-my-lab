<?php

namespace App\Utils;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Utility
{
    public static function fakeNik(): string
    {
        return (string) fake()->randomNumber(16, true);
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

        $user = DB::table('accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        $role = $user->role;
        if ($role == 'PASIEN') return redirect('/');

        return null;
    }

    public static function hashPassword(string $plainText)
    {
        $options = [
            'memory_cost' => 65536, // 64MB
            'time_cost' => 4,
            'threads' => 1,
        ];
        return password_hash($plainText, PASSWORD_ARGON2ID, $options);
    }
}
